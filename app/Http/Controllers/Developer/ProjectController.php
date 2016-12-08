<?php

namespace CapesAPI\Http\Controllers\Developer;

use Auth;
use Capes;
use CapesAPI\Http\Controllers\Controller;
use CapesAPI\Projects;
use Request;
use Storage;
use Validator;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkProjectOwner', ['except' => ['showCreateProject', 'createProject']]);
    }

    public function showCreateProject()
    {
        return view('developer.project.create');
    }

    public function createProject()
    {
        $rules = [
            'name'    => 'required|max:255|min:4',
            'website' => 'required|url',
        ];

        $validation = Validator::make(Request::all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $hash = '';

            do {
                $hash = str_random(6);
                $hash_db = Projects::where('hash', $hash)->first();
            } while (!empty($hash_db));

            Projects::create([
                'developer_id' => Auth::user()->id,
                'hash'         => $hash,
                'name'         => (Request::has('name') ? Request::get('name') : 'A Minecraft Client'),
                'website'      => (Request::has('website') ? Request::get('website') : env('APP_URL')),
            ]);

            return redirect()->route('developer::project::capes', ['hash' => $hash]);
        }
    }

    public function editProject($hash)
    {
        $project = Projects::where('hash', $hash)->first();

        if ($project->developer_id != Auth::user()->id) {
            abort(403);
        }

        $rules = [
            'name'    => 'required|max:255|min:4',
            'website' => 'required|url',
        ];

        $validation = Validator::make(Request::all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        $project->name = (Request::has('name') ? Request::get('name') : 'A Minecraft Client');
        $project->website = (Request::has('website') ? Request::get('website') : env('APP_URL'));
        $project->save();

        return redirect()->route('developer::project::capes', ['hash' => $hash]);
    }

    public function deleteProject($hash)
    {
        $project = Projects::where('hash', $hash)->first();

        if ($project->developer_id != Auth::user()->id) {
            abort(403);
        }

        $dir = 'public/'.Auth::user()->email.'/'.$hash;
        Storage::deleteDirectory($dir);

        $project->delete();
        $capes = Capes::where('project_id', $project->id)->get();

        foreach($capes as $cape) {
            ActiveCapes::where('cape_hash', $cape->hash)->delete();
        }

        $capes->delete();

        return redirect()->route('developer::dashboard');
    }
}
