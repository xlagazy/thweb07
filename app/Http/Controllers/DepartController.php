<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class DepartController extends Controller
{

    function listDepartment(){

        $department = DB::select('select * from department');

        return view('master.department', ['department' => $department]);

    }

    function addDepartment(Request $request){

        $dept_name = $request->input('dept_name');

        DB::insert('insert into department (dept_name) values(?)', [$dept_name]);

        return redirect()->back();

    }

    function editDepartment(Request $request){

        $dept_id = $request->input('dept_id');
        $dept_name = $request->input('dept_name');

        DB::update('update department set dept_name = ? where dept_id = ?', [$dept_name, $dept_id]);

        return redirect()->back();

    }

    function deleteDepartment($id){

        DB::delete('delete from department where dept_id = ?', [$id]);

        return redirect()->back();

    }

}
