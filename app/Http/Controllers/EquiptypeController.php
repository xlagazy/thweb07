<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class EquiptypeController extends Controller
{
    
    function listEquiptype(){

        $equiptype = DB::select('select * from equipment_type');

        return view('master.equiptype', ['equiptype' => $equiptype]);

    }

    function addEquiptype(Request $request){

        $equiptype_name = $request->input('equip_type_name');

        DB::insert('insert into equipment_type (equip_type_name) values(?)', [$equiptype_name]);

        return redirect()->back();

    }

    function editEquiptype(Request $request){

        $equiptype_id = $request->input('equiptype_id');
        $equiptype_name = $request->input('equiptype_name');

        DB::update('update equipment_type set equip_type_name = ? where equip_type_id = ?', [$equiptype_name, $equiptype_id]);

        return redirect()->back();

    }

    function deleteEquiptype($id){

        DB::delete('delete from equipment_type where equip_type_id = ?', [$id]);

        return redirect()->back();

    }

}
