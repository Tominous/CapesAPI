<?php

namespace CapesAPI\Http\Controllers\Mojang;

use Illuminate\Http\Request;
use CapesAPI\Http\Controllers\Controller;
use Navarr\MinecraftAPI\MinecraftAPI;
use Navarr\MinecraftAPI\Exception\BadLoginException;
use Navarr\MinecraftAPI\Exception\MigrationException;
use Navarr\MinecraftAPI\Exception\BasicException;
use Validator;
use ActiveCapes;

class AuthController extends Controller
{
    public function showLogin(Request $request) {
        if($request->session()->has('mojangAccessToken')) {
            return redirect()->route('mojang::getUserCP');
        } else {
            return view('mojang.login');
        }
    }

    public function showUserCP(Request $request) {
        if(!$request->session()->has('mojangAccessToken')) {
            return redirect()->route('mojang::getLogin');
        }

        $uuid = $request->session()->get('mojangUUID'); 
        $capes = ActiveCapes::where([
            'uuid' => $uuid,
            'active' => false
        ])->paginate();

        return view('mojang.dashboard', ['capes' => $capes]);
    }

    public function createSession(Request $request) {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if($validation->fails()) {
			return redirect()->back()->withInput()->withErrors($validation);
		}

        try {
            $mcAPI = new MinecraftAPI($request->get('email'), $request->get('password'));

            $request->session()->put('mojangAccessToken', $mcAPI->accessToken);
            $request->session()->put('mojangUsername', $mcAPI->username);
            $request->session()->put('mojangUUID', $mcAPI->minecraftID);

            return redirect()->route('mojang::getUserCP');        
        } catch (BadLoginException $e) {
            return redirect()->back()->withErrors([
                'mcError' => 'The login credentials were invalid.'
            ]);
        } catch (MigrationException $e) {
            return redirect()->back()->withErrors([
                'mcError' => 'The account you requested has been migrated, please use the correct login.'
            ]);
        } catch (BasicException $e) {
            return redirect()->back()->withErrors([
                'mcError' => 'The login credentials were correct, but the account does not own Minecraft.'
            ]);
        }

        return redirect()->back();
    }

    public function destroySession(Request $request) {
        $request->session()->flush();

        return redirect()->route('mojang::getLogin');
    }

    public function makeCapeActive(Request $request) {
        $uuid = $request->session()->get('mojangUUID');
        $capeHash = $request->get('capeHash');

        $capes = ActiveCapes::where([
            'uuid' => $uuid,
            'active' => true
        ])->get();

        foreach($capes as $capes) {
            $cape->active = false;
            $cape->save();
        }

        $newCape = ActiveCapes::where([
            'uuid' => $uuid,
            'cape_hash' => $capeHash
        ])->first();

        if($newCape != null) {
            $newCape->active = true;
            $newCape->save();
        }

        return redirect()->back();
    }

    public function disableAllCapes(Request $request) {
        $capes = ActiveCapes::where([
            'uuid' => $request->session()->get('mojangUUID'),
            'active' => true
        ])->get();

        foreach($capes as $cape) {
            $cape->active = false;
            $cape->save();
        }

        return redirect()->back();
    }
}
