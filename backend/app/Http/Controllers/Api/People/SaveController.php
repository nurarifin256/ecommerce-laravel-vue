<?php

namespace App\Http\Controllers\Api\People;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaveController extends Controller
{
    public function save(Request $request)
    {
        $save = DB::connection('pgsql')->table('peoples')->insert([
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
        ]);

        if ($save) {
            $return = "success";
        } else {
            $return = "failed";
        }

        return response()->json([
            'status' => true,
            'data' => $return
        ]);
    }
}
