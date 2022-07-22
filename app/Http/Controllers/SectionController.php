<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SectionController extends Controller
{
    
    function listSection(){
        
        $section = DB::select('select * from section');

        return view('master.section', ['section' => $section]);

    }

    function addSection(Request $request){

        $sect_name = $request->input('sect_name');

        DB::insert('insert into section (sect_name) values(?)', [$sect_name]);

        return redirect()->back();

    }

    function editSection(Request $request){

        $sect_id = $request->input('sect_id');
        $sect_name = $request->input('sect_name');

        DB::update('update section set sect_name = ? where sect_id = ?', [$sect_name, $sect_id]);

        return redirect()->back();

    }

    function deleteSection($id){

        DB::delete('delete from section where sect_id = ?', [$id]);

        return redirect()->back();

    }

}
