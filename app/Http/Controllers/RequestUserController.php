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

class RequestUserController extends Controller
{
    
    function listRequestUser(){

        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.relate_sect_approve')
                            ->Orderby('no', 'DESC')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //foin for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.sect_id', '=', Cookie::get('section'))
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser', ['request_user' => $request_user, 'search_track_no' => $search_track_no,
                                                                    'search_subject'=> $search_subject, 'search_status' => $search_status]);

    }

    function searchlistRequestUser(){

        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //foin for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.sect_id', '=', Cookie::get('section'))
                            ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                            ->where('request_user.subject', 'LIKE', '%'.$search_subject.'%')
                            ->where('request_user.status_request_user', 'LIKE', '%'.$search_status.'%')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser', ['request_user' => $request_user, 'search_track_no' => $search_track_no,
                                                                    'search_subject'=> $search_subject, 'search_status' => $search_status]);

    }

    function showAddRequestUser(){
        $section = DB::select('select * from section');
        $prefix = DB::select('select * from prefix');
        return view('request_system.request_user.add_request_user', ['section' => $section, 'prefix' => $prefix]);

    }

    function showEditRequestUser($no){
        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                    'section.sect_name',
                                    'request_user_approve.user_charge',
                                    'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //foin for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.no', '=', $no)
                            ->get();

        $section = DB::select('select * from section');
        $prefix = DB::select('select * from prefix');

        return view('request_system.request_user.edit_request_user', ['request_user' => $request_user, 'section' => $section, 'prefix' => $prefix]);
    }

    function showEditRequestUserIT($no){
        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                    'section.sect_name',
                                    'request_user_approve.user_charge',
                                    'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //foin for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.no', '=', $no)
                            ->get();

        $section = DB::select('select * from section');
        $prefix = DB::select('select * from prefix');

        return view('request_system.request_user.edit_request_user_it', ['request_user' => $request_user, 'section' => $section, 'prefix' => $prefix]);
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
        $detail = $request->input('detail');
        $relate_sect = $request->input('relate_sect');
        $wireless = $request->input('wireless');
        $vpn = $request->input('vpn');
        $fileshare = $request->input('fileshare');
        $folderdetail = $request->input('folderdetail');
        $workstation = $request->input('workstation');
        $workstation_no = $request->input('workstation_no');
        $system_as400 = $request->input('system_as400');
        $track = NotifyrepairController::generateDigit(6);
        $relate_sect_approve = array();

        if(isset($relate_sect)){
            for($i=0;$i<count($relate_sect);$i++){
                $relate_sect_approve[] = 0;
            }
        }
        
        $email_ad = json_encode($email_ad);
        $as400_user = json_encode($as400_user);
        $emailonly = json_encode($emailonly);
        $adonly = json_encode($adonly);
        $employee_no = json_encode($employee_no);
        $prefix_id = json_encode($prefix_id);
        $name = json_encode($name);
        $surname = json_encode($surname);
        $position = json_encode($position);
        $wireless = json_encode($wireless);
        $vpn = json_encode($vpn);
        $fileshare = json_encode($fileshare);
        $folderdetail = json_encode($folderdetail);
        $workstation = json_encode($workstation);
        $workstation_no = json_encode($workstation_no);
        $system_as400 = json_encode($system_as400);
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

        DB::insert('insert into request_user (subject, sect_id, effective_date, detail, relate_sect, employee_no, prefix, name_user, surname_user,
                    position, email_ad, as400_user, email_only, ad_only, wireless, vpn, fileshare, folder_detail, workstation, workstation_no,
                    track, status_request_user, attach_file) 
                    values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                    [$subject, $sect_id, $effective_date, $detail, $relate_sect, $employee_no, $prefix_id, $name, $surname, $position, $email_ad,
                     $as400_user, $emailonly, $adonly, $wireless, $vpn, $fileshare, $folderdetail, $workstation, $workstation_no,
                     $track, 0, $filename]);

        $fk_request_user = DB::select('select no from request_user order by no desc limit 1');

        DB::insert('insert into request_user_approve (fk_request_user, user_charge, relate_sect_approve) values(?, ?, ?)', 
                    [$fk_request_user[0]->no, Cookie::get('employee_no'), $relate_sect_approve]);

        $details = [
            'dear' => 'Dear '.Cookie::get('name').',',
            'content1' => 'Your request has been successfully received.',
            'content2' => 'Your tracking number is '.$track,
            'content3' => $track,
            'content4' => '(This is an automated message, can\'t reply.)',
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = Cookie::get('email');

        Mail::to($toEmail)->send(new RUSendUser($details));

        //sendmail to chief
        $email = DB::select('select email, position from ad_profile where section = ?', [Cookie::get('section')]);

        foreach($email as $emails){
            if(strpos($emails->position, 'Chief') !== false){
                $details = [
                    'dear' => 'Dear Chief,',
                    'content1' => 'Please check and approve user request from member of your section.',
                    'content2' => 'Click link below for approve : ',
                    'content3' => $track,
                    'thank' => 'Thank you',
                    'sign' => 'IT Web'
                ];
        
                $toEmail = $emails->email;
                        
                Mail::to($toEmail)->send(new RUApproveSectUser($details));
            }
        }

        return redirect('/listrequestuser');
    }

    function deleteRequestUser($no){
        DB::delete('delete from request_user where no = ?', [$no]);
        DB::delete('delete from request_user_approve where fk_request_user = ?', [$no]);

        return redirect()->back();
    }

    function addConfirmRequestUser($fk_request_user, $employee_no){
        DB::update('update request_user_approve set user_confirm = ?, date_user_confirm = ? where fk_request_user = ?', [$employee_no, date('Y-m-d'), $fk_request_user]);
        DB::update('update request_user set status_request_user = 6 where no = ?', [$fk_request_user]);

        $track = DB::select('select track, sect_id from request_user where no = ?', [$fk_request_user]);
        $email = DB::select('select ad.email from request_user_approve ua
                             inner join member mb
                             on mb.user_id = ua.charge
                             inner join ad_profile ad
                             on mb.employees_no = ad.employee_no
                             where ua.fk_request_user = ?', [$fk_request_user]);

        $details = [
            'dear' => 'Dear IT Admin,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been confirmed, please approve.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUConfirmReceive($details));

        return redirect()->back();
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
            echo "<div class='bg-danger text-white'>รออนุมัติจากแผนกต้นสังกัด</div>";
        }
        if($status == 1){
            echo "<div class='bg-danger text-white'>รออนุมัติจากแผนกที่เกี่ยวข้อง</div>";
        }
        if($status == 2){
            echo "<div class='bg-warning text-white'>รอรับงาน</div>";
        }
        if($status == 3){
            echo "<div class='bg-primary text-white'>รับงานเรียบร้อย</div>";
        }
        if($status == 4){
            echo "<div class='bg-warning text-white'>กำลังดำเนินการ</div>";
        }
        if($status == 5){
            echo "<div class='bg-success text-white'>ดำเนินการแล้ว</div>";
        }
        if($status == 6){
            echo "<div class='bg-success text-white'>ดำเนินการแล้ว</div>";
        }
        if($status == 7){
            echo "<div class='bg-info text-white'>จบงานเรียบร้อย</div>";
        }
        if($status == 8){
            echo "<div class='bg-danger text-white'>ปฏิเสธรับงาน</div>";
        }
    }

    //part for it
    function listRequestUserIT(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";
        isset($_GET['search_charge']) != '' ? $search_charge = $_GET['search_charge'] : $search_charge = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.charge',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.status_request_user', '>=', '2')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);
        $section = DB::select('select * from section');
        $member = DB::select('select user_id, name from member where sub = 4');

        return view('request_system.request_user.listrequestuser_it', ['request_user' => $request_user, 'member' => $member, 
                    'section' => $section, 'search_track_no' => $search_track_no, 'search_subject'=> $search_subject, 
                    'search_status' => $search_status, 'search_section' => $search_section, 'search_date' => $search_date,
                    'search_charge' => $search_charge, 'search_request_no' => $search_request_no]);
 
    }

    function searchlistRequestUserIT(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";
        isset($_GET['search_charge']) != '' ? $search_charge = $_GET['search_charge'] : $search_charge = "";

        if($search_request_no != ''){
            $request_user = DB::table('request_user')
                                ->select('request_user.*',
                                            'section.sect_name',
                                            'request_user_approve.charge',
                                            'request_user_approve.user_charge',
                                            'request_user_approve.relate_sect_approve',
                                            )
                                ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                                ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                                ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                                ->where('request_user.status_request_user', '>=', '2')
                                ->where('request_user.request_user_no', 'LIKE', '%'.$search_request_no.'%')
                                ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                                ->where('section.sect_name', 'LIKE', '%'.$search_section)
                                ->where('request_user.subject', '=', $search_subject)
                                ->where('request_user.effective_date', 'LIKE', '%'.$search_date.'%')
                                ->where('request_user.status_request_user', 'LIKE', '%'.$search_status.'%')
                                ->orderBy('request_user.no', 'desc')
                                ->paginate(10);
        }
        else if($search_charge != ''){
            $request_user = DB::table('request_user')
                                ->select('request_user.*',
                                            'section.sect_name',
                                            'request_user_approve.charge',
                                            'request_user_approve.user_charge',
                                            'request_user_approve.relate_sect_approve',
                                            )
                                ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                                ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                                ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                                ->where('request_user.status_request_user', '>=', '2')
                                ->where('request_user_approve.charge', 'LIKE', '%'.$search_charge.'%')
                                ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                                ->where('section.sect_name', 'LIKE', '%'.$search_section)
                                ->where('request_user.subject', '=', $search_subject)
                                ->where('request_user.effective_date', 'LIKE', '%'.$search_date.'%')
                                ->where('request_user.status_request_user', 'LIKE', '%'.$search_status.'%')
                                ->orderBy('request_user.no', 'desc')
                                ->paginate(10);
        }
        else if($search_charge != '' && $search_request_no != ''){
            $request_user = DB::table('request_user')
                                ->select('request_user.*',
                                            'section.sect_name',
                                            'request_user_approve.charge',
                                            'request_user_approve.user_charge',
                                            'request_user_approve.relate_sect_approve',
                                            )
                                ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                                ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                                ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                                ->where('request_user.status_request_user', '>=', '2')
                                ->where('request_user.request_user_no', 'LIKE', '%'.$search_request_no.'%')
                                ->where('request_user_approve.charge', 'LIKE', '%'.$search_charge.'%')
                                ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                                ->where('section.sect_name', 'LIKE', '%'.$search_section)
                                ->where('request_user.subject', '=', $search_subject)
                                ->where('request_user.effective_date', 'LIKE', '%'.$search_date.'%')
                                ->where('request_user.status_request_user', 'LIKE', '%'.$search_status.'%')
                                ->orderBy('request_user.no', 'desc')
                                ->paginate(10);
        }
        else{
            $request_user = DB::table('request_user')
                                ->select('request_user.*',
                                            'section.sect_name',
                                            'request_user_approve.charge',
                                            'request_user_approve.user_charge',
                                            'request_user_approve.relate_sect_approve',
                                            )
                                ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                                ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                                ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                                ->where('request_user.status_request_user', '>=', '2')
                                ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                                ->where('section.sect_name', 'LIKE', '%'.$search_section)
                                ->where('request_user.subject', '=', $search_subject)
                                ->where('request_user.effective_date', 'LIKE', '%'.$search_date.'%')
                                ->where('request_user.status_request_user', 'LIKE', '%'.$search_status.'%')
                                ->orderBy('request_user.no', 'desc')
                                ->paginate(10);
        }
        
        $section = DB::select('select * from section');
        $member = DB::select('select user_id, name from member where sub = 4');

        return view('request_system.request_user.listrequestuser_it', ['request_user' => $request_user, 'member' => $member, 
                    'section' => $section, 'search_track_no' => $search_track_no, 'search_subject'=> $search_subject, 
                    'search_status' => $search_status, 'search_section' => $search_section, 'search_date' => $search_date,
                    'search_charge' => $search_charge, 'search_request_no' => $search_request_no]);
 
    }

    function listRequestUserReceieved(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.charge',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.relate_sect_approve',
                                     'request_user_approve.end_date')
                            ->leftjoin('request_user_approve', 'request_user.no', '=', 'request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id')
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id')
                            ->where('request_user_approve.charge', '=', session()->get('user_id'))
                            ->where('request_user.status_request_user', '>=', '3')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);
        $section = DB::select('select * from section');
        $prefix = DB::select('select * from prefix');
        $member = DB::select('select user_id, name from member where sub = 4');

        return view('request_system.request_user.listrequestuser_received', ['request_user' => $request_user, 'section' => $section,
                    'prefix' => $prefix, 'member' => $member,'search_track_no' => $search_track_no, 'search_subject'=> $search_subject, 
                    'search_status' => $search_status, 'search_section' => $search_section, 'search_date' => $search_date,
                    'search_request_no' => $search_request_no]);
 
    }

    function searchlistRequestUserReceieved(){

        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.charge',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.relate_sect_approve',
                                     'request_user_approve.end_date')
                            ->leftjoin('request_user_approve', 'request_user.no', '=', 'request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id')
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id')
                            ->where('request_user_approve.charge', '=', session()->get('user_id'))
                            ->where('request_user.status_request_user', '>=', '3')
                            ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                            ->where('section.sect_name', 'LIKE', '%'.$search_section)
                            ->where('request_user.subject', '=', $search_subject)
                            ->where('request_user.effective_date', 'LIKE', '%'.$search_date.'%')
                            ->where('request_user.status_request_user', 'LIKE', '%'.$search_status.'%')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);
        $section = DB::select('select * from section');
        $prefix = DB::select('select * from prefix');
        $member = DB::select('select user_id, name from member where sub = 4');

        return view('request_system.request_user.listrequestuser_received', ['request_user' => $request_user, 'section' => $section,
                    'prefix' => $prefix, 'member' => $member,'search_track_no' => $search_track_no, 'search_subject'=> $search_subject, 
                    'search_status' => $search_status, 'search_section' => $search_section, 'search_date' => $search_date]);
 
    }

    function assignRequestUser(Request $request){
        $no = $request->input('no');
        $charge = $request->input('charge');
        $request_user_no = $this->genRequestUserNo();

        DB::update('update request_user set request_user_no = ? where no = ?', [$request_user_no, $no]);
        DB::update('update request_user_approve set charge = ? where fk_request_user = ? ', [$charge, $no]);

        return redirect()->back();
    }

    function refuseRequestUser(Request $request){
        $no = $request->input('no');
        $refuse_detail = $request->input('refuse_detail');
        $request_user_no = $this->genRequestUserNo();

        DB::update('update request_user set request_user_no = ?, refuse_detail = ?, status_request_user = 8 where no = ? ', [$request_user_no, $refuse_detail, $no]);

        return redirect()->back();
    }

    function listRequestUserApprove(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.fk_request_user',
                                     'request_user_approve.relate_sect_approve',
                                     'request_user_approve.charge',
                                     'request_user_approve.end_charge')
                            ->leftjoin('request_user_approve', 'request_user.no', '=', 'request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id')
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id')
                            ->where('request_user.status_request_user', '>=', '1')
                            ->whereNotNull('request_user_approve.charge')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        $section = DB::select('select * from section');

        return view('request_system.request_user.listrequestuser_approve', ['request_user' => $request_user,
                    'section' => $section, 'search_track_no' => $search_track_no, 
                    'search_subject'=> $search_subject, 'search_section' => $search_section, 
                    'search_date' => $search_date, 'search_request_no' => $search_request_no]);
    }

    function searchlistRequestUserApprove(){

        isset($_GET['search_request_no']) != '' ? $search_request_no = $_GET['search_request_no'] : $search_request_no = "";
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";
        isset($_GET['search_section']) != '' ? $search_section = $_GET['search_section'] : $search_section = "";
        isset($_GET['search_date']) != '' ? $search_date = $_GET['search_date'] : $search_date = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.fk_request_user',
                                     'request_user_approve.relate_sect_approve',
                                     'request_user_approve.charge',
                                     'request_user_approve.end_charge')
                            ->leftjoin('request_user_approve', 'request_user.no', '=', 'request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id')
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id')
                            ->where('request_user.status_request_user', '>=', '1')
                            ->where('request_user.request_user_no', 'LIKE', '%'.$search_request_no.'%')
                            ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                            ->where('section.sect_name', 'LIKE', '%'.$search_section)
                            ->where('request_user.subject', '=', $search_subject)
                            ->where('request_user.effective_date', 'LIKE', '%'.$search_date.'%')
                            ->whereNotNull('request_user_approve.charge')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        $section = DB::select('select * from section');

        return view('request_system.request_user.listrequestuser_approve', ['request_user' => $request_user,
                    'section' => $section, 'search_track_no' => $search_track_no, 
                    'search_subject'=> $search_subject, 'search_section' => $search_section, 
                    'search_date' => $search_date, 'search_request_no' => $search_request_no]);
    }

    function addApproveRequestUserChief($fk_request_user, $user_id){
        DB::update('update request_user_approve set chief = ? where fk_request_user = ?', [$user_id, $fk_request_user]);

        $track = DB::select('select track, sect_id from request_user where no = ?', [$fk_request_user]);
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

        Mail::to($toEmail)->send(new RUConfirmReceive($details));

        return redirect()->back();
    }

    function addApproveRequestUserManager($fk_request_user, $user_id){
        $request_user_no = $this->genRequestUserNo();
        $track = DB::select('select track, sect_id from request_user where no = ?', [$fk_request_user]);
        $email = DB::select('select ad.email from request_user_approve ua
                             inner join member mb
                             on mb.user_id = ua.charge
                             inner join ad_profile ad
                             on mb.employees_no = ad.employee_no
                             where ua.fk_request_user = ?', [$fk_request_user]);

        //DB::update('update request_user set request_user_no = ?, status_request_user = 3 where no = ?', [$request_user_no, $fk_request_user]);
        DB::update('update request_user_approve set manager = ? where fk_request_user = ?', [$user_id, $fk_request_user]);
        //DB::update('update request_user set status_request_user = 3 where no = ?', [$fk_request_user]);

        $details = [
            'dear' => 'Dear IT Admin,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been authorized by the manager, please proceed.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUChargeReceive($details));

        return redirect()->back();
    }

    function addApproveEndRequestUserCharge($fk_request_user, $user_id){
        DB::update('update request_user_approve set end_charge = ?, date_charge_confirm = ? where fk_request_user = ?', [$user_id, date('Y-m-d'), $fk_request_user]);

        $track = DB::select('select track, sect_id from request_user where no = ?', [$fk_request_user]);
        $email = DB::select('select ad.email from member mb
                              inner join ad_profile ad
                              on ad.employee_no = mb.employees_no
                              where mb.sub = 4 and mb.position = 2');

        $details = [
            'dear' => 'Dear Chief,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been confirmed by user, please approve for finish job.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUConfirmReceive($details));

        return redirect()->back();
    }

    function addApproveEndRequestUserChief($fk_request_user, $user_id){
        DB::update('update request_user_approve set end_chief = ?, date_chief_confirm = ? where fk_request_user = ?', [$user_id, date('Y-m-d'), $fk_request_user]);

        $track = DB::select('select track, sect_id from request_user where no = ?', [$fk_request_user]);
        $email = DB::select('select ad.email from member mb
                              inner join ad_profile ad
                              on ad.employee_no = mb.employees_no
                              where mb.position = 1');

        $details = [
            'dear' => 'Dear Manager,',
            'content1' => 'The user request from '.Controller::getSection($track[0]->sect_id).' section has been confirmed by user, please approve for finish job.',
            'content2' => 'Click link below for detail : ',
            'content3' => $track[0]->track,
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];
        
        $toEmail = $email[0]->email;

        Mail::to($toEmail)->send(new RUConfirmReceive($details));

        return redirect()->back();
    }

    function addApproveEndRequestUserManager($fk_request_user, $user_id){
        DB::update('update request_user_approve set end_manager = ?, date_manger_confirm = ? where fk_request_user = ?', [$user_id, date('Y-m-d'), $fk_request_user]);
        DB::update('update request_user set status_request_user = 7 where no = ?', [$fk_request_user]);

        return redirect()->back();
    }

    function updateRequestUser(Request $request){
        $no = $request->input('no');
        $status_request_user = $request->input('status_request_user');
        $work_detail = $request->input('work_detail');
        $end_date = $request->input('end_date');
        $program_install_date = $request->input("program_install_date");
        $yearly_no = $request->input("yearly_no");
        $time = $request->input("time");
        $time_type = $request->input("time_type");
        $end_detail = $request->input("end_detail");

        if($status_request_user == 5){
            DB::update("update request_user set work_detail = ?, program_install_date = ?, 
                    yearly_no = ?, time = ?, time_type = ?, end_detail = ?, status_request_user = 5
                    where no = ?", [$work_detail, $program_install_date, $yearly_no, $time,
                    $time_type, $end_detail, $no]);
            DB::update("update request_user_approve set end_date = ? where fk_request_user = ?", 
                        [$end_date, $no]);

            $track = DB::select('select track, sect_id from request_user where no = ?', [$no]);
            $user = DB::select('select ad.name, ad.email from request_user_approve ra
                                inner join ad_profile ad
                                on ra.user_charge = ad.employee_no
                                where fk_request_user = ?', [$no]);

            $details = [
                'dear' => 'Dear '.$user[0]->name.',',
                'content1' => 'IT section has completed the request, please confirm to finish the job.',
                'content2' => 'Click link below for detail : ',
                'content3' => $track[0]->track,
                'thank' => 'Thank you',
                'sign' => 'IT Web'
            ];
    
            $toEmail = $user[0]->email;
    
            Mail::to($toEmail)->send(new RUConfirmUser($details));
        }
        else{
            DB::update("update request_user set work_detail = ?, program_install_date = ?, 
                    yearly_no = ?, time = ?, time_type = ?, end_detail = ?, status_request_user = ?
                    where no = ?", [$work_detail, $program_install_date, $yearly_no, $time,
                    $time_type, $end_detail, $status_request_user, $no]);
        }

        return redirect()->back();
    }

    function editRequestUser(Request $request){

        $no = $request->input('no');
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
        $detail = $request->input('detail');
        $relate_sect = $request->input('relate_sect');
        $wireless = $request->input('wireless');
        $vpn = $request->input('vpn');
        $fileshare = $request->input('fileshare');
        $folderdetail = $request->input('folderdetail');
        $workstation = $request->input('workstation');
        $workstation_no = $request->input('workstation_no');
        $system_as400 = $request->input('system_as400');
        $old_file = $request->input('old_file');
        $relate_sect_approve = array();

        if(isset($relate_sect)){
            for($i=0;$i<count($relate_sect);$i++){
                $relate_sect_approve[] = 0;
            }
        }
        
        $email_ad = json_encode($email_ad);
        $as400_user = json_encode($as400_user);
        $emailonly = json_encode($emailonly);
        $adonly = json_encode($adonly);
        $employee_no = json_encode($employee_no);
        $prefix_id = json_encode($prefix_id);
        $name = json_encode($name);
        $surname = json_encode($surname);
        $position = json_encode($position);
        $wireless = json_encode($wireless);
        $vpn = json_encode($vpn);
        $fileshare = json_encode($fileshare);
        $folderdetail = json_encode($folderdetail);
        $workstation = json_encode($workstation);
        $workstation_no = json_encode($workstation_no);
        $system_as400 = json_encode($system_as400);
        $relate_sect = json_encode($relate_sect);
        $relate_sect_approve = json_encode($relate_sect_approve);
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
                      $file->move(public_path().'/file/request_user/attach_file/', $filename);  
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
            $filename = json_encode($filename);
        }
        else if(!empty($filename) && $old_file != "[null]"){
            $old_file = json_decode($old_file);
            $filename = json_decode($filename);
            $arr_old_file = [];

            for($i=0;$i<count($old_file);$i++){
                if($old_file[$i] != null){
                    $arr_old_file = $old_file[$i];
                }
            }

            $filename = array_merge(json_decode($arr_old_file), $filename);
        }

        $filename = json_encode($filename);

        if($filename == '"[]"'){
            $filename = "";
        }

       DB::update('update request_user set subject = ?, email_ad = ?, as400_user = ?, email_only = ?, ad_only = ?,
                    employee_no = ?, prefix = ?, name_user = ?, surname_user = ?, position = ?, sect_id = ?, detail = ?,
                    relate_sect = ?, wireless = ?, vpn = ?, fileshare = ?, folder_detail = ?, workstation = ?, 
                    workstation_no = ?, effective_date = ?, attach_file = ? where no = ?', 
                    [$subject, $email_ad, $as400_user, $emailonly, $adonly, $employee_no, $prefix_id, $name, $surname,
                    $position, $sect_id, $detail, $relate_sect, $wireless, $vpn, $fileshare, $folderdetail, $workstation,
                    $workstation_no, $effective_date, $filename, $no]);

        return redirect('/listrequestuser');
    }

    function recieveRequestUserIT($no){
        
        DB::update('update request_user_approve set charge = ? where fk_request_user = ?', [session()->get('user_id'), $no]);

        return redirect()->back();

    }

    function genRequestUserNo(){
        $year = date('y');
        $month = date('m');
        $str1 = "AU";
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

        $request_user = DB::select('select ru.*, ra.*, sc.sect_name from request_user ru 
                                    left join request_user_approve ra
                                    on ru.no = ra.fk_request_user
                                    left join section sc
                                    on sc.sect_id = ru.sect_id
                                    where ru.request_user_no = ?', [$request_user_no]);
        
        $pdf = PDF::loadView('request_system.request_user.pdf_request_user', ['request_user' => $request_user]);
        $pdf->setPaper('A4', 'portrait');
        
        return @$pdf->stream('manhour'.date('d-M-Y h-i').'.pdf');
    }

    function listRequestUserApproveSection(){
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.sect_id', '=', Cookie::get('section'))
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser_approve_sect', ['request_user' => $request_user, 'search_track_no' => $search_track_no,
                                                                                 'search_subject'=> $search_subject]);
    }

    function searchlistRequestUserApproveSection(){
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.sect_id', '=', Cookie::get('section'))
                            ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                            ->where('request_user.subject', 'LIKE', '%'.$search_subject.'%')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser_approve_sect', ['request_user' => $request_user, 'search_track_no' => $search_track_no,
                                                                                 'search_subject'=> $search_subject]);
    }

    public static function approveRequestUserChief($fk_request_user, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select charge, chief from request_user_approve where fk_request_user = ? ', [$fk_request_user]);

        if(!empty($datacheck[0]->chief)){
            echo Controller::getName($datacheck[0]->chief);
        }
        else if(!empty($datacheck[0]->charge)){
            if(session()->get('position') == 2 || session()->get('position') == 1){
                if(empty($datacheck[0]->chief)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestUserChief(\''.$fk_request_user.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }
    }

    public static function approveRequestUserManager($fk_request_user, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select charge, manager, chief 
                                 from request_user_approve where fk_request_user = ? ', [$fk_request_user]);

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
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestUserManager(\''.$fk_request_user.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
        }
        else if(!empty($datacheck[0]->charge)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
    }

    public static function approveEndRequestUserCharge($fk_request_user, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select charge, end_charge, user_confirm from request_user_approve where fk_request_user = ? ', [$fk_request_user]);

        if(!empty($datacheck[0]->end_charge)){
            echo Controller::getName($datacheck[0]->end_charge);
        }
        else if(!empty($datacheck[0]->user_confirm && $datacheck[0]->charge == $user_id)){
            if(empty($datacheck[0]->end_charge)){
                if(empty($stamp[0]->stamp)){
                    echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                }else{
                    echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestUserCharge(\''.$fk_request_user.'\',\''.$user_id.'\')"> Approve</button>';
                }
            }
        }
        else{
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
        }
    }

    public static function approveEndRequestUserChief($fk_request_user, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select end_charge, end_chief from request_user_approve where fk_request_user = ? ', [$fk_request_user]);
        if(!empty($datacheck[0]->end_chief)){
            echo Controller::getName($datacheck[0]->end_chief);
        }
        else if(!empty($datacheck[0]->end_charge)){
            if(session()->get('position') == 2 || session()->get('position') == 1){
                if(empty($datacheck[0]->end_chief)){
                    if(empty($stamp[0]->stamp)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestUserChief(\''.$fk_request_user.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }
    }

    public static function approveEndRequestUserManager($fk_request_user, $user_id){
        $stamp = DB::select('select stamp from member where user_id = ?', [$user_id]);
        $datacheck = DB::select('select end_charge, end_manager, end_chief 
                                 from request_user_approve where fk_request_user = ? ', [$fk_request_user]);

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
                        echo '<button class="btn btn-primary btn-sm" onclick="approveEndRequestUserManager(\''.$fk_request_user.'\',\''.$user_id.'\')"> Approve</button>';
                    }
                }
            }
        }
        else if(!empty($datacheck[0]->end_charge) || !empty($datacheck[0]->end_chief)){
            echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>"; 
        }
    }

    public static function approveRequestUserSectChief($fk_request_user, $employee_no){

        $stamp = DB::select('select signature from ad_profile where employee_no = ?', [$employee_no]);
        $datacheck = DB::select('select user_charge, user_chief from request_user_approve where fk_request_user = ? ',
                                 [$fk_request_user]);

        if(!empty($datacheck[0]->user_chief)){
            echo Controller::getNameAD($datacheck[0]->user_chief);
        }
        else if(!empty($datacheck[0]->user_charge)){
            if(strpos(Cookie::get('position'), 'Mgr') !== false || strpos(Cookie::get('position'), 'Chief') !== false){
                if(empty($datacheck[0]->user_chief)){
                    if(empty($stamp[0]->signature)){
                        echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Approve</button>";
                    }else{
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestUserSectChief(\''.$fk_request_user.'\',\''.$employee_no.'\')"> Approve</button>';
                    }
                }
            }
            else{
                echo "<button class='btn btn-secondary btn-sm' disabled> Approve</button>";
            }
        }

    }

    public static function approveRequestUserSectManager($fk_request_user, $employee_no){
        $stamp = DB::select('select signature from ad_profile where employee_no = ?', [$employee_no]);
        $datacheck = DB::select('select user_charge, user_manager, user_chief 
                                 from request_user_approve where fk_request_user = ? ', [$fk_request_user]);
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
                        echo '<button class="btn btn-primary btn-sm" onclick="approveRequestUserSectManager(\''.$fk_request_user.'\',\''.$employee_no.'\')"> Approve</button>';
                    }
                }
            }
        }
    }

    public static function approveRequestUserRelateSect($fk_request_user, $employee_no, $seq){
        $relate_sect_approve = DB::select("select relate_sect_approve from request_user_approve where fk_request_user = ?", [$fk_request_user]);
        $arr_relate_sect_approve = json_decode($relate_sect_approve[0]->relate_sect_approve);

        if($arr_relate_sect_approve[$seq] != 0){
            echo '<i class="fa fa-check-circle text-success fa-2x" aria-hidden="true"></i>';
        }
        else{
            if(strpos(Cookie::get('position'), 'Mgr') !== false){
                echo '<button class="btn btn-primary btn-sm" onclick="approveRequestUserRelateSect(\''.$fk_request_user.'\',\''.$employee_no.'\',\''.$seq.'\')"> Approve</button>';
            }
            else{
                echo '<button class="btn btn-secondary btn-sm" disabled> Approve</button>';
            }
        }
    }

    function addApproveRequestUserSectChief($fk_request_user, $employee_no){
        DB::update('update request_user_approve set user_chief = ? where fk_request_user = ?', [$employee_no, $fk_request_user]);

        //sendmail to manager
        $track = DB::select('select track from request_user where no = ?', [$fk_request_user]);
        $email = DB::select('select email, position from ad_profile where section = ?', [Cookie::get('section')]);

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
        }

        return redirect()->back();
    }

    function addApproveRequestUserSectManager($fk_request_user, $employee_no){
        $request_user = DB::select("select relate_sect, sect_id from request_user where no = ?", [$fk_request_user]);
        $request_user_approve = DB::select("select relate_sect_approve from request_user_approve where fk_request_user = ?", [$fk_request_user]);
        $track = DB::select('select track from request_user where no = ?', [$fk_request_user]);
        $arr_fk_request_user = json_decode($request_user_approve[0]->relate_sect_approve);
        $arr_relate_sect = json_decode($request_user[0]->relate_sect);
        
        if(count($arr_fk_request_user) != 0){
            for($i=0;$i<count($arr_fk_request_user);$i++){
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
            }

            DB::update('update request_user_approve set user_manager = ? where fk_request_user = ?', [$employee_no, $fk_request_user]);
            DB::update('update request_user set status_request_user = 1 where no = ?', [$fk_request_user]);
        }
        else{
            DB::update('update request_user_approve set user_manager = ? where fk_request_user = ?', [$employee_no, $fk_request_user]);
            DB::update('update request_user set status_request_user = 2 where no = ?', [$fk_request_user]);
        }

        return redirect()->back();
    }

    function listRequestUserApproveRelatesect(){
        
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.user_manager',
                                     'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser_approve_relatesect', ['request_user' => $request_user, 'search_track_no' => $search_track_no,
                                                                                       'search_subject'=> $search_subject]);
    }

    function searchlistRequestUserApproveRelatesect(){
        
        isset($_GET['search_track_no']) != '' ? $search_track_no = $_GET['search_track_no'] : $search_track_no = "";
        isset($_GET['search_subject']) != '' ? $search_subject = $_GET['search_subject'] : $search_subject = "";

        $request_user = DB::table('request_user')
                            ->select('request_user.*',
                                     'section.sect_name',
                                     'request_user_approve.user_charge',
                                     'request_user_approve.user_manager',
                                     'request_user_approve.relate_sect_approve')
                            ->leftjoin('request_user_approve', 'request_user.no', '=','request_user_approve.fk_request_user')
                            ->leftjoin('prefix', 'request_user.prefix', '=', 'prefix.prefix_id') //join for prefix add
                            ->leftjoin('section', 'request_user.sect_id', '=', 'section.sect_id') //join for section add
                            ->where('request_user.track', 'LIKE', '%'.$search_track_no.'%')
                            ->where('request_user.subject', 'LIKE', '%'.$search_subject.'%')
                            ->orderBy('request_user.no', 'desc')
                            ->paginate(10);

        return view('request_system.request_user.listrequestuser_approve_relatesect', ['request_user' => $request_user, 'search_track_no' => $search_track_no,
                                                                                       'search_subject'=> $search_subject]);
    }

    function addApproveRequestUserRelateSect($fk_request_user, $employee_no, $seq){ 
        $relate_sect_approve = DB::select("select relate_sect_approve from request_user_approve where fk_request_user = ?", [$fk_request_user]);
        $email = DB::select('select ad.email from member mb
                              inner join ad_profile ad
                              on ad.employee_no = mb.employees_no
                              where mb.sub = 4 and mb.position = 2');
        $track = DB::select('select track from request_user where no = ?', [$fk_request_user]);
        $section = DB::select('select sect_id from request_user where no = ?', [$fk_request_user]);
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
    
            DB::update('update request_user_approve set relate_sect_approve = ? where fk_request_user = ?', [$arr_relate_sect_approve, $fk_request_user]);
            DB::update('update request_user set status_request_user = 2 where no = ?', [$fk_request_user]);

            $details = [
                'dear' => 'Dear IT Admin,',
                'content1' => 'Please check and receive user request from '.Controller::getSection($section[0]->sect_id).' section.',
                'content2' => 'Click link below for approve : ',
                'content3' => $track[0]->track,
                'thank' => 'Thank you',
                'sign' => 'IT Web'
            ];
    
            $toEmail = $email[0]->email; 

            Mail::to($toEmail)->send(new RUReceive($details));
        }
        else{
            $arr_relate_sect_approve[$seq] = $employee_no;
            $arr_relate_sect_approve = json_encode($arr_relate_sect_approve);
    
            DB::update('update request_user_approve set relate_sect_approve = ? where fk_request_user = ?', [$arr_relate_sect_approve, $fk_request_user]);
        }

        return redirect()->back();
    }

    public static function getPrefix($prefix_id){
        $data = DB::select("select prefix_name from prefix where prefix_id = ?", [$prefix_id]);

        return $data[0]->prefix_name;
    }

    public static function confirmRequestUser($fk_request_user, $employee_no){
        $stamp = DB::select('select signature from ad_profile where employee_no = ?', [$employee_no]);
        $status = DB::select ('select status_request_user from request_user where no = ?', [$fk_request_user]);
        $datacheck = DB::select('select user_confirm from request_user_approve where fk_request_user = ? ',
                                 [$fk_request_user]);

        if($status[0]->status_request_user == 5){
            if(empty($stamp[0]->signature)){
                echo "<button class='btn btn-primary btn-sm' onclick='notsignature()'> Confirm</button>";
            }else{
                echo '<button class="btn btn-primary btn-sm" onclick="confirmRequestUser(\''.$fk_request_user.'\',\''.$employee_no.'\')"> Confirm</button>';
            }
        }
        else if($datacheck[0]->user_confirm != ""){
            echo '<i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>';
        }
        else if($datacheck[0]->user_confirm == ""){
            echo "<button class='btn btn-secondary btn-sm' disabled> Confirm</button>";
        }

    }

}
