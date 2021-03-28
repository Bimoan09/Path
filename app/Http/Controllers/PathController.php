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

        $request->validate([
            'parent' => 'required',
            'child' => 'required'
          ]);

        $data = new Path;
        $data->parent = $request->parent;
        $data->child = $request->child;
        $data->save();
        return response()->json(['success'=>'Product saved successfully.']);
    }

}
