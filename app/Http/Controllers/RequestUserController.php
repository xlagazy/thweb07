<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Exports\BorrowExport;
use Excel;
use DB;
use DateTime;
use PDF;

class RequestUserController extends Controller
{
    
    function listRequestUser(){

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     DB::raw('concat(prefix.prefix_name,request_user.name_user, " ", request_user.surname_user) as fullname'))
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //foin for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser', ['request_user' => $request_user]);

    }

    function showAddRequestUser(){

        $section = DB::select('select * from section');
        $prefix = DB::select('select * from prefix');
        return view('request_system.request_user.add_request_user', ['section' => $section, 'prefix' => $prefix]);

    }

    function addRequestUser(Request $request){
        $subject = $request->input('subject');
        $useraccess = $request->input('user_access');
        $email_ad = $request->input('emailad');
        $as400_user = $request->input('as400');
        $emailonly = $request->input('emailonly');
        $adonly = $request->input('adonly');
        $effective_date = $request->input('effective_date');
        $employee_no = $request->input('employee_no');
        $prefix_id = $request->input('prefix_id');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $position = $request->input('position');
        $sect_id = $request->input('sect_id');
        $remark = $request->input('remark');
        $wireless = $request->input('wireless');
        $vpn = $request->input('vpn');
        $fileshare = $request->input('fileshare');
        $folderdetail = $request->input('folderdetail');
        $workstation = $request->input('workstation');
        $workstation_no = $request->input('workstation_no');
        $system_as400 = $request->input('system_as400');
        $remarkas400 = $request->input('remark_as400');
        $track = NotifyrepairController::generateDigit(6);

        DB::insert('insert into request_user (subject, email_ad, as400_user, email_only, ad_only,
                    employee_no, prefix, name_user, surname_user, position, sect_id, remark, wireless, vpn, fileshare,
                    folder_detail, workstation, workstation_no, remark_as400, effective_date, track, status_request_user) 
                    values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [$subject, $email_ad, $as400_user, 
                    $emailonly, $adonly, $employee_no, $prefix_id, $name, $surname, $position, $sect_id, $remark, $wireless, 
                    $vpn, $fileshare, $folderdetail, $workstation, $workstation_no, $remarkas400, $effective_date, $track, 0]);

        return redirect('/listrequestuser');
    }

    public static function subjectRequestUser($subject){
        if($subject == 0){
            echo "<label class='text-success'>Add</label>";
        }
        if($subject == 1){
            echo "<label class='text-danger'>Delete</label>";
        }
        if($subject == 2){
            echo "<label class='text-warning'>Change</label>";
        }
    }

    public static function statusRequestUser($status){
        if($status == 0){
            echo "<div class='bg-danger text-white'>ยังไม่ได้รับงาน</div>";
        }
        if($status == 1){
            echo "<div class='bg-warning text-white'>รอการอนุมัติ</div>";
        }
        if($status == 2){
            echo "<div class='bg-primary text-white'>รับงานเรียบร้อย</div>";
        }
        if($status == 3){
            echo "<div class='bg-warning text-white'>กำลังดำเนินการ</div>";
        }
        if($status == 4){
            echo "<div class='bg-success text-white'>ดำเนินการแล้ว</div>";
        }
    }

    //part for it
    function listRequestUserIT(){

        $request_user = DB::table('request_user')
                            ->select('request_user.no',
                                     'request_user.request_user_no',
                                     'request_user.email_ad',
                                     'request_user.as400_user',
                                     'request_user.email_only',
                                     'request_user.ad_only',
                                     'request_user.track',
                                     'request_user.employee_no',
                                     'request_user.position',
                                     'request_user.name_user',
                                     'request_user.surname_user',
                                     'section.sect_name',
                                     'request_user.subject',
                                     'request_user.effective_date',
                                     'request_user.remark',
                                     'request_user.work_detail',
                                     'request_user.program_install_date',
                                     'request_user.yearly_no',
                                     'request_user.time',
                                     'request_user.wireless',
                                     'request_user.vpn',
                                     'request_user.fileshare',
                                     'request_user.folder_detail',
                                     'request_user.time_type',
                                     'request_user.end_detail',
                                     'request_user.status_request_user',
                                     'request_user_approve.charge',
                                     'request_user_approve.end_date',
                                     DB::raw('concat(prefix.prefix_name, request_user.name_user, " ", request_user.surname_user) as fullname'))
                            ->leftjoin('request_user_approve', 'request_user.request_user_no', '=', 'request_user_approve.request_user_no')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id')
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser_it', ['request_user' => $request_user]);
 
    }

    function listRequestUserReceieved(){

        $request_user = DB::table('request_user')
                            ->select('request_user.no',
                                     'request_user.request_user_no',
                                     'request_user.email_ad',
                                     'request_user.as400_user',
                                     'request_user.email_only',
                                     'request_user.ad_only',
                                     'request_user.track',
                                     'request_user.employee_no',
                                     'request_user.position',
                                     'request_user.name_user',
                                     'request_user.surname_user',
                                     'section.sect_name',
                                     'request_user.subject',
                                     'request_user.effective_date',
                                     'request_user.remark',
                                     'request_user.work_detail',
                                     'request_user.program_install_date',
                                     'request_user.yearly_no',
                                     'request_user.time',
                                     'request_user.wireless',
                                     'request_user.vpn',
                                     'request_user.fileshare',
                                     'request_user.folder_detail',
                                     'request_user.time_type',
                                     'request_user.end_detail',
                                     'request_user.status_request_user',
                                     'request_user_approve.charge',
                                     'request_user_approve.end_date',
                                     DB::raw('concat(prefix.prefix_name, request_user.name_user, " ", request_user.surname_user) as fullname'))
                            ->leftjoin('request_user_approve', 'request_user.request_user_no', '=', 'request_user_approve.request_user_no')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id')
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id')
                            ->where('request_user_approve.charge', '=', session()->get('user_id'))
                            ->where('request_user.status_request_user', '>=', '2')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser_received', ['request_user' => $request_user]);
 
    }

    function listRequestUserApprove(){
        $request_user = DB::table('request_user')
                            ->select('request_user.no',
                                     'request_user.request_user_no',
                                     'request_user.email_ad',
                                     'request_user.as400_user',
                                     'request_user.email_only',
                                     'request_user.ad_only',
                                     'request_user.track',
                                     'request_user.employee_no',
                                     'request_user.position',
                                     'request_user.name_user',
                                     'request_user.surname_user',
                                     'request_user.wireless',
                                     'request_user.vpn',
                                     'request_user.fileshare',
                                     'request_user.folder_detail',
                                     'section.sect_name',
                                     'request_user.subject',
                                     'request_user.effective_date',
                                     'request_user.remark',
                                     'request_user.status_request_user',
                                     'request_user_approve.charge',
                                     'request_user_approve.chief',
                                     'request_user_approve.manager',
                                     'request_user_approve.end_charge',
                                     DB::raw('concat(prefix.prefix_name, request_user.name_user, " ", request_user.surname_user) as fullname'))
                            ->leftjoin('request_user_approve', 'request_user.request_user_no', '=', 'request_user_approve.request_user_no')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id')
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id')
                            ->where('request_user.status_request_user', '>=', '1')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser_approve', ['request_user' => $request_user]);
    }

    function addApproveRequestUserChief($request_user_no, $user_id){
        DB::update('update request_user_approve set chief = ? where request_user_no = ?', [$user_id, $request_user_no]);

        return redirect()->back();
    }

    function addApproveRequestUserManager($request_user_no, $user_id){
        DB::update('update request_user_approve set manager = ? where request_user_no = ?', [$user_id, $request_user_no]);
        DB::update('update request_user set status_request_user = 2 where request_user_no = ?', [$request_user_no]);

        return redirect()->back();
    }

    function addApproveEndRequestUserChief($request_user_no, $user_id){
        DB::update('update request_user_approve set end_chief = ? where request_user_no = ?', [$user_id, $request_user_no]);

        return redirect()->back();
    }

    function addApproveEndRequestUserManager($request_user_no, $user_id){
        DB::update('update request_user_approve set end_manager = ? where request_user_no = ?', [$user_id, $request_user_no]);
        DB::update('update request_user set status_request_user = 4 where request_user_no = ?', [$request_user_no]);

        return redirect()->back();
    }

    function updateRequestUser(Request $request){
        $request_user_no = $request->input('request_user_no');
        $status_request_user = $request->input('status_request_user');
        $work_detail = $request->input('work_detail');
        $end_date = $request->input('end_date');
        $program_install_date = $request->input("program_install_date");
        $yearly_no = $request->input("yearly_no");
        $time = $request->input("time");
        $time_type = $request->input("time_type");
        $end_detail = $request->input("end_detail");

        if($status_request_user == 4){
            DB::update("update request_user set work_detail = ?, program_install_date = ?, 
                    yearly_no = ?, time = ?, time_type = ?, end_detail = ?, status_request_user = 3
                    where request_user_no = ?", [$work_detail, $program_install_date, $yearly_no, $time,
                    $time_type, $end_detail, $request_user_no]);
            DB::update("update request_user_approve set end_charge = ?, end_date = ? where request_user_no = ?", 
                        [session()->get('user_id'), $end_date, $request_user_no]);
        }
        else{
            DB::update("update request_user set work_detail = ?, program_install_date = ?, 
                    yearly_no = ?, time = ?, time_type = ?, end_detail = ?, status_request_user = ?
                    where request_user_no = ?", [$work_detail, $program_install_date, $yearly_no, $time,
                    $time_type, $end_detail, $status_request_user, $request_user_no]);
        }

        return redirect()->back();
    }

    function recieveRequestUserIT($no){
        
        $request_user_no = $this->genRequestUserNo();

        DB::update('update request_user set request_user_no = ?, status_request_user = 1 where no = ?', [$request_user_no, $no]);
        DB::insert('insert into request_user_approve (request_user_no, charge) values(?, ?)', 
                    [$request_user_no, session()->get('user_id')]);

        return redirect()->back();

    }

    function genRequestUserNo(){
        $year = date('y');
        $month = date('m');
        $str1 = "NU";
        $str2 = $year.$month;
        $result = DB::select('select request_user_no, RIGHT(request_user_no, 3) as seq 
                                       from request_user
                                       where MID(request_user_no, 3, 2) = ? order by seq desc limit 1', [$year]);

        if(empty($result)){
            $str3 = "001";

            return $str1.$str2.$str3;
        }
        else{
            if((int)$result[0]->seq >= 1){
                $str3 = "00".(int)$result[0]->seq+1;
            }
            if((int)$result[0]->seq >= 9){
                $str3 = "0".(int)$result[0]->seq+1;
            }
            if((int)$result[0]->seq >= 99){
                $str3 = (int)$result[0]->seq+1;
            }

            return $str1.$str2.$str3;
        }
    }

    function reportPDFRequestUser($request_user_no){

        $request_user = DB::select('select ru.request_user_no, ru.*, ra.* from request_user ru 
                                    inner join request_user_approve ra
                                    on ru.request_user_no = ra.request_user_no
                                    where ru.request_user_no = ?', [$request_user_no]);
        
        $pdf = PDF::loadView('request_system.request_user.pdf_request_user', [$request_user_no]);
        $pdf->setPaper('A4', 'portrait');
        
        return @$pdf->stream('manhour'.date('d-M-Y h-i').'.pdf');
    }

    public static function approveRequestUserChief($request_user_no, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select request_user_no, charge, chief from request_user_approve where request_user_no = ? ', [$request_user_no]);
        if(!empty($datacheck[0]->chief)){
            echo Controller::getName($datacheck[0]->chief);
        }
        else if(!empty($datacheck[0]->charge)){
            if(session()->get('position') == 2 || session()->get('position') == 1){
                if(empty($datacheck[0]->chief)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestUserChief(\''.$request_user_no.'\','.$user_id.')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }
    }

    public static function approveRequestUserManager($request_user_no, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select request_user_no, charge, manager, chief 
                                 from request_user_approve where request_user_no = ? ', [$request_user_no]);

        if(!empty($datacheck[0]->manager)){
            echo Controller::getName($datacheck[0]->manager);
        }

        if(!empty($datacheck[0]->chief) && session()->get('position') != 1 && empty($datacheck[0]->manager)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
        else if(!empty($datacheck[0]->chief)){
            if(session()->get('position') == 1){
                if(empty($datacheck[0]->manager)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestUserManager(\''.$request_user_no.'\','.$user_id.')"> Approve</button>';
                    }
                }
            }
        }
        else if(!empty($datacheck[0]->charge)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
    }

    public static function approveEndRequestUserChief($request_user_no, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select request_user_no, end_charge, end_chief from request_user_approve where request_user_no = ? ', [$request_user_no]);
        if(!empty($datacheck[0]->end_chief)){
            echo Controller::getName($datacheck[0]->end_chief);
        }
        else if(!empty($datacheck[0]->end_charge)){
            if(session()->get('position') == 2 || session()->get('position') == 1){
                if(empty($datacheck[0]->end_chief)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestUserChief(\''.$request_user_no.'\','.$user_id.')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }
    }

    public static function approveEndRequestUserManager($request_user_no, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select request_user_no, end_charge, end_manager, end_chief 
                                 from request_user_approve where request_user_no = ? ', [$request_user_no]);

        if(!empty($datacheck[0]->end_manager)){
            echo Controller::getName($datacheck[0]->end_manager);
        }
        if(!empty($datacheck[0]->end_chief) && session()->get('position') != 1 && empty($datacheck[0]->end_manager)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
        else if(!empty($datacheck[0]->end_chief)){
            if(session()->get('position') == 1){
                if(empty($datacheck[0]->end_manager)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestUserManager(\''.$request_user_no.'\','.$user_id.')"> Approve</button>';
                    }
                }
            }
        }
        else if(!empty($datacheck[0]->end_charge) || !empty($datacheck[0]->end_chief)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
    }

}
