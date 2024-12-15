<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    //
    public function createLevel(Request $request)
    {
        $lvl = $request->lvl;
        $leveldescrition = $request->leveldescrition;
        $jdmarketing = $request->jdmarketing;
        $jdoperation = $request->jdoperation;
        $categoarylvl = $request->categoarylvl;

        $level = new Level();

        $level->lvl = $lvl;
        $level->description = $leveldescrition;
        $level->jdmarketing = $jdmarketing;
        $level->jdoperation = $jdoperation;
        $level->category = $categoarylvl;

        $success =  $level->save();

        if ($success) {
            return response()->json([
                "status" => 200,
                "message" => 'Create successfully.'
            ]);
        } else {
            return response()->json([
                "status" => 201,
                "message" => 'Try Again.'
            ]);
        }
    }
}
