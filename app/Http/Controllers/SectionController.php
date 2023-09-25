<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class SectionController extends Controller
{
    
    function listSection(){
        
        $section = DB::select('select sc.*, dp.dept_name from section sc
                                inner join department dp
                                on sc.dept_id = dp.dept_id');
        $department = DB::select('select * from department');

        return view('master.section', ['section' => $section, 'department' => $department]);

    }

    function addSection(Request $request){

        $sect_name = $request->input('sect_name');
        $dept_id = $request->input('dept_id');

        DB::insert('insert into section (sect_name, dept_id) values(?, ?)', [$sect_name, $dept_id]);

        return redirect()->back();

    }

    function editSection(Request $request){

        $sect_id = $request->input('sect_id');
        $sect_name = $request->input('sect_name');
        $dept_id = $request->input('dept_id');

        DB::update('update section set sect_name = ?, dept_id = ? where sect_id = ?', 
                    [$sect_name, $dept_id, $sect_id]);

        return redirect()->back();

    }

    function deleteSection($id){

        DB::delete('delete from section where sect_id = ?', [$id]);

        return redirect()->back();

    }

}
