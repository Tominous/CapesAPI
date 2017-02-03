<?php

namespace CapesAPI\Http\Controllers\API\v1;

use ActiveCapes;
use Capes;
use CapesAPI\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Projects;
use User;

class UserController extends Controller
{
    public function getCape($uuid)
    {
        $uuid = self::formatUUID($uuid);

        $activeCape = ActiveCapes::where([
            'uuid'   => $uuid,
            'active' => true,
        ])->first();

        if ($activeCape === null) {
            abort(404);
        }

        $cape = Capes::where('hash', $activeCape->cape_hash)->first();

        if ($cape === null) {
            abort(404);
        }

        $project = Projects::where('id', $cape->project_id)->first();

        if ($project === null) {
            abort(404);
        }

        $user = User::where('id', $project->developer_id)->first();

        if ($user === null || !$user->hasRole(['developer', 'admin'])) {
            abort(404);
        }

        $path = storage_path('app/public/'.$user->email.'/'.$project->hash.'/'.$cape->hash.'/cape.png');
        $headers = [
            'Content-Type' => 'image/png',
        ];

        return response()->file($path, $headers);
    }

    public function hasCape($uuid, $capeHash)
    {
        $uuid = self::formatUUID($uuid);

        return (ActiveCapes::where(['uuid' => $uuid, 'cape_hash' => $capeHash])->exists()) ? 1 : 0;
    }

    public function addCape(Request $request, $uuid)
    {
        $uuid = self::formatUUID($uuid);

        if (!$request->has('capeId')) {
            abort(404);
        }

        $cape = Capes::where('hash', $request->get('capeId'))->first();

        if ($cape === null) {
            abort(404);
        }

        if (self::hasCape($uuid, $cape->hash)) {
            return 1;
        }

        $project = Projects::where('id', $cape->project_id)->first();

        if ($project === null) {
            abort(404);
        }

        $user = User::where('id', $project->developer_id)->first();

        if ($user === null || !$user->hasRole(['developer', 'admin'])) {
            abort(404);
        }

        $currentActiveCape = ActiveCapes::where([
            'uuid'   => $uuid,
            'active' => true,
        ]);

        if ($currentActiveCape === null) {
            ActiveCapes::create([
                'uuid'      => $uuid,
                'cape_hash' => $cape->hash,
                'active'    => true,
            ]);
        } else {
            ActiveCapes::create([
                'uuid'      => $uuid,
                'cape_hash' => $cape->hash,
            ]);
        }

        return 1;
    }

    private function formatUUID($uuid)
    {
        if (str_contains($uuid, '-')) {
            return str_replace('-', '', $uuid);
        } else {
            return $uuid;
        }
    }
}
