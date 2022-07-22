<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ComtypeController extends Controller
{
    
    function listComtype(){

        $comtype = DB::select('select * from com_type');

        return view('master.comtype', ['comtype' => $comtype]);

    }

    function addComtype(Request $request){

        $com_name = $request->input('com_name');

        DB::insert('insert into com_type (com_name) values(?)', [$com_name]);

        return redirect()->back();

    }

    function editComtype(Request $request){

        $com_id = $request->input('com_id');
        $com_name = $request->input('com_name');

        DB::update('update com_type set com_name = ? where com_id = ?', [$com_name, $com_id]);

        return redirect()->back();

    }

    function deleteComtype($id){

        DB::delete('delete from com_type where com_id = ?', [$id]);

        return redirect()->back();

    }

}
