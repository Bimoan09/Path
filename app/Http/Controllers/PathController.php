<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Path;
use DB;


class PathController extends Controller
{
    

    public function getPath()
    {
        $data = DB::table('tree_path')->get();
        return view('welcome', compact('data'));
    }


    public function storePath(Request $request)
    {

        $data = new Path;
        $data->parent = $request->parent;
        $data->child =  $request->child;
        $data->save();
        return response()->json(['success'=>'Path saved successfully.']);
    }

}
