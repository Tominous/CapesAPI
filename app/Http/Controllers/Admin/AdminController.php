<?php

namespace CapesAPI\Http\Controllers\Admin;

use Illuminate\Http\Request;
use CapesAPI\Http\Controllers\Controller;
use Role;
use DB;
use User;

class AdminController extends Controller
{
    public function showDashboard() {
        $unverified = Role::where('name', 'unverified')->first();
        $needsVerified = DB::table('role_user')->where('role_id', $unverified->id)->get();



        return view('admin.dashboard', ['users' => $needsVerified]);
    }

    public function showBanned() {

    }

    public function showDevelopers() {

    }

    public function showUsers() {

    }

    public function makeDeveloper(Request $request) {
        if($request->has('user_email')) {
            $user = User::where('email', $request->get('user_email'))->first();
            $role = Role::where('name', 'developer')->first();
            $unverified = Role::where('name', 'unverified')->first();

            if($user === null)
                return redirect()->back();
            
            $user->roles()->detach($unverified->id);
            $user->roles()->attach($role->id);

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function stripDeveloper(Request $request) {
        if($request->has('user_email')) {
            $user = User::where('email', $request->get('user_email'))->first();
            $role = Role::where('name', 'developer')->first();

            if($user === null)
                return redirect()->back();

            $user->roles()->detach($role->id);

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function banUser(Request $request) {
        if($request->has('user_email')) {
            $user = User::where('email', $request->get('user_email'))->first();
            $role = Role::where('name', 'banned')->first();

            if($user === null)
                return redirect()->back();

            $user->roles()->detachRoles();
            $user->roles()->attach($role->id);

            return redirect()->back();
        }

        return redirect()->back();
    }

    public function unbanUser(Request $request) {
        if($request->has('user_email')) {
            $user = User::where('email', $request->get('user_email'))->first();

            if($user === null)
                return redirect()->back();

            $user->roles()->detachRoles();

            return redirect()->back();
        }

        return redirect()->back();
    }
}
