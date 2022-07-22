<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class OsController extends Controller
{

    function listOs(){

        $os = DB::select('select * from os');

        return view('master.os', ['os' => $os]);

    }

    function addOs(Request $request){

        $os_name = $request->input('os_name');

        DB::insert('insert into os (os_name) values(?)', [$os_name]);

        return redirect()->back();

    }

    function editOs(Request $request){

        $os_id = $request->input('os_id');
        $os_name = $request->input('os_name');

        DB::update('update os set os_name = ? where os_id = ?', [$os_name, $os_id]);

        return redirect()->back();

    }

    function deleteOs($id){

        DB::delete('delete from os where os_id = ?', [$id]);

        return redirect()->back();

    }

}
