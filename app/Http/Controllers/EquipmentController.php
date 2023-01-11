<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Exports\EquipmentExport;
use Excel;
use DB;
use DateTime;
use Illuminate\Pagination\Paginator;

class EquipmentController extends Controller
{

    function listEquipment(){

        //check null search
        isset($_GET['search_equip_no']) != '' ? $search_equip_no = $_GET['search_equip_no'] : $search_equip_no = "";
        isset($_GET['search_equip_name']) != '' ? $search_equip_name = $_GET['search_equip_name'] : $search_equip_name = "";
        isset($_GET['search_fix_asset']) != '' ? $search_fix_asset = $_GET['search_fix_asset'] : $search_fix_asset = "";
        isset($_GET['equip_type_name']) != '' ? $equip_type_name = $_GET['equip_type_name'] : $equip_type_name = "";
        isset($_GET['com_name']) != '' ? $com_name = $_GET['com_name'] : $com_name = "";
        isset($_GET['sect_name']) != '' ? $sect_name = $_GET['sect_name'] : $sect_name = "";

        $equip_type = DB::select('select * from equipment_type');
        $user = DB::select("select user_id, name, sc.sect_name from member mb
                            inner join section sc
                            on mb.section = sc.sect_id
                            where sc.sect_name = ? ", ["IT"]);
        $vendor = DB::select('select vendor_id, vendor_name from vendor');
        $depart = DB::select('select dept_id, dept_name from department');
        $section = DB::select('select sect_id, sect_name from section order by sect_name');
        $os = DB::select("select os_id, os_name from os");
        $com_type = DB::select('select com_id, com_name from com_type');

        $eq = DB::table('equipment')
                ->join('member', 'member.user_id', '=', 'equipment.person_in_charge')
                ->join('vendor', 'vendor.vendor_id', '=', 'equipment.vendor_id')
                ->join('department', 'department.dept_id', '=', 'equipment.dept_id')
                ->join('section', 'section.sect_id', '=', 'equipment.sect_id')
                ->join('equipment_type', 'equipment_type.equip_type_id', '=', 'equipment.equip_type_id')
                ->join('os', 'os.os_id', '=', 'equipment.os_id')
                ->join('com_type', 'com_type.com_id', '=', 'equipment.com_id')
                ->select('equipment.no',
                         'equipment.equipment_no',
                         'equipment.equipment_name',
                         'equipment.fix_asset',
                         'equipment.person_in_charge',
                         'equipment.serial_number',
                         'equipment.location',
                         'equipment.setup_date',
                         'equipment.warranty',
                         'equipment.control_person',
                         'member.name',
                         'equipment.tel_no',
                         'equipment.equipment_status',
                         'equipment.cause_broken',
                         'equipment.write_off_date',
                         'equipment.spec',
                         'equipment.remark',
                         'equipment.image',
                         'com_type.com_id',
                         'com_type.com_name',
                         'com_type.abbreviation_com_name',
                         'os.os_id',
                         'os.os_name',
                         'vendor.vendor_id',
                         'vendor.vendor_name',
                         'department.dept_id',
                         'department.dept_name',
                         'section.sect_id',
                         'section.sect_name',
                         'equipment_type.equip_type_id',
                         'equipment_type.equip_type_name'
                )
                ->orderBy('equipment.no', 'DESC')
                ->paginate(10);

        return view('equipment.listequipment', ['equip_type' => $equip_type, 'user' => $user, 'vendor' => $vendor, 
                    'depart' => $depart, 'section' => $section, 'equipment' => $eq, 'os' => $os, 'com_type' => $com_type,
                    'equip_type' => $equip_type, 'search_equip_no' => $search_equip_no, 'search_equip_name' => $search_equip_name,
                    'search_fix_asset' => $search_fix_asset, 'equip_type_name' => $equip_type_name, 
                    'com_name' => $com_name, 'sect_name' => $sect_name]);
    }

    function searchEquipment(){

        //check null search
        isset($_GET['search_equip_no']) != '' ? $search_equip_no = $_GET['search_equip_no'] : $search_equip_no = "";
        isset($_GET['search_equip_name']) != '' ? $search_equip_name = $_GET['search_equip_name'] : $search_equip_name = "";
        isset($_GET['search_fix_asset']) != '' ? $search_fix_asset = $_GET['search_fix_asset'] : $search_fix_asset = "";
        isset($_GET['equip_type_name']) != '' ? $equip_type_name = $_GET['equip_type_name'] : $equip_type_name = "";
        isset($_GET['com_name']) != '' ? $com_name = $_GET['com_name'] : $com_name = "";
        isset($_GET['sect_name']) != '' ? $sect_name = $_GET['sect_name'] : $sect_name = "";

        $equip_type = DB::select('select * from equipment_type');
        $user = DB::select("select user_id, name, sc.sect_name from member mb
                            inner join section sc
                            on mb.section = sc.sect_id
                            where sc.sect_name = ? ", ["IT"]);
        $vendor = DB::select('select vendor_id, vendor_name from vendor');
        $depart = DB::select('select dept_id, dept_name from department');
        $section = DB::select('select sect_id, sect_name from section order by sect_name');
        $os = DB::select("select os_id, os_name from os");
        $com_type = DB::select('select com_id, com_name from com_type');
        
        $eq = DB::table('equipment')
                ->join('member', 'member.user_id', '=', 'equipment.person_in_charge')
                ->join('vendor', 'vendor.vendor_id', '=', 'equipment.vendor_id')
                ->join('department', 'department.dept_id', '=', 'equipment.dept_id')
                ->join('section', 'section.sect_id', '=', 'equipment.sect_id')
                ->join('equipment_type', 'equipment_type.equip_type_id', '=', 'equipment.equip_type_id')
                ->join('os', 'os.os_id', '=', 'equipment.os_id')
                ->join('com_type', 'com_type.com_id', '=', 'equipment.com_id')
                ->select('equipment.no',
                         'equipment.equipment_no',
                         'equipment.equipment_name',
                         'equipment.fix_asset',
                         'equipment.person_in_charge',
                         'equipment.serial_number',
                         'equipment.location',
                         'equipment.setup_date',
                         'equipment.warranty',
                         'equipment.control_person',
                         'member.name',
                         'equipment.tel_no',
                         'equipment.equipment_status',
                         'equipment.cause_broken',
                         'equipment.write_off_date',
                         'equipment.spec',
                         'equipment.remark',
                         'equipment.image',
                         'com_type.com_id',
                         'com_type.com_name',
                         'com_type.abbreviation_com_name',
                         'os.os_id',
                         'os.os_name',
                         'vendor.vendor_id',
                         'vendor.vendor_name',
                         'department.dept_id',
                         'department.dept_name',
                         'section.sect_id',
                         'section.sect_name',
                         'equipment_type.equip_type_id',
                         'equipment_type.equip_type_name'
                )
                ->where('equipment.equipment_no', 'LIKE', '%'.$search_equip_no.'%')
                ->where('equipment.equipment_name', 'LIKE', '%'.$search_equip_name.'%')
                ->where('equipment.fix_asset', 'LIKE', '%'.$search_fix_asset.'%')
                ->where('equipment_type.equip_type_name', 'LIKE', '%'.$equip_type_name.'%')
                ->where('section.sect_name', '=', $sect_name)
                ->where('com_type.com_name', 'LIKE', '%'.$com_name.'%')
                ->orderBy('equipment.no', 'DESC')
                ->paginate(10);

        return view('equipment.listequipment', ['equip_type' => $equip_type, 'user' => $user, 'vendor' => $vendor, 
                     'depart' => $depart, 'section' => $section, 'equipment' => $eq, 'os' => $os, 'com_type' => $com_type,
                     'search_equip_no' => $search_equip_no, 'search_equip_name' => $search_equip_name,
                     'search_fix_asset' => $search_fix_asset, 'equip_type_name' => $equip_type_name, 'com_name' => $com_name, 
                    'sect_name' => $sect_name]);
    }

    function equipnumber($equip_type){
        
        if($equip_type == 2){
            $type = DB::select('select SUBSTR(equipment_no , 6, 10) eqp_no from equipment where equipment_no LIKE "THPRT%" order by CAST(eqp_no as int) desc limit 1');

            if(empty($type)){
                return $equipment_no = "THPRT" . "1";
            }
            else{
                $no = $type[0]->eqp_no;
                return $equipment_no = "THPRT".($no+1);
            }
        }

        if($equip_type == 3){
            $type = DB::select('select SUBSTR(equipment_no , 6, 10) eqp_no from equipment where equipment_no LIKE "THNET%" order by CAST(eqp_no as int) desc limit 1');

            if(empty($type)){
                return $equipment_no = "THNET" . "1";
            }
            else{
                $no = $type[0]->eqp_no;
                return $equipment_no = "THNET".($no+1);
            }
        }

        if($equip_type == 4){
            $type = DB::select('select SUBSTR(equipment_no , 6, 10) eqp_no from equipment where equipment_no LIKE "THUPS%" order by CAST(eqp_no as int) desc limit 1');

            if(empty($type)){
                return $equipment_no = "THUPS" . "1";
            }
            else{
                $no = $type[0]->eqp_no;
                return $equipment_no = "THUPS".($no+1);
            }
        }

        if($equip_type == 5){
            $type = DB::select('select SUBSTR(equipment_no , 6, 10) eqp_no from equipment where equipment_no LIKE "THAIR%" order by CAST(eqp_no as int) desc limit 1');

            if(empty($type)){
                return $equipment_no = "THAIR" . "1";
            }
            else{
                $no = $type[0]->eqp_no;
                return $equipment_no = "THAIR".($no+1);
            }
        }

        if($equip_type == 6){
            $type = DB::select('select SUBSTR(equipment_no , 6, 10) eqp_no from equipment where equipment_no LIKE "THEQP%" order by CAST(eqp_no as int) desc limit 1');

            if(empty($type)){
                return $equipment_no = "THEQP" . "1";
            }
            else{
                $no = $type[0]->eqp_no;
                return $equipment_no = "THEQP".($no+1);
            }
        }

    }

    function addEquipment(Request $request){
        
        $equip_type = $request->input('equip_type');

        //call function equipnumber() 
        $equipment_no = $this->equipnumber($equip_type);

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
        $depart = $request->input('dept_id');
        $section = $request->input('sect_id');
        $os_id = $request->input('os_id');
        $location = $request->input('location');
        $com_id = $request->input('com_id');
        $cause_broken_input = $request->input('cause_broken');
        $write_off_date = $request->input('write_off_date');

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

        DB::insert('insert into equipment (equipment_no, equipment_name, fix_asset, serial_number, location, setup_date, warranty, control_person
                    , person_in_charge, tel_no, equipment_status,cause_broken, write_off_date, spec, remark, os_id, com_id, vendor_id, dept_id, sect_id, image, equip_type_id) 
                    values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ', [$equipment_no, $equipment_name, $fix_asset
                    , $serial_number, $location, $setup_date, $warranty, $control_person, $person_in_charge, $tel_no, $equipment_status
                    , $cause_broken_input, $write_off_date, $spec, $remark, $os_id, $com_id, $vendor, $depart, $section, $fileName, $equip_type]);

        //log

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        DB::connection('mysql2')->insert('insert into log_equipment (equipment_no, equipment_name, fix_asset, serial_number, location, setup_date, warranty, control_person
                    , person_in_charge, tel_no, equipment_status,cause_broken, write_off_date, spec, remark, os_id, com_id, vendor_id, dept_id, sect_id, image, equip_type_id,
                    name, ip, status) 
                    values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "add") ', [$equipment_no, $equipment_name, $fix_asset
                    , $serial_number, $location, $setup_date, $warranty, $control_person, $person_in_charge, $tel_no, $equipment_status
                    , $cause_broken_input, $write_off_date, $spec, $remark, $os_id, $com_id, $vendor, $depart, $section, $fileName, $equip_type, $name, $ip]);

        return redirect()->back();

    }

    function showEditEquipment($id){

        $equipment = DB::select('select * from equipment where equipment_no = ?', [$id]);

        $equip_type = DB::select('select * from equipment_type');
        $user = DB::select("select user_id, name, sc.sect_name from member mb
                            inner join section sc
                            on mb.section = sc.sect_id
                            where sc.sect_name = ? ", ["IT"]);
        $vendor = DB::select('select vendor_id, vendor_name from vendor');
        $depart = DB::select('select dept_id, dept_name from department');
        $section = DB::select('select sect_id, sect_name from section');
        $os = DB::select("select os_id, os_name from os");
        $com_type = DB::select('select com_id, com_name from com_type');

        return view('equipment.editequipment', ['equip_type' => $equip_type, 'user' => $user, 'vendor' => $vendor, 
                     'depart' => $depart, 'section' => $section, 'equipment' => $equipment, 'os' => $os, 'com_type' => $com_type]);

    }

    function editEquipment(Request $request){

        $equip_type = $request->input('equip_type');
        $equipment_no = $request->input('equipment_no');
        $equipment_name = $request->input('equipment_name');
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
        $depart = $request->input('dept_id');
        $section = $request->input('sect_id');
        $file_name = $request->input('file_name');
        $os_id = $request->input('os_id');
        $location = $request->input('location');
        $com_id = $request->input('com_id');
        $cause_broken_input = $request->input('cause_broken');
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

        DB::update('update equipment set equipment_name = ?, fix_asset = ?, serial_number = ?, location = ?, setup_date = ?, warranty = ?, control_person = ?
        , person_in_charge = ?, tel_no = ?, equipment_status = ?, cause_broken = ?, write_off_date = ?, spec = ?, remark = ?, os_id = ?, com_id = ?, vendor_id = ?, dept_id = ?, sect_id = ?, image = ?
        where equipment_no = ?'
        , [$equipment_name, $fix_asset, $serial_number, $location, $setup_date, $warranty, $control_person, $person_in_charge, $tel_no, $equipment_status,
        $cause_broken_input, $write_off_date, $spec, $remark, $os_id, $com_id, $vendor, $depart, $section, $fileName, $equipment_no]);

        //log

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        DB::connection('mysql2')->insert('insert into log_equipment (equipment_no, equipment_name, fix_asset, serial_number, location, setup_date, warranty, control_person
                    , person_in_charge, tel_no, equipment_status,cause_broken, write_off_date, spec, remark, os_id, com_id, vendor_id, dept_id, sect_id, image, equip_type_id,
                    name, ip, status) 
                    values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "edit") ', [$equipment_no, $equipment_name, $fix_asset
                    , $serial_number, $location, $setup_date, $warranty, $control_person, $person_in_charge, $tel_no, $equipment_status
                    , $cause_broken_input, $write_off_date, $spec, $remark, $os_id, $com_id, $vendor, $depart, $section, $fileName, $equip_type, $name, $ip]);

        return redirect()->action([EquipmentController::class, 'listEquipment']);

    }

    function deleteEquipment($id){

        $img = DB::select('select image from equipment where equipment_no = ?', [$id]);

        if (File::exists(public_path('images/equipment/'.$img[0]->image))) {

            File::delete(public_path('images/equipment/'.$img[0]->image));

        }

        //log

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        DB::connection('mysql2')->insert('insert into log_equipment (equipment_no, name, ip, status) values(?, ?, ?, "delete")', [$id, $name, $ip]);
        
        DB::delete('delete from equipment where equipment_no = ?', [$id]);
    
        return redirect()->back();

    }

    function exportEquipment(Request $request){

        $equip_type_id = $request->input('equip_type');
        $com_id = $request->input('com_id');
        $date = date('d-m-Y');
        return Excel::download(new EquipmentExport($equip_type_id, $com_id), 'equipment_'.$date.'.xlsx');

    }

    public static function calWarranty($date){

        $setup_date = new DateTime($date);
        $today = new DateTime(date('Y-m-d'));
        $diff = $today->diff($setup_date);

        return $diff->y;
        
    }

    public static function genEquipQrOther($equipment_no){
        $str_no = substr($equipment_no, 5);
        if(strlen($str_no) == 1){
            $result = "0000".$str_no;
        }
        if(strlen($str_no) == 2){
            $result = "000".$str_no;
        }
        if(strlen($str_no) == 3){
            $result = "00".$str_no;
        }
        if(strlen($str_no) == 4){
            $result = "0".$str_no;
        }
        return $result;
    }

}
