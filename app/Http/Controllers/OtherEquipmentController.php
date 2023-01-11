<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Exports\EquipmentExport;
use Excel;
use DB;
use DateTime;
use Redirect;
use Illuminate\Pagination\Paginator;

class OtherEquipmentController extends Controller
{

    function listOtherEquipment(){

        //check null search
        isset($_GET['search_equip_no']) != '' ? $search_equip_no = $_GET['search_equip_no'] : $search_equip_no = "";
        isset($_GET['search_equip_name']) != '' ? $search_equip_name = $_GET['search_equip_name'] : $search_equip_name = "";
        isset($_GET['search_fix_asset']) != '' ? $search_fix_asset = $_GET['search_fix_asset'] : $search_fix_asset = "";
        isset($_GET['equip_type_name']) != '' ? $equip_type_name = $_GET['equip_type_name'] : $equip_type_name = "";
        isset($_GET['sect_name']) != '' ? $sect_name = $_GET['sect_name'] : $sect_name = "";
        isset($_GET['equipment_status']) != '' ? $equipment_status = $_GET['equipment_status'] : $equipment_status = "";

        $other_equip_type = DB::select('select * from other_equipment_type');
        $user = DB::select("select user_id, name, sc.sect_name from member mb
                            inner join section sc
                            on mb.section = sc.sect_id
                            where sc.sect_name = ? ", ["IT"]);
        $vendor = DB::select('select vendor_id, vendor_name from vendor');
        $depart = DB::select('select dept_id, dept_name from department');
        $section = DB::select('select * from section order by sect_name');
        $os = DB::select("select os_id, os_name from os");
        $location = DB::select("select * from location");

        $eq = DB::table('other_equipment')
                ->join('member', 'member.user_id', '=', 'other_equipment.person_in_charge')
                ->join('vendor', 'vendor.vendor_id', '=', 'other_equipment.vendor_id')
                ->join('section', 'section.sect_id', '=', 'other_equipment.sect_id')
                ->join('department', 'department.dept_id', '=', 'section.dept_id')
                ->join('other_equipment_type', 'other_equipment_type.ot_equip_type_id', '=', 'other_equipment.ot_equip_type_id')
                ->join('os', 'os.os_id', '=', 'other_equipment.os_id')
                ->join('location', 'location.locat_id', '=', 'other_equipment.location')
                ->select(
                         'other_equipment.ot_equipment_no',
                         'other_equipment.ot_equipment_name',
                         'other_equipment.fix_asset',
                         'other_equipment.person_in_charge',
                         'other_equipment.serial_number',
                         'other_equipment.location',
                         'other_equipment.setup_date',
                         'other_equipment.warranty',
                         'other_equipment.control_person',
                         'member.name',
                         'other_equipment.tel_no',
                         'other_equipment.equipment_status',
                         'other_equipment.cause_broken',
                         'other_equipment.write_off_date',
                         'other_equipment.spec',
                         'other_equipment.remark',
                         'other_equipment.image',
                         'os.os_id',
                         'os.os_name',
                         'vendor.vendor_id',
                         'vendor.vendor_name',
                         'department.dept_id',
                         'department.dept_name',
                         'section.sect_id',
                         'section.sect_name',
                         'other_equipment_type.ot_equip_type_id',
                         'other_equipment_type.ot_equip_type_name',
                         'other_equipment.timestamp',
                         'location.locat_name'
                )
                ->orderBy('other_equipment.timestamp', 'desc')
                ->paginate(10);

        return view('equipment.listotherequipment', ['other_equip_type' => $other_equip_type, 'user' => $user, 
                    'vendor' => $vendor, 'depart' => $depart, 'section' => $section, 'other_equipment' => $eq, 
                    'os' => $os,'search_equip_no' => $search_equip_no, 'search_equip_name' => $search_equip_name,
                    'search_fix_asset' => $search_fix_asset, 'equip_type_name' => $equip_type_name, 
                    'sect_name' => $sect_name, 'location' => $location, 'equipment_status' => $equipment_status]);

    }

    function searchOtherEquipment(){

        //check null search
        isset($_GET['search_equip_no']) != '' ? $search_equip_no = $_GET['search_equip_no'] : $search_equip_no = "";
        isset($_GET['search_equip_name']) != '' ? $search_equip_name = $_GET['search_equip_name'] : $search_equip_name = "";
        isset($_GET['search_fix_asset']) != '' ? $search_fix_asset = $_GET['search_fix_asset'] : $search_fix_asset = "";
        isset($_GET['equip_type_name']) != '' ? $equip_type_name = $_GET['equip_type_name'] : $equip_type_name = "";
        isset($_GET['sect_name']) != '' ? $sect_name = $_GET['sect_name'] : $sect_name = "";
        isset($_GET['equipment_status']) != '' ? $equipment_status = $_GET['equipment_status'] : $equipment_status = "";

        $other_equip_type = DB::select('select * from other_equipment_type');
        $user = DB::select("select user_id, name, sc.sect_name from member mb
                            inner join section sc
                            on mb.section = sc.sect_id
                            where sc.sect_name = ? ", ["IT"]);
        $vendor = DB::select('select vendor_id, vendor_name from vendor');
        $depart = DB::select('select dept_id, dept_name from department');
        $section = DB::select('select * from section order by sect_name');
        $os = DB::select("select os_id, os_name from os");
        $location = DB::select("select * from location");

        $eq = DB::table('other_equipment')
                ->join('member', 'member.user_id', '=', 'other_equipment.person_in_charge')
                ->join('vendor', 'vendor.vendor_id', '=', 'other_equipment.vendor_id')
                ->join('section', 'section.sect_id', '=', 'other_equipment.sect_id')
                ->join('department', 'department.dept_id', '=', 'section.dept_id')
                ->join('other_equipment_type', 'other_equipment_type.ot_equip_type_id', '=', 'other_equipment.ot_equip_type_id')
                ->join('os', 'os.os_id', '=', 'other_equipment.os_id')
                ->join('location', 'location.locat_id', '=', 'other_equipment.location')
                ->select(
                         'other_equipment.ot_equipment_no',
                         'other_equipment.ot_equipment_name',
                         'other_equipment.fix_asset',
                         'other_equipment.person_in_charge',
                         'other_equipment.serial_number',
                         'other_equipment.location',
                         'other_equipment.setup_date',
                         'other_equipment.warranty',
                         'other_equipment.control_person',
                         'member.name',
                         'other_equipment.tel_no',
                         'other_equipment.equipment_status',
                         'other_equipment.cause_broken',
                         'other_equipment.write_off_date',
                         'other_equipment.spec',
                         'other_equipment.remark',
                         'other_equipment.image',
                         'os.os_id',
                         'os.os_name',
                         'vendor.vendor_id',
                         'vendor.vendor_name',
                         'department.dept_id',
                         'department.dept_name',
                         'section.sect_id',
                         'section.sect_name',
                         'other_equipment_type.ot_equip_type_id',
                         'other_equipment_type.ot_equip_type_name',
                         'other_equipment.timestamp',
                         'location.locat_name'
                )
                ->where('other_equipment.ot_equipment_no', 'LIKE', '%'.$search_equip_no.'%')
                ->where('other_equipment.ot_equipment_name', 'LIKE', '%'.$search_equip_name.'%')
                ->where('other_equipment.fix_asset', 'LIKE', '%'.$search_fix_asset.'%')
                ->where('other_equipment_type.ot_equip_type_name', 'LIKE', '%'.$equip_type_name.'%')
                ->where('section.sect_name', 'LIKE', '%'.$sect_name)
                ->where('other_equipment.equipment_status', 'LIKE', '%'.$equipment_status.'%')
                ->orderBy('other_equipment.timestamp', 'desc')
                ->paginate(10);

        return view('equipment.listotherequipment', ['other_equip_type' => $other_equip_type, 'user' => $user, 
                    'vendor' => $vendor, 'depart' => $depart, 'section' => $section, 'other_equipment' => $eq, 
                    'os' => $os,'search_equip_no' => $search_equip_no, 'search_equip_name' => $search_equip_name,
                    'search_fix_asset' => $search_fix_asset, 'equip_type_name' => $equip_type_name, 
                    'sect_name' => $sect_name, 'location' => $location, 'equipment_status' => $equipment_status]);

    }

    function addOtherEquipment(Request $request){
        
        $equip_type = $request->input('equip_type');
        $equipment_name = $request->input('equipment_name');
        $fix_asset = $request->input('fix_asset');
        $serial_number = $request->input('serial_number');
        $setup_date = $request->input('setup_date');
        $control_person = $request->input('control_person');
        $person_in_charge = $request->input('person_in_charge');
        $tel_no = $request->input('tel_no');
        $equipment_status = $request->input('equipment_status_input');
        $warranty = $request->input('warranty');
        $spec = $request->input('spec');
        $remark = $request->input('remark');
        $vendor = $request->input('vendor_id');
        $sect_id = $request->input('sect_id');
        $os_id = $request->input('os_id');
        $location = $request->input('location');
        $cause_broken_input = $request->input('cause_broken');
        $write_off_date = $request->input('write_off_date');

        //call function equipnumber() 
        $equipment_no = $this->otherEquipNumber($equip_type, $sect_id, $setup_date);

        if($request->file('file') != ""){
            $request->validate([
                  'file' => 'required|mimes:jpg,jpeg,png|max:3072',
            ]);
    
            $fileName = uniqid().".".$request->file->getClientOriginalExtension();
    
            $request->file->move(public_path('images/equipment'), $fileName);
        }
        else{
            $fileName = "";
        }

        DB::insert('insert into other_equipment (ot_equipment_no, ot_equipment_name, fix_asset, serial_number, location, setup_date, warranty, control_person
                    , person_in_charge, tel_no, equipment_status,cause_broken, write_off_date, spec, remark, os_id, vendor_id, sect_id, image, ot_equip_type_id) 
                    values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ', [$equipment_no, $equipment_name, $fix_asset
                    , $serial_number, $location, $setup_date, $warranty, $control_person, $person_in_charge, $tel_no, $equipment_status
                    , $cause_broken_input, $write_off_date, $spec, $remark, $os_id, $vendor, $sect_id, $fileName, $equip_type]);

        return redirect()->back();

    }

