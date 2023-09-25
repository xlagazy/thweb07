<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

use App\Mail\RUApproveSectUser;
use App\Mail\RUSendUser;
use App\Mail\RUApproveRelateSect;
use App\Mail\RUReceive;
use App\Mail\RUConfirmReceive;
use App\Mail\RUChargeReceive;
use App\Mail\RUConfirmUser;

use Excel;
use DB;
use DateTime;
use PDF;
use Cookie;
use Mail;

class RequestAdminController extends Controller
{
    
    function listRequestAdmin(){

        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";

        $request_admin = DB::table('request_admin as ra')
                            ->select('ra.*',
                                     'sc.sect_name',
                                     'rp.relate_sect_approve',
                                     'ad.name',
                                     'ad.surname')
                            ->leftjoin('request_admin_approve as rp', 'ra.no', '=','rp.fk_request_admin')
                            ->leftjoin('ad_profile as ad', 'ad.employee_no', '=','rp.user_charge')
                            ->leftjoin('section as sc', 'ra.sect_id', '=', 'sc.sect_id') //join for section add
                            ->Orderby('ra.no', 'desc')
                            ->paginate(10);


        return view('request_system.request_admin.listrequestadmin', ['request_admin' => $request_admin]);

    }

    function showAddRequestAdmin(){
        $section = DB::select('select * from section');

        return view('request_system.request_admin.add_request_admin', ['section' => $section]);
    }

