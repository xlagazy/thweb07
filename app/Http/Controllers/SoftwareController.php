<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SoftwareExport;
use Excel;
use DB;

class SoftwareController extends Controller
{
    
    function listSoftware(){

        $software = DB::table('software')
                        ->join('software_type', 'software.software_type_no', '=', 'software_type.software_type_no')
                        ->join('platform', 'software.platform_no', '=', 'platform.platform_no')
                        ->join('member', 'software.user_id', '=', 'member.user_id')
                        ->select('software.software_no',
                                 'software.software_name',
                                 'software.software_version',
                                 'software.key_license',
                                 'software.max_license',
                                 'software.used_license',
                                 'software.start_date',
                                 'software.end_date',
                                 'software.software_type_no',
                                 'software_type.software_type_name',
                                 'platform.platform_name',
                                 'software.platform_no',
                                 'member.name')
                        ->orderBy('software.software_no', 'DESC')
                        ->paginate(10);
        $software_type = DB::select('select * from software_type');
        $platform = DB::select('select * from platform');

        return view('software.listsoftware', ['software' => $software, 'software_type' => $software_type, 'platform' => $platform]);

    }

    function addSoftware(Request $request){

        $software_name = $request->input('software_name');
        $software_version = $request->input('software_version');
        $key_license = $request->input('key_license');
        $max_license = $request->input('max_license');
        $used_license = $request->input('used_license');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $software_type_no = $request->input('software_type_no');
        $platform_no = $request->input('platform_no');
        $user_id = session()->get('user_id');

        DB::insert('insert into software (software_name, software_version, key_license, max_license, used_license,
                    start_date, end_date, software_type_no, platform_no, user_id, mail_status) values (?, ?, ?, ?, ?, ?,
                    ?, ?, ?, ?, 0)', [$software_name, $software_version, $key_license, $max_license, $used_license,
                    $start_date, $end_date, $software_type_no, $platform_no, $user_id]);

        //log

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        $software_no = DB::select('select software_no from software order by software_no desc limit 1');

        DB::connection('mysql2')->insert('insert into log_software (software_no, software_name, software_version, key_license, max_license, used_license,
                    start_date, end_date, software_type_no, platform_no, user_id, mail_status, name, ip, status) values (?, ?, ?, ?, ?, ?, ?,
                    ?, ?, ?, ?, 0, ?, ?, "add")', [$software_no[0]->software_no, $software_name, $software_version, $key_license, $max_license, $used_license,
                    $start_date, $end_date, $software_type_no, $platform_no, $user_id, $name, $ip]);


        return redirect()->back();
        
    }

    function editSoftware(Request $request){

        $software_no = $request->input('software_no');
        $software_name = $request->input('software_name');
        $software_version = $request->input('software_version');
        $key_license = $request->input('key_license');
        $max_license = $request->input('max_license');
        $used_license = $request->input('used_license');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $software_type_no = $request->input('software_type_no');
        $platform_no = $request->input('platform_no');

        DB::update('update software set software_name = ?, software_version = ?, key_license = ?, max_license = ?, used_license = ?,
                    start_date = ?, end_date = ?, software_type_no = ?, platform_no = ? where software_no = ?', [$software_name,
                    $software_version, $key_license, $max_license, $used_license, $start_date, $end_date, $software_type_no, $platform_no,
                    $software_no]);

        //log

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        $software = DB::select('select user_id, mail_status from software where software_no = ? ', [$software_no]);

        DB::connection('mysql2')->insert('insert into log_software (software_no, software_name, software_version, key_license, max_license, used_license,
                    start_date, end_date, software_type_no, platform_no, user_id, mail_status, name, ip, status) values (?, ?, ?, ?, ?, ?, ?,
                    ?, ?, ?, ?, ?, ?, ?, "edit")', [$software_no, $software_name, $software_version, $key_license, $max_license, $used_license,
                    $start_date, $end_date, $software_type_no, $platform_no, $software[0]->user_id, $software[0]->mail_status, $name, $ip]);

        return redirect()->back();

    }

    function deleteSoftware($id){

        DB::delete('delete from software where software_no = ?', [$id]);

        //log

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        DB::connection('mysql2')->insert('insert into log_software (software_no, name, ip, status) values (?, ?, ?, "delete")', [$id, $name, $ip]);

        return redirect()->back();

    }

    function exportSoftware(){
        $date = date('d-m-Y');
        return Excel::download(new SoftwareExport(), 'stock_'.$date.'.xlsx');
    }

}
