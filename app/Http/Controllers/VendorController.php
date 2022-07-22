<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class VendorController extends Controller
{
    
    function listVendor(){

        $vendor = DB::select('select * from vendor');

        return view('master.vendor', ['vendor' => $vendor]);

    }

    function addVendor(Request $request){

        $vendor_name = $request->input('vendor_name');

        DB::insert('insert into vendor (vendor_name) values(?)', [$vendor_name]);

        return redirect()->back();

    }

    function editVendor(Request $request){

        $vendor_id = $request->input('vendor_id');
        $vendor_name = $request->input('vendor_name');

        DB::update('update vendor set vendor_name = ? where vendor_id = ?', [$vendor_name, $vendor_id]);

        return redirect()->back();

    }

    function deleteVendor($id){

        DB::delete('delete from vendor where vendor_id = ?', [$id]);

        return redirect()->back();

    }

}