    function addRequestAdmin(Request $request){
        $subject = $request->input('subject');
        $sect_id = $request->input('sect_id');
        $need_date = $request->input('need_date');
        $reason = $request->input('reason');
        $reference = $request->input('reference');
        $detail = $request->input('detail');
        $relate_sect = $request->input('relate_sect');
        $track = NotifyrepairController::generateDigit(6);
        $relate_sect_approve = array();

        if(isset($relate_sect)){
            for($i=0;$i<count($relate_sect);$i++){
                $relate_sect_approve[] = 0;
            }
        }

        $relate_sect = json_encode($relate_sect);
        $relate_sect_approve = json_encode($relate_sect_approve);

        if($request->file('files') != ""){
            $request->validate([
                'files' => 'required',
                'files.*' => 'mimes:pdf|max:5120'
            ]);
          
            if($request->hasfile('files')) {
                  foreach($request->file('files') as $file)
                  {
                      $filename = uniqid().".".$file->getClientOriginalName();
                      $file->move(public_path().'/file/request_user/attach_file/', $filename);  
                      $fileData[] = $filename;  
                  }
    
                  $filename = json_encode($fileData);
            }
        }
        else{
            $filename = "";
        }

        DB::insert("insert into request_admin (subject, sect_id, need_date, reason, reference, detail, relate_sect, attach_file, track, status_request_admin)
                    values(?, ?, ?, ?, ?,  ?, ?, ?, ?, 0)", [$subject, $sect_id, $need_date, $reason, $reference, $detail, $relate_sect, $filename, $track]);

        $fk_request_admin = DB::select('select no from request_admin order by no desc limit 1');

        DB::insert('insert into request_admin_approve (fk_request_admin, user_charge, relate_sect_approve) values(?, ?, ?)', 
                    [$fk_request_admin[0]->no, Cookie::get('employee_no'), $relate_sect_approve]);

        $details = [
            'dear' => 'Dear '.Cookie::get('name').',',
            'content1' => 'Your request has been successfully received.',
            'content2' => 'Your tracking number is '.$track,
            'content3' => $track,
            'content4' => '(This is an automated message, can\'t reply.)',
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        //$toEmail = Cookie::get('email');
        $toEmail = 'Suphatcha.s@nisdt.co.th';

        Mail::to($toEmail)->send(new RUSendUser($details));

        //sendmail to chief
        $email = DB::select('select email, position from ad_profile where section = ?', [Cookie::get('section')]);

        foreach($email as $emails){
            if(strpos($emails->position, 'Chief') !== false){
                $details = [
                    'dear' => 'Dear Chief,',
                    'content1' => 'Please check and approve admin request from member of your section.',
                    'content2' => 'Click link below for approve : ',
                    'content3' => $track,
                    'thank' => 'Thank you',
                    'sign' => 'IT Web'
                ];
        
                $toEmail = $emails->email;
                        
                Mail::to($toEmail)->send(new RUApproveSectUser($details));
            }
        }

        return redirect('/listrequestadmin');

    }

    function listRequestAdminApproveSection(){

        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";

        $request_admin = DB::table('request_admin as ra')
                            ->select('ra.*',
                                     'sc.sect_name',
                                     'rp.relate_sect_approve',
                                     'ad.name',
                                     'ad.surname',
                                     'rp.user_charge')
                            ->leftjoin('request_admin_approve as rp', 'ra.no', '=','rp.fk_request_admin')
                            ->leftjoin('ad_profile as ad', 'ad.employee_no', '=','rp.user_charge')
                            ->leftjoin('section as sc', 'ra.sect_id', '=', 'sc.sect_id') //join for section add
                            ->paginate(10);


        return view('request_system.request_admin.listrequestadmin_approve_sect', ['request_admin' => $request_admin]);

    }

    function addApproveRequestAdminSectChief($fk_request_admin, $employee_no){
        DB::update('update request_admin_approve set user_chief = ? where fk_request_admin = ?', [$employee_no, $fk_request_admin]);

        //sendmail to manager
        $track = DB::select('select track from request_admin where no = ?', [$fk_request_admin]);
        /*$email = DB::select('select email, position from ad_profile where section = ?', [Cookie::get('section')]);

        foreach($email as $emails){
            if(strpos($emails->position, 'Mgr') !== false){
                $details = [
                    'dear' => 'Dear Manager,',
                    'content1' => 'Please check and approve user request from member of your section.',
                    'content2' => 'Click link below for approve : ',
                    'content3' => $track[0]->track,
                    'thank' => 'Thank you',
                    'sign' => 'IT Web'
                ];
        
                $toEmail = $emails->email;   

                Mail::to($toEmail)->send(new RUApproveSectUser($details));
            }
        }*/

        return redirect()->back();
    }

    function addApproveRequestAdminSectManager($fk_request_admin, $employee_no){
        $request_user = DB::select("select relate_sect, sect_id from request_admin where no = ?", [$fk_request_admin]);
        $request_admin_approve = DB::select("select relate_sect_approve from request_admin_approve where fk_request_admin = ?", [$fk_request_admin]);
        $track = DB::select('select track from request_admin where no = ?', [$fk_request_admin]);
        $arr_fk_request_admin = json_decode($request_admin_approve[0]->relate_sect_approve);
        $arr_relate_sect = json_decode($request_user[0]->relate_sect);
        
        if(count($arr_fk_request_admin) != 0){
            /*for($i=0;$i<count($arr_fk_request_user);$i++){
                $ad_profile = DB::select('select * from ad_profile where section = ?', [$arr_relate_sect[$i]]);
                foreach($ad_profile as $ad_profiles){
                    if(strpos($ad_profiles->position, 'Mgr') !== false){
                        $details = [
                            'dear' => 'Dear Manager,',
                            'content1' => 'Please check and approve user request from '.Controller::getSection($request_user[0]->sect_id).' section.',
                            'content2' => 'Click link below for approve : ',
                            'content3' => $track[0]->track,
                            'thank' => 'Thank you',
                            'sign' => 'IT Web'
                        ];
                
                        $toEmail = $ad_profiles->email;       
        
                        Mail::to($toEmail)->send(new RUApproveRelateSect($details));
                    }
                }
            }*/

            DB::update('update request_admin_approve set user_manager = ? where fk_request_admin = ?', [$employee_no, $fk_request_admin]);
            DB::update('update request_admin set status_request_admin = 1 where no = ?', [$fk_request_admin]);
        }
        else{
            DB::update('update request_admin_approve set user_manager = ? where fk_request_admin = ?', [$employee_no, $fk_request_admin]);
            DB::update('update request_admin set status_request_admin = 2 where no = ?', [$fk_request_admin]);
        }

        return redirect()->back();
    }

    function addApproveRequestAdminRelateSect($fk_request_admin, $employee_no, $seq){ 
        $relate_sect_approve = DB::select("select relate_sect_approve from request_admin_approve where fk_request_admin = ?", [$fk_request_admin]);
        $email = DB::select('select ad.email from member mb
                              inner join ad_profile ad
                              on ad.employee_no = mb.employees_no
                              where mb.sub = 4 and mb.position = 2');
        $track = DB::select('select track from request_admin where no = ?', [$fk_request_admin]);
        $section = DB::select('select sect_id from request_admin where no = ?', [$fk_request_admin]);
        $arr_relate_sect_approve = json_decode($relate_sect_approve[0]->relate_sect_approve);

        $count = 0;

        for($i=0;$i<count($arr_relate_sect_approve);$i++){
            if($arr_relate_sect_approve[$i] == 0){
                $count++;
            }
        }

        if($count == 1){
            $arr_relate_sect_approve[$seq] = $employee_no;
            $arr_relate_sect_approve = json_encode($arr_relate_sect_approve);
    
            DB::update('update request_admin_approve set relate_sect_approve = ? where fk_request_admin = ?', [$arr_relate_sect_approve, $fk_request_admin]);
            DB::update('update request_admin set status_request_admin = 2 where no = ?', [$fk_request_admin]);

            /*$details = [
                'dear' => 'Dear IT Admin,',
                'content1' => 'Please check and receive user request from '.Controller::getSection($section[0]->sect_id).' section.',
                'content2' => 'Click link below for approve : ',
                'content3' => $track[0]->track,
                'thank' => 'Thank you',
                'sign' => 'IT Web'
            ];
    
            $toEmail = $email[0]->email; 

            Mail::to($toEmail)->send(new RUReceive($details));*/
        }
        else{
            $arr_relate_sect_approve[$seq] = $employee_no;
            $arr_relate_sect_approve = json_encode($arr_relate_sect_approve);
    
            DB::update('update request_admin_approve set relate_sect_approve = ? where fk_request_admin = ?', [$arr_relate_sect_approve, $fk_request_admin]);
        }

        return redirect()->back();
    }

    function listRequestUserApproveRelatesect(){
        
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";

        $request_admin = DB::table('request_admin as ra')
                            ->select('ra.*',
                                     'sc.sect_name',
                                     'rp.relate_sect_approve',
                                     'ad.name',
                                     'ad.surname',
                                     'rp.user_charge',
                                     'rp.user_manager')
                            ->leftjoin('request_admin_approve as rp', 'ra.no', '=','rp.fk_request_admin')
                            ->leftjoin('ad_profile as ad', 'ad.employee_no', '=','rp.user_charge')
                            ->leftjoin('section as sc', 'ra.sect_id', '=', 'sc.sect_id') //join for section add
                            ->paginate(10);

        return view('request_system.request_admin.listrequestadmin_approve_relatesect', ['request_admin' => $request_admin, 'search_track_no' => $search_track_no,
                                                                                       'search_subject'=> $search_subject]);
    }

    public static function approveRequestAdminSectChief($fk_request_admin, $employee_no){

        $stamp = DB::select('select signature from ad_profile where employee_no = ?', [$employee_no]);
        $datacheck = DB::select('select user_charge, user_chief from request_admin_approve where fk_request_admin = ? ',
                                 [$fk_request_admin]);

        if(!empty($datacheck[0]->user_chief)){
            echo Controller::getNameAD($datacheck[0]->user_chief);
        }
        else if(!empty($datacheck[0]->user_charge)){
            if(strpos(Cookie::get('position'), 'Mgr') !== false || strpos(Cookie::get('position'), 'Chief') !== false){
                if(empty($datacheck[0]->user_chief)){
                    if(empty($stamp[0]->signature)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestAdminSectChief(\''.$fk_request_admin.'\',\''.$employee_no.'\')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }

    }

    public static function approveRequestAdminSectManager($fk_request_admin, $employee_no){
        $stamp = DB::select('select signature from ad_profile where employee_no = ?', [$employee_no]);
        $datacheck = DB::select('select user_charge, user_manager, user_chief 
                                 from request_admin_approve where fk_request_admin = ? ', [$fk_request_admin]);
        if(!empty($datacheck[0]->user_manager)){
            echo Controller::getNameAD($datacheck[0]->user_manager);
        }

        if(!empty($datacheck[0]->user_chief) && strpos(Cookie::get('position'), 'Mgr') == false && empty($datacheck[0]->user_manager)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
        else if(!empty($datacheck[0]->user_chief) && !empty($datacheck[0]->user_charge) ){
            if(strpos(Cookie::get('position'), 'Mgr') !== false){
                if(empty($datacheck[0]->user_manager)){
                    if(empty($stamp[0]->signature)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestAdminSectManager(\''.$fk_request_admin.'\',\''.$employee_no.'\')"> Approve</button>';
                    }
                }
            }
        }
    }

    public static function approveRequestAdminRelateSect($fk_request_admin, $employee_no, $seq){
        $relate_sect_approve = DB::select("select relate_sect_approve from request_admin_approve where fk_request_admin = ?", [$fk_request_admin]);
        $arr_relate_sect_approve = json_decode($relate_sect_approve[0]->relate_sect_approve);

        if($arr_relate_sect_approve[$seq] != 0){
            echo '<i class="fa fa-check-circle text-success fa-2x" aria-hidden="true"></i>';
        }
        else{
            if(strpos(Cookie::get('position'), 'Mgr') !== false){
                echo '<button class="btn btn-primary btn-sm" onclick="approveRequestAdminRelateSect(\''.$fk_request_admin.'\',\''.$employee_no.'\',\''.$seq.'\')"> Approve</button>';
            }
            else{
                echo '<button class="btn btn-secondary btn-sm" disabled> Approve</button>';
            }
        }
    }

    //part for it
    function listRequestAdminIT(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";
        isset($_GET['search_charge']) != '' ? $search_charge = $_GET['search_charge'] : $search_charge = "";

        $request_admin = DB::table('request_admin as ra')
                            ->select('ra.*',
                                     'sc.sect_name',
                                     'rp.charge',
                                     'rp.user_charge',
                                     'rp.relate_sect_approve',
                                     'ad.name',
                                     'ad.surname')
                            ->leftjoin('request_admin_approve as rp', 'ra.no', '=','rp.fk_request_admin')
                            ->leftjoin('section as sc', 'ra.sect_id', '=', 'sc.sect_id') //join for section add
                            ->leftjoin('ad_profile as ad', 'ad.employee_no', '=','rp.user_charge')
                            ->where('ra.status_request_admin', '>=', '2')
                            ->orderBy('ra.no', 'desc')
                            ->paginate(10);
        $section = DB::select('select * from section');
        $member = DB::select('select user_id, name from member where sub = 4');
        $kind_request_admin = DB::select('select * from kind_request_admin');

        return view('request_system.request_admin.listrequestadmin_it', ['request_admin' => $request_admin, 'member' => $member, 
                    'section' => $section, 'kind_request_admin' => $kind_request_admin, 'search_track_no' => $search_track_no,
                    'search_subject'=> $search_subject, 'search_status' => $search_status, 'search_section' => $search_section,
                    'search_date' => $search_date, 'search_charge' => $search_charge, 'search_request_no' => $search_request_no]);
 
    }

    function assignRequestAdmin(Request $request){
        $no = $request->input('no');
        $kind_abbreviation = $request->input('kind_request_admin');
        $charge = $request->input('charge');
        $request_admin_no = $this->genRequestAdminNo($kind_abbreviation);

        DB::update('update request_admin set request_admin_no = ? where no = ?', [$request_admin_no, $no]);
        DB::update('update request_admin_approve set charge = ? where fk_request_admin = ? ', [$charge, $no]);

        return redirect()->back();
    }

    function refuseRequestAdmin(Request $request){
        $no = $request->input('no');
        $kind_abbreviation = $request->input('kind_request_admin');
        $refuse_detail = $request->input('refuse_detail');
        $request_admin_no = $this->genRequestAdminNo($kind_abbreviation);

        DB::update('update request_admin set request_admin_no = ?, refuse_detail = ?, status_request_admin = 8 where no = ? ', [$request_admin_no, $refuse_detail, $no]);

        return redirect()->back();
    }

    function genRequestAdminNo($kind_abbreviation){
        $year = date('y');
        $month = date('m');
        $str1 = $kind_abbreviation;
        $str2 = $year.$month;
        $result = DB::select('select request_admin_no, RIGHT(request_admin_no, 3) as seq 
                              from request_admin
                              where LEFT(request_admin_no, 2) = ? and MID(request_admin_no, 3, 2) = ? order by seq desc limit 1',
                              [$kind_abbreviation, $year]);

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

    function listRequestAdminApprove(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";

        $request_admin = DB::table('request_admin as ra')
                            ->select('ra.*',
                                     'sc.sect_name',
                                     'rp.fk_request_admin',
                                     'rp.relate_sect_approve',
                                     'rp.charge',
                                     'rp.end_charge',
                                     'ad.name',
                                     'ad.surname')
                            ->leftjoin('request_admin_approve as rp', 'ra.no', '=', 'rp.fk_request_admin')
                            ->leftjoin('section as sc', 'ra.sect_id', '=', 'sc.sect_id')
                            ->leftjoin('ad_profile as ad', 'ad.employee_no', '=','rp.user_charge')
                            ->where('ra.status_request_admin', '>=', '1')
                            ->whereNotNull('rp.charge')
                            ->orderBy('ra.no', 'desc')
                            ->paginate(10);

        $section = DB::select('select * from section');

        return view('request_system.request_admin.listrequestadmin_approve', ['request_admin' => $request_admin,
                    'section' => $section, 'search_track_no' => $search_track_no, 
                    'search_subject'=> $search_subject, 'search_section' => $search_section, 
                    'search_date' => $search_date, 'search_request_no' => $search_request_no]);
    }

    function listRequestAdminReceieved(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";

        $request_admin = DB::table('request_admin as ra')
                            ->select('ra.*',
                                     'sc.sect_name',
                                     'rp.charge',
                                     'rp.user_charge',
                                     'rp.relate_sect_approve',
                                     'rp.end_date',
                                     'ad.name',
                                     'ad.surname')
                            ->leftjoin('request_admin_approve as rp', 'ra.no', '=', 'rp.fk_request_admin')
                            ->leftjoin('section as sc', 'ra.sect_id', '=', 'sc.sect_id')
                            ->leftjoin('ad_profile as ad', 'ad.employee_no', '=','rp.user_charge')
                            ->where('rp.charge', '=', session()->get('user_id'))
                            ->where('ra.status_request_admin', '>=', '3')
                            ->orderBy('ra.no', 'desc')
                            ->paginate(10);
        $section = DB::select('select * from section');
        $member = DB::select('select user_id, name from member where sub = 4');

        return view('request_system.request_admin.listrequestadmin_received', ['request_admin' => $request_admin, 'section' => $section,
                    'member' => $member,'search_track_no' => $search_track_no, 'search_subject'=> $search_subject, 
                    'search_status' => $search_status, 'search_section' => $search_section, 'search_date' => $search_date,
                    'search_request_no' => $search_request_no]);
 
    }

    function addApproveRequestAdminChief($fk_request_admin, $user_id){
        DB::update('update request_admin_approve set chief = ? where fk_request_admin = ?', [$user_id, $fk_request_admin]);

        /*$track = DB::select('select track, sect_id from request_admin where no = ?', [$fk_request_admin]);
        $email = DB::select('select ad.email from member mb
                              inner join ad_profile ad
                              on ad.employee_no = mb.employees_no
                              where mb.position = 1');

        $details = [
            'dear' => 'Dear IT Manager,',
            'content1' => 'Please check and confirm receive user request from '.Controller::getSection($track[0]->sect_id).' section.',
            'content2' => 'Click link below for approve : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUConfirmReceive($details));*/

        return redirect()->back();
    }

    function addApproveRequestAdminManager($fk_request_admin, $user_id){
        //$request_user_no = $this->genRequestUserNo();
        $track = DB::select('select track, sect_id from request_admin where no = ?', [$fk_request_admin]);
        $email = DB::select('select ad.email from request_user_approve ua
                             inner join member mb
                             on mb.user_id = ua.charge
                             inner join ad_profile ad
                             on mb.employees_no = ad.employee_no
                             where ua.fk_request_user = ?', [$fk_request_admin]);

        //DB::update('update request_user set request_user_no = ?, status_request_user = 3 where no = ?', [$request_user_no, $fk_request_user]);
        DB::update('update request_admin_approve set manager = ? where fk_request_admin = ?', [$user_id, $fk_request_admin]);
        DB::update('update request_admin set status_request_admin = 3 where no = ?', [$fk_request_admin]);

        /*$details = [
            'dear' => 'Dear IT Admin,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been authorized by the manager, please proceed.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUChargeReceive($details));*/

        return redirect()->back();
    }

    function updateRequestAdmin(Request $request){
        $no = $request->input('no');
        $status_request_admin = $request->input('status_request_admin');
        $work_detail = $request->input('work_detail');
        $kind_request = $request->input('kind_request');
        $end_date = $request->input('end_date');
        $program_install_date = $request->input("program_install_date");
        $yearly_no = $request->input("yearly_no");
        $time = $request->input("time");
        $time_type = $request->input("time_type");
        $end_detail = $request->input("end_detail");

        if($status_request_admin == 5){
            DB::update("update request_admin set work_detail = ?, kind_request = ?, program_install_date = ?, 
                    yearly_no = ?, time = ?, time_type = ?, end_detail = ?, status_request_admin = 5
                    where no = ?", [$work_detail, $kind_request, $program_install_date, $yearly_no, $time,
                    $time_type, $end_detail, $no]);
            DB::update("update request_admin_approve set end_date = ? where fk_request_admin = ?", 
                        [$end_date, $no]);

            $track = DB::select('select track, sect_id from request_admin where no = ?', [$no]);
            $user = DB::select('select ad.name, ad.email from request_admin_approve ra
                                inner join ad_profile ad
                                on ra.user_charge = ad.employee_no
                                where fk_request_admin = ?', [$no]);

            /*$details = [
                'dear' => 'Dear '.$user[0]->name.',',
                'content1' => 'IT section has completed the request, please confirm to finish the job.',
                'content2' => 'Click link below for detail : ',
                'content3' => $track[0]->track,
                'thank' => 'Thank you',
                'sign' => 'IT Web'
            ];
    
            $toEmail = $user[0]->email;
    
            Mail::to($toEmail)->send(new RUConfirmUser($details));*/
        }
        else{
            DB::update("update request_admin set work_detail = ?, kind_request = ?, program_install_date = ?, 
                    yearly_no = ?, time = ?, time_type = ?, end_detail = ?, status_request_admin = ?
                    where no = ?", [$work_detail, $kind_request, $program_install_date, $yearly_no, $time,
                    $time_type, $end_detail, $status_request_admin, $no]);
        }

        return redirect()->back();
    }

    function showEditRequestAdmin($no){
        $request_admin = DB::table('request_admin')
                            ->select('request_admin.*',
                                     'section.sect_name')
                            ->leftjoin('section', 'request_admin.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_admin.no', '=', $no)
                            ->get();
                            
        $section = DB::select('select * from section');

        return view('request_system.request_admin.edit_request_admin', ['section' => $section, 'request_admin' => $request_admin]);
    }

    function showEditRequestAdminIT($no){
        $request_admin = DB::table('request_admin')
                            ->select('request_admin.*',
                                     'section.sect_name')
                            ->leftjoin('section', 'request_admin.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_admin.no', '=', $no)
                            ->get();
                            
        $section = DB::select('select * from section');

        return view('request_system.request_admin.edit_request_admin_it', ['section' => $section, 'request_admin' => $request_admin]);
    }

    function editRequestAdminIT(Request $request){

        $no = $request->input('no');
        $subject = $request->input('subject');
        $sect_id = $request->input('sect_id');
        $need_date = $request->input('need_date');
        $reason = $request->input('reason');
        $reference = $request->input('reference');
        $detail = $request->input('detail');
        $old_file = $request->input('old_file');
        $relate_sect = $request->input('relate_sect');
    
        $relate_sect = json_encode($relate_sect);
        $old_file = json_encode($old_file);

        if($request->file('files') != ""){
            $request->validate([
                'files' => 'required',
                'files.*' => 'mimes:pdf|max:5120'
            ]);
          
            if($request->hasfile('files')) {
                  foreach($request->file('files') as $file)
                  {
                      $filename = uniqid().".".$file->getClientOriginalName();
                      $file->move(public_path().'/file/request_admin/attach_file/', $filename);  
                      $fileData[] = $filename;  
                  }
    
                  $filename = json_encode($fileData);
            }
        }
        else{
            $filename = [];
        }

        if(!empty($old_file) && empty($filename)){
            $filename = [];
            $attach_file = DB::select("select attach_file from request_admin where no = ?", [$no]);
            $arr_attach_file = json_decode($attach_file[0]->attach_file);
            $old_file = json_decode($old_file);

            if(isset($arr_attach_file)){
                for($i=0;$i<count($arr_attach_file);$i++){
                    if($arr_attach_file[$i] == $old_file[$i]){
                        if($old_file[$i] != null){
                            $filename[] = $arr_attach_file[$i];
                        }
                    }
                }    
            }
        }
        else if(!empty($filename) && $old_file == "[null]"){
            $filename = json_decode($filename);
        }
        else if(!empty($filename) && $old_file != "[null]"){
            $filename = json_decode($filename);
            $old_file = json_decode($old_file);
            $arr_old_file = [];
            $count = 0;

            if($old_file != ""){
                $count = count($old_file);

                for($i=0;$i<$count;$i++){
                    if($old_file[$i] != null){
                        $arr_old_file[] = $old_file[$i];
                    }
                }  
                
                $filename = array_merge($arr_old_file, $filename);

            }
        }

        $filename = json_encode($filename);
   
        if($filename == '"[]"'){
            $filename = "";
        }

        DB::update('update request_admin set subject = ?, sect_id = ?, need_date = ?, reason = ?, reference = ?, detail = ?, attach_file = ?, relate_sect = ?  where no = ?', 
                                            [$subject, $sect_id, $need_date, $reason, $reference, $detail, $filename, $relate_sect, $no]);

        return redirect('/listrequestadmin/receieved');
    }

    function editRequestAdmin(Request $request){

        $no = $request->input('no');
        $subject = $request->input('subject');
        $sect_id = $request->input('sect_id');
        $need_date = $request->input('need_date');
        $reason = $request->input('reason');
        $reference = $request->input('reference');
        $detail = $request->input('detail');
        $old_file = $request->input('old_file');
        $relate_sect = $request->input('relate_sect');
    
        $relate_sect = json_encode($relate_sect);
        $old_file = json_encode($old_file);

        if($request->file('files') != ""){
            $request->validate([
                'files' => 'required',
                'files.*' => 'mimes:pdf|max:5120'
            ]);
          
            if($request->hasfile('files')) {
                  foreach($request->file('files') as $file)
                  {
                      $filename = uniqid().".".$file->getClientOriginalName();
                      $file->move(public_path().'/file/request_admin/attach_file/', $filename);  
                      $fileData[] = $filename;  
                  }
    
                  $filename = json_encode($fileData);
            }
        }
        else{
            $filename = [];
        }

        if(!empty($old_file) && empty($filename)){
            $filename = [];
            $attach_file = DB::select("select attach_file from request_admin where no = ?", [$no]);
            $arr_attach_file = json_decode($attach_file[0]->attach_file);
            $old_file = json_decode($old_file);

            if(isset($arr_attach_file)){
                for($i=0;$i<count($arr_attach_file);$i++){
                    if($arr_attach_file[$i] == $old_file[$i]){
                        if($old_file[$i] != null){
                            $filename[] = $arr_attach_file[$i];
                        }
                    }
                }    
            }
        }
        else if(!empty($filename) && $old_file == "[null]"){
            $filename = json_decode($filename);
        }
        else if(!empty($filename) && $old_file != "[null]"){
            $filename = json_decode($filename);
            $old_file = json_decode($old_file);
            $arr_old_file = [];
            $count = 0;

            if($old_file != ""){
                $count = count($old_file);

                for($i=0;$i<$count;$i++){
                    if($old_file[$i] != null){
                        $arr_old_file[] = $old_file[$i];
                    }
                }  
                
                $filename = array_merge($arr_old_file, $filename);

            }
        }

        $filename = json_encode($filename);
   
        if($filename == '"[]"'){
            $filename = "";
        }

        DB::update('update request_admin set subject = ?, sect_id = ?, need_date = ?, reason = ?, reference = ?, detail = ?, attach_file = ?, relate_sect = ?  where no = ?', 
                                            [$subject, $sect_id, $need_date, $reason, $reference, $detail, $filename, $relate_sect, $no]);

        return redirect('/listrequestadmin');
    }


    function deleteRequestAdmin($no){
        DB::delete('delete from request_admin where no = ?', [$no]);
        DB::delete('delete from request_admin_approve where fk_request_admin = ?', [$no]);

        return redirect()->back();
    }

    function addConfirmRequestAdmin($fk_request_admin, $employee_no){
        DB::update('update request_admin_approve set user_confirm = ?, date_user_confirm = ? where fk_request_admin = ?', [$employee_no, date('Y-m-d'), $fk_request_admin]);
        DB::update('update request_admin set status_request_admin = 6 where no = ?', [$fk_request_admin]);

        $track = DB::select('select track, sect_id from request_admin where no = ?', [$fk_request_admin]);
        $email = DB::select('select ad.email from request_admin_approve ua
                             inner join member mb
                             on mb.user_id = ua.charge
                             inner join ad_profile ad
                             on mb.employees_no = ad.employee_no
                             where ua.fk_request_admin = ?', [$fk_request_admin]);

        /*$details = [
            'dear' => 'Dear IT Admin,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been confirmed, please approve.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUConfirmReceive($details));*/

        return redirect()->back();
    }

    function addApproveEndRequestAdminCharge($fk_request_admin, $user_id){
        DB::update('update request_admin_approve set end_charge = ?, date_charge_confirm = ? where fk_request_admin = ?', [$user_id, date('Y-m-d'), $fk_request_admin]);

        $track = DB::select('select track, sect_id from request_admin where no = ?', [$fk_request_admin]);
        $email = DB::select('select ad.email from member mb
                              inner join ad_profile ad
                              on ad.employee_no = mb.employees_no
                              where mb.sub = 4 and mb.position = 2');

        /*$details = [
            'dear' => 'Dear Chief,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been confirmed by user, please approve for finish job.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUConfirmReceive($details));*/

        return redirect()->back();
    }

    function addApproveEndRequestAdminChief($fk_request_admin, $user_id){
        DB::update('update request_admin_approve set end_chief = ?, date_chief_confirm = ? where fk_request_admin = ?', [$user_id, date('Y-m-d'), $fk_request_admin]);

        $track = DB::select('select track, sect_id from request_admin where no = ?', [$fk_request_admin]);
        $email = DB::select('select ad.email from member mb
                              inner join ad_profile ad
                              on ad.employee_no = mb.employees_no
                              where mb.position = 1');

        /*$details = [
            'dear' => 'Dear Manager,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been confirmed by user, please approve for finish job.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];
        
        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUConfirmReceive($details));*/

        return redirect()->back();
    }

    function addApproveEndRequestAdminManager($fk_request_admin, $user_id){
        DB::update('update request_admin_approve set end_manager = ?, date_manger_confirm = ? where fk_request_admin = ?', [$user_id, date('Y-m-d'), $fk_request_admin]);
        DB::update('update request_admin set status_request_admin = 7 where no = ?', [$fk_request_admin]);

        return redirect()->back();
    }

    public static function approveRequestAdminChief($fk_request_admin, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select charge, chief from request_admin_approve where fk_request_admin = ? ', [$fk_request_admin]);

        if(!empty($datacheck[0]->chief)){
            echo Controller::getName($datacheck[0]->chief);
        }
        else if(!empty($datacheck[0]->charge)){
            if(session()->get('position') == 2 || session()->get('position') == 1){
                if(empty($datacheck[0]->chief)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestAdminChief(\''.$fk_request_admin.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }
        else{
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
        }
    }

    public static function approveRequestAdminManager($fk_request_admin, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select charge, manager, chief 
                                 from request_admin_approve where fk_request_admin = ? ', [$fk_request_admin]);

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
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestAdminManager(\''.$fk_request_admin.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
        }
        else if(!empty($datacheck[0]->charge)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
        else{
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
    }

    public static function approveEndRequestAdminCharge($fk_request_admin, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select charge, end_charge, user_confirm from request_admin_approve where fk_request_admin = ? ', [$fk_request_admin]);

        if(!empty($datacheck[0]->end_charge)){
            echo Controller::getName($datacheck[0]->end_charge);
        }
        else if(!empty($datacheck[0]->user_confirm && $datacheck[0]->charge == $user_id)){
            if(empty($datacheck[0]->end_charge)){
                if(empty($stamp[0]->stamp)){
                    echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                }else{
                    echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestAdminCharge(\''.$fk_request_admin.'\',\''.$user_id.'\')"> Approve</button>';
                }
            }
        }
        else{
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
        }
    }

    public static function confirmRequestAdmin($fk_request_admin, $employee_no){
        $stamp = DB::select('select signature from ad_profile where employee_no = ?', [$employee_no]);
        $status = DB::select ('select status_request_admin from request_admin where no = ?', [$fk_request_admin]);
        $datacheck = DB::select('select user_confirm from request_admin_approve where fk_request_admin = ? ',
                                 [$fk_request_admin]);

        if($status[0]->status_request_admin == 5){
            if(empty($stamp[0]->signature)){
                echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'>Confirm</button>";
            }else{
                echo '<button class="btn btn-primary btn-sm" onclick="confirmRequestAdmin(\''.$fk_request_admin.'\',\''.$employee_no.'\')"> Confirm</button>';
            }
        }
        else if($datacheck[0]->user_confirm != ""){
            echo '<i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>';
        }
        else if($datacheck[0]->user_confirm == ""){
            echo "<button class='btn btn-secondary btn-sm' disabled>Confirm</button>";
        }
    }

    public static function approveEndRequestAdminChief($fk_request_admin, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select end_charge, end_chief from request_admin_approve where fk_request_admin = ? ', [$fk_request_admin]);
        if(!empty($datacheck[0]->end_chief)){
            echo Controller::getName($datacheck[0]->end_chief);
        }
        else if(!empty($datacheck[0]->end_charge)){
            if(session()->get('position') == 2 || session()->get('position') == 1){
                if(empty($datacheck[0]->end_chief)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestAdminChief(\''.$fk_request_admin.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }
        else{
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
        }
    }

    public static function approveEndRequestAdminManager($fk_request_admin, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select end_charge, end_manager, end_chief 
                                 from request_admin_approve where fk_request_admin = ? ', [$fk_request_admin]);

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
                        echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestAdminManager(\''.$fk_request_admin.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
        }
        else if(!empty($datacheck[0]->end_charge) || !empty($datacheck[0]->end_chief)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
        else{
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
    }
    function reportPDFRequestAdmin($request_admin_no){

        $request_admin = DB::select('select ru.*, ra.*, sc.sect_name from request_admin ru 
                                    left join request_admin_approve ra
                                    on ru.no = ra.fk_request_admin
                                    left join section sc
                                    on sc.sect_id = ru.sect_id
                                    where ru.request_admin_no = ?', [$request_admin_no]);
        
        $pdf = PDF::loadView('request_system.request_admin.pdf_request_admin', ['request_admin' => $request_admin]);
        $pdf->setPaper('A4', 'portrait');
        
        return @$pdf->stream('manhour'.date('d-M-Y h-i').'.pdf');
    }

}