    function showEditOtherEquipment($id){

        $equipment = DB::select('select * from other_equipment where ot_equipment_no = ?', [$id]);

        $equip_type = DB::select('select * from other_equipment_type');
        $user = DB::select("select user_id, name, sc.sect_name from member mb
                            inner join section sc
                            on mb.section = sc.sect_id
                            where sc.sect_name = ? ", ["IT"]);
        $vendor = DB::select('select vendor_id, vendor_name from vendor');
        $section = DB::select('select * from section');
        $location = DB::select("select * from location");
        $os = DB::select("select os_id, os_name from os");

        return view('equipment.editotherequipment', ['equip_type' => $equip_type, 'user' => $user, 'vendor' => $vendor, 
                     'section' => $section, 'equipment' => $equipment, 'os' => $os, 'location' => $location]);

    }

    function editOtherEquipment(Request $request){

        $equip_type = $request->input('ot_equip_type');
        $equipment_name = $request->input('ot_equipment_name');
        $fix_asset = $request->input('fix_asset');
        $serial_number = $request->input('serial_number');
        $setup_date = $request->input('setup_date');
        $control_person = $request->input('control_person');
        $person_in_charge = $request->input('person_in_charge');
        $tel_no = $request->input('tel_no');
        $equipment_status = $request->input('equipment_status');
        $warranty = $request->input('warranty');
        $spec = $request->input('spec');
        $remark = $request->input('remark');
        $vendor = $request->input('vendor_id');
        $section = $request->input('sect_id');
        $file_name = $request->input('file_name');
        $os_id = $request->input('os_id');
        $location = $request->input('location');
        $cause_broken = $request->input('cause_broken');
        $write_off_date = $request->input('write_off_date');

        if($request->file('file') != ""){
            $request->validate([
                  'file' => 'required|mimes:jpg,jpeg,png|max:3072',
            ]);
    
            $fileName = uniqid().".".$request->file->getClientOriginalExtension();
    
            $request->file->move(public_path('images/equipment'), $fileName);

            //delete image old file
            File::delete(public_path("images/equipment/$file_name"));
        }
        else if($file_name != "" ){
            $fileName = $file_name;
        }
        else{
            $fileName = "";
        }

        $equipment_no = $this->checkSection($request->input('ot_equipment_no'), $section);

        DB::update('update other_equipment set ot_equipment_no = ?, ot_equipment_name = ?, fix_asset = ?, serial_number = ?, location = ?, setup_date = ?, warranty = ?, control_person = ?
        , person_in_charge = ?, tel_no = ?, equipment_status = ?, cause_broken = ?, write_off_date = ?, spec = ?, remark = ?, os_id = ?, vendor_id = ?, sect_id = ?, image = ?
        , timestamp = timestamp where ot_equipment_no = ?'
        , [$equipment_no, $equipment_name, $fix_asset, $serial_number, $location, $setup_date, $warranty, $control_person, $person_in_charge, $tel_no, $equipment_status,
        $cause_broken, $write_off_date, $spec, $remark, $os_id, $vendor, $section, $fileName, $request->input('ot_equipment_no')]);

        return redirect('/listotherequipment');
    }

    function deleteOtherEquipment($id){

        $img = DB::select('select image from other_equipment where ot_equipment_no = ?', [$id]);

        if (File::exists(public_path('images/equipment/'.$img[0]->image))) {

            File::delete(public_path('images/equipment/'.$img[0]->image));

        }

        //log
        
        DB::delete('delete from other_equipment where ot_equipment_no = ?', [$id]);
    
        return redirect()->back();

    }

    private function checkSection($equipment_no, $sect_id){
        $section = DB::select('select sect_name from section where sect_id = ?', [$sect_id]);

        if(substr($equipment_no, 2, -7) != $section[0]->sect_name){
            return substr($equipment_no, 0, 2).$section[0]->sect_name."-".substr($equipment_no, -7);
        }
        else{
            return $equipment_no;
        }
    }

    private function otherEquipNumber($ot_equip_type_id, $sect_id, $setup_date){

        $yearmonth = date('ym', strtotime($setup_date));

        //select section name 
        $section = DB::select('select sect_name from section where sect_id = ?', [$sect_id]);

        //select equipment type
        $other_equip_type = DB::select('select ab_ot_equip_type_name from other_equipment_type where ot_equip_type_id = ?', [$ot_equip_type_id]);

        //select last equipment number
        $result = DB::select('select RIGHT(ot_equipment_no, 3) as no from other_equipment where ot_equipment_no 
                              LIKE "'.$other_equip_type[0]->ab_ot_equip_type_name.'%" and MID(ot_equipment_no, -7, 4)
                              = "'.$yearmonth.'" order by no desc
                              limit 1');

        if(empty($result)){
            return $other_equip_type[0]->ab_ot_equip_type_name.$section[0]->sect_name."-".$yearmonth."001";
        }
        else{
            if((int)$result[0]->no >= 1){
                $result_no = "00".$result[0]->no+1;
            }
            if((int)$result[0]->no >= 9){
                $result_no = "0".$result[0]->no+1;
            }
            if((int)$result[0]->no >= 99){
                $result_no = $result[0]->no+1;
            }
            
            return $other_equip_type[0]->ab_ot_equip_type_name.$section[0]->sect_name."-".$yearmonth.$result_no;
        }
        
    }

}
