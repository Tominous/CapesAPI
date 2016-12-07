<?php

namespace CapesAPI\Http\Controllers\Developer;

use ActiveCapes;
use Auth;
use Capes;
use CapesAPI\Http\Controllers\Controller;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Http\Request;
use Projects;
use Validator;

class UsersController extends Controller
{
    public function showUsers($hash, $capeHash)
    {
        $project = Projects::where('hash', $hash)->first();

        if ($project->developer_id != Auth::user()->id) {
            abort(403);
        }

        $client = new HttpClient();
        $users = ActiveCapes::where('cape_hash', $capeHash)->paginate(5);
        $cape = Capes::where([
            'hash'       => $capeHash,
            'project_id' => $project->id,
        ])->first();

        foreach ($users as $user) {
            $res = $client->get('https://api.mojang.com/user/profiles/'.$user->uuid.'/names');
            if ($res->getStatusCode() == 200) {
                $body = json_decode($res->getBody());
                $user->name = $body[count($body) - 1]->name;
            } else {
                $user->name = $user->uuid;
            }
        }

        return view('developer.project.users.view', ['project' => $project, 'users' => $users, 'cape' => $cape]);
    }

    public function removeUser(Request $request, $hash, $capeHash)
    {
        $project = Projects::where('hash', $hash)->first();

        if ($project->developer_id != Auth::user()->id) {
            abort(403);
        }

        $user = ActiveCapes::where([
            'cape_hash' => $capeHash,
            'uuid'      => $request->get('uuid'),
        ])->first();

        if ($user !== null) {
            $user->active = false;
            $user->save();
            $user->delete();
        }

        return redirect()->route('developer::project::showCapeUsers', ['hash' => $project->hash, 'capeHash' => $capeHash]);
    }

    public function addUser(Request $request, $hash, $capeHash)
    {
        $project = Projects::where('hash', $hash)->first();

        if ($project->developer_id != Auth::user()->id) {
            abort(403);
        }

        $rules = [
            'name' => 'required|max:16|min:2',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $client = new HttpClient();
            $res = $client->get('https://api.mojang.com/users/profiles/minecraft/'.$request->get('name'));
            if ($res->getStatusCode() == 200) {
                $body = json_decode($res->getBody());
                $uuid = $body->id;

                if($uuid == null) {
                    redirect()->back();
                }

                ActiveCapes::create([
                    'uuid'      => $uuid,
                    'cape_hash' => $capeHash,
                ]);

                return redirect()->route('developer::project::showCapeUsers', ['hash' => $project->hash, 'capeHash' => $capeHash]);
            } else {
                redirect()->back()->withInput();
            }
        }
    }
}
