<?php

namespace CapesAPI\Http\Controllers\Developer;

use ActiveCapes;
use Auth;
use Capes;
use CapesAPI\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Projects;
use Storage;
use Validator;

class CapesController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkProjectOwner');
    }

    public function getCapes($hash)
    {
        $project = Projects::where('hash', $hash)->first();
        $capes = Capes::where('project_id', $project->id)->paginate();

        return view('developer.project.capes.capes', ['project' => $project, 'capes' => $capes]);
    }

    public function deleteCape($hash, $capeHash)
    {
        $project = Projects::where('hash', $hash)->first();

        if ($project->developer_id != Auth::user()->id) {
            abort(403);
        }

        $cape = Capes::where([
            'hash'       => $capeHash,
            'project_id' => $project->id,
        ])->first();

        $dir = 'public/'.Auth::user()->email.'/'.$hash.'/'.$capeHash;

        ActiveCapes::where('cape_hash', $cape->hash)->delete();
        Storage::deleteDirectory($dir);
        $cape->delete();

        return redirect()->route('developer::project::capes', ['hash' => $hash]);
    }

    public function showCreateCape($hash)
    {
        $project = Projects::where('hash', $hash)->first();

        return view('developer.project.capes.create', ['project' => $project, 'hash' => $hash]);
    }

    public function createCape(Request $request, $hash)
    {
        $rules = [
            'name'          => 'required|max:255|min:4',
            'cape-template' => 'required|image|mimes:png,jpeg|max:3072',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        } else {
            $capeHash = '';

            do {
                $capeHash = str_random(6);
                $capeHash_db = Capes::where('hash', $capeHash)->first();
            } while (!empty($capeHash_db));

            $project = Projects::where('hash', $hash)->first();

            Capes::create([
                'project_id' => $project->id,
                'hash'       => $capeHash,
                'name'       => ($request->has('name') ? $request->get('name') : 'An Awesome Cape'),
            ]);

            $request->file('cape-template')->storeAs(
                'public/'.Auth::user()->email.'/'.$hash.'/'.$capeHash,
                'cape.png'
            );
        }

        return redirect()->route('developer::project::capes', ['hash' => $hash]);
    }

    public function editCape(Request $request, $hash, $capeHash)
    {
        $project = Projects::where('hash', $hash)->first();

        if ($project->developer_id != Auth::user()->id) {
            abort(403);
        }

        $cape = Capes::where([
            'hash'       => $capeHash,
            'project_id' => $project->id,
        ])->first();

        $rules = [
            'name'          => 'max:255|min:4',
            'cape-template' => 'image|mimes:png,jpeg|max:3072',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }

        if ($request->has('name')) {
            $cape->name = $request->get('name');
            $cape->save();
        }

        if ($request->hasFile('cape-template')) {
            $request->file('cape-template')->storeAs(
                'public/'.Auth::user()->email.'/'.$hash.'/'.$capeHash,
                'cape.png'
            );
        }

        return redirect()->route('developer::project::capes', ['hash' => $hash]);
    }
}
