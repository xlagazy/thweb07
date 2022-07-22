<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Mail; 
use App\Mail\NotifyrepairMemberMail;
use App\Mail\NotifyrepairUserMail;
use App\Mail\NotifyrepairReturnMail;

use Image; 
use DB;

class NotifyrepairController extends Controller
{
    // static variable status
    public static $status = array(
        "0" => "ยังไม่ได้รับงาน",
        "1" => "รับงาน",
        "2" => "ขอใบ Request",
        "3" => "กำลังดำเนินการ",
        "4" => "เสร็จสิ้น"
    );
    
    function notifyRepair(){

        $section = DB::select('select * from section order by sect_name');
        $noti_subject = DB::select("select * from noti_subject");
        $noti_repair = DB::select('select track from noti_repair');

        $notirepair = DB::table('noti_repair')
                        ->join('section', 'section.sect_id', '=', 'noti_repair.sect_id')
                        ->join('noti_subject', 'noti_subject.noti_subject_no', '=', 'noti_repair.noti_subject_no')
                        ->leftjoin('noti_charge', 'noti_charge.noti_repair_no', '=', 'noti_repair.noti_repair_no')
                        ->leftjoin('member', 'member.user_id', '=', 'noti_charge.user_id')
                        ->select('noti_repair.noti_repair_no',
                                 'noti_repair.name_user',
                                 'noti_repair.email',
                                 'section.sect_id',
                                 'section.sect_name',
                                 'noti_repair.location',
                                 'noti_repair.tel',
                                 'noti_repair.noti_subject_no',
                                 'noti_repair.detail',
                                 'noti_repair.date',
                                 'noti_repair.track',
                                 'noti_repair.sign',
                                 'noti_repair.images',
                                 'noti_repair.status_noti_repair',
                                 'noti_subject.noti_subject_no',
                                 'noti_subject.noti_subject_name',
                                 'noti_charge.start_date',
                                 'noti_charge.end_date',
                                 'noti_charge.result',
                                 'noti_charge.remark',
                                 'member.user_id',
                                 'member.name')
                        ->orderBy('noti_repair.noti_repair_no', 'DESC')
                        ->paginate(10);

        return view('notifyrepair.notify_repair', ['section' => $section, 'noti_subject' => $noti_subject, 
                    'noti_repair' => $noti_repair, 'notirepair' => $notirepair, 'status' => static::$status]);

    }

    function listNotifyRepair(){

        $notirepair = DB::table('noti_repair')
                        ->join('section', 'section.sect_id', '=', 'noti_repair.sect_id')
                        ->join('noti_subject', 'noti_subject.noti_subject_no', '=', 'noti_repair.noti_subject_no')
                        ->leftjoin('noti_charge', 'noti_charge.noti_repair_no', '=', 'noti_repair.noti_repair_no')
                        ->leftjoin('member', 'member.user_id', '=', 'noti_charge.user_id')
                        ->select('noti_repair.noti_repair_no',
                                 'noti_repair.name_user',
                                 'noti_repair.email',
                                 'section.sect_id',
                                 'section.sect_name',
                                 'noti_repair.location',
                                 'noti_repair.tel',
                                 'noti_repair.noti_subject_no',
                                 'noti_repair.detail',
                                 'noti_repair.date',
                                 'noti_repair.track',
                                 'noti_repair.sign',
                                 'noti_repair.images',
                                 'noti_repair.status_noti_repair',
                                 'noti_subject.noti_subject_no',
                                 'noti_subject.noti_subject_name',
                                 'noti_charge.start_date',
                                 'noti_charge.end_date',
                                 'noti_charge.result',
                                 'noti_charge.remark',
                                 'member.user_id',
                                 'member.name')
                        //->where('noti_repair.status_noti_repair', '=', '0')
                        ->orderBy('noti_repair.noti_repair_no', 'DESC')
                        ->paginate(10);
        $section = DB::select('select * from section order by sect_name');
        $noti_subject = DB::select('select * from noti_subject');

        return view('notifyrepair.listnotifyrepair', ['notirepair' => $notirepair, 'section' => $section, 'noti_subject' => $noti_subject, 'status' => static::$status]);

    }

    function recieveNotifyRepair(){

        $notirepair = DB::table('noti_repair')
                        ->join('section', 'section.sect_id', '=', 'noti_repair.sect_id')
                        ->join('noti_subject', 'noti_subject.noti_subject_no', '=', 'noti_repair.noti_subject_no')
                        ->leftjoin('noti_charge', 'noti_charge.noti_repair_no', '=', 'noti_repair.noti_repair_no')
                        ->leftjoin('member', 'member.user_id', '=', 'noti_charge.user_id')
                        ->select('noti_repair.noti_repair_no',
                                 'noti_repair.name_user',
                                 'noti_repair.email',
                                 'section.sect_id',
                                 'section.sect_name',
                                 'noti_repair.location',
                                 'noti_repair.tel',
                                 'noti_repair.noti_subject_no',
                                 'noti_repair.detail',
                                 'noti_repair.date',
                                 'noti_repair.track',
                                 'noti_repair.sign',
                                 'noti_repair.images',
                                 'noti_repair.status_noti_repair',
                                 'noti_subject.noti_subject_no',
                                 'noti_subject.noti_subject_name',
                                 'noti_charge.start_date',
                                 'noti_charge.end_date',
                                 'noti_charge.result',
                                 'noti_charge.remark',
                                 'member.user_id',
                                 'member.name')
                        ->where('member.user_id', '=', session()->get('user_id'))
                        ->where('noti_repair.status_noti_repair', '<>', '0')
                        ->orderBy('noti_repair.noti_repair_no', 'DESC')
                        ->paginate(10);
        $section = DB::select('select * from section order by sect_name');
        $noti_subject = DB::select('select * from noti_subject');

        return view('notifyrepair.recievenotifyrepair', ['notirepair' => $notirepair, 'section' => $section, 'noti_subject' => $noti_subject, 'status' => static::$status]);

    }

    function addReceiveNotifyRepair($status, $noti_repair_no){

        DB::update('update noti_repair set status_noti_repair = ? where noti_repair_no = ?',
                    [$status, $noti_repair_no]);

        $noti_repair = DB::select('select email, track, images from noti_repair where noti_repair_no = ? limit 1', [$noti_repair_no]);

        $name = session()->get('name');

        if($status == 1){
            DB::update('update noti_charge set user_id = ? where noti_repair_no = ?', [session()->get('user_id'), $noti_repair_no]);
        }

        if($status == 2){

            $status_return_mail = DB::select('select status_return_mail from noti_repair where noti_repair_no = ?', [$noti_repair_no]);
            
            if($status_return_mail[0]->status_return_mail != 1){

                DB::update('update noti_repair set status_return_mail = 1 where noti_repair_no = ?', [$noti_repair_no]);

                //send mail to user 
        
                $details = [
                    'dear' => 'Dear '.$name.',',
                    'content1' => 'แจ้งซ่อมหมายเลข : '.$noti_repair[0]->track.' ไม่สามารถดำเนินการแจ้งซ่อมได้ กรุณาส่งใบ Request กลับให้แผนก IT เพื่อดำเนินการต่อ',
                    'content2' => '(นี่เป็นข้อความอัตโนมัติไม่สามารถตอบกลับได้)',
                    'thank' => 'Thank you',
                    'sign' => 'IT Web'
                ];

                $toEmailuser = [$noti_repair[0]->email];

                Mail::to($toEmailuser)->send(new NotifyrepairReturnMail($details));
            }
        
        }

        return redirect()->back();
    }

    function searchNotifyRepair(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }
        else{
            $search = "";
        }

        $notirepair = DB::table('noti_repair')
                        ->join('section', 'section.sect_id', '=', 'noti_repair.sect_id')
                        ->join('noti_subject', 'noti_subject.noti_subject_no', '=', 'noti_repair.noti_subject_no')
                        ->leftjoin('noti_charge', 'noti_charge.noti_repair_no', '=', 'noti_repair.noti_repair_no')
                        ->leftjoin('member', 'member.user_id', '=', 'noti_charge.user_id')
                        ->select('noti_repair.noti_repair_no',
                                 'noti_repair.name_user',
                                 'noti_repair.email',
                                 'section.sect_id',
                                 'section.sect_name',
                                 'noti_repair.location',
                                 'noti_repair.tel',
                                 'noti_repair.noti_subject_no',
                                 'noti_repair.detail',
                                 'noti_repair.date',
                                 'noti_repair.track',
                                 'noti_repair.sign',
                                 'noti_repair.images',
                                 'noti_repair.status_noti_repair',
                                 'noti_subject.noti_subject_no',
                                 'noti_subject.noti_subject_name',
                                 'noti_charge.start_date',
                                 'noti_charge.end_date',
                                 'noti_charge.result',
                                 'noti_charge.remark',
                                 'member.user_id',
                                 'member.name')
                        ->where('noti_repair.track', 'LIKE', '%'.$search.'%')
                        ->orWhere('section.sect_name', 'LIKE', '%'.$search.'%')
                        ->orWhere('noti_repair.name_user', 'LIKE', '%'.$search.'%')
                        ->orderBy('noti_repair.noti_repair_no', 'DESC')
                        ->paginate(10);
        $section = DB::select('select * from section order by sect_name');
        $noti_subject = DB::select('select * from noti_subject');

        return view('notifyrepair.listnotifyrepair', ['notirepair' => $notirepair, 'section' => $section, 'noti_subject' => $noti_subject]);

    }

    function addNotifyRepair(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $sect_id = $request->input('sect_id');
        $location = $request->input('location');
        $tel = $request->input('tel');
        $noti_subject_no = $request->input('noti_subject_no');
        $detail = $request->input('detail');
        $digit = $this->generateDigit(8);

        if($request->file('imageFile') != ""){
            $request->validate([
                'imageFile' => 'required',
                'imageFile.*' => 'mimes:jpeg,jpg,png,gif|max:5120'
            ]);
          
            if($request->hasfile('imageFile')) {
                  foreach($request->file('imageFile') as $file)
                  {
                      $filename = uniqid().".".$file->getClientOriginalName();
                      $file->move(public_path().'/images/notirepair/', $filename);  
                      $imgData[] = $filename;  
                  }
    
                  $imgname = json_encode($imgData);
            }
        }
        else{
            $imgname = "";
        }

        //insert to noti_repair table
        DB::insert('insert into noti_repair (name_user, email, sect_id, location, tel, noti_subject_no, detail, date, track, images, status_noti_repair, status_return_mail) 
                    values(?, ?, ?, ?, ?, ?, ?, now(), ?, ?, 0, 0)',
                    [$name, $email, $sect_id, $location, $tel, $noti_subject_no, $detail, $digit, $imgname]);

        $noti_repair = DB::select('select noti_repair_no from noti_repair order by noti_repair_no desc limit 1');
        DB::insert('insert into noti_charge (noti_repair_no) values (?)', [$noti_repair[0]->noti_repair_no]);

        $sect_name = DB::select('select sect_name from section where sect_id = ?', [$sect_id]);
        $noti_subject_name = DB::select('select noti_subject_name from noti_subject where noti_subject_no = ?', [$noti_subject_no]);

        // send mail to member IT
        $details = [
            'dear' => 'Dear All,',
            'content1' => 'Notify me that there is a user reporting for repair Name : '.$name.' Email : '.$email.' Section : '.$sect_name[0]->sect_name.' at '.$location. ' Tel : '.$tel,
            'content2' => ' Subject of repair notification : '.$noti_subject_name[0]->noti_subject_name.' Detail : '.$detail,
            'content3' => 'More details below',
            'thank' => 'Thank you',
            'sign' => 'IT Web'
        ];

        $toEmail = ["kuntapon@thainjr.co.th"];

        Mail::to($toEmail)->send(new NotifyrepairMemberMail($name, $details));

        //send mail to user and chief
        
        //add list chief cc mail 
        $chief = DB::select('select email from chief where sect_id = ?', [$sect_id]);
        $email_chief = array();
        foreach($chief as $chiefs){
            array_push($email_chief, $chiefs->email);
        }

        $detailsuser = [
            'dear' => 'Dear '.$name.',',
            'content1' => 'ทางแผนก IT ได้รับการแจ้งซ่อมของคุณเรียบร้อยแล้ว คุณสามารถติดตามสถานะการแจ้งซ่อมหมายเลข : '.$digit,
            'content2' => 'ติดตามสถานะการแจ้งซ่อม : ',
            'thank' => 'Thank you',
            'sign' => 'IT Web',
            'digit' => $digit
        ];

        $toEmailuser = [$email];

        Mail::to($toEmailuser)
            ->cc($email_chief)  
            ->send(new NotifyrepairUserMail($detailsuser));

        //log

        $noti_repair_no = DB::select('select noti_repair_no from noti_repair order by noti_repair_no desc limit 1');

        $name = session()->get('name');
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        DB::connection('mysql2')->insert('insert into log_noti_repair (noti_repair_no, name_user, email, sect_id, location, tel, noti_subject_no, detail, date, track, images, 
                                          status_noti_repair, status_return_mail, ip, status) values (?, ?, ?, ?, ?, ?, ?, ?, now(), ?, ?, 0, 0, ?, "add")', [$noti_repair_no[0]->noti_repair_no,
                                          $name, $email, $sect_id, $location, $tel, $noti_subject_no, $detail, $digit, $imgname, $ip]);

        return redirect()->back();

    }

    function editNotifyRepair(Request $request){

        $noti_repair_no = $request->input('noti_repair_no');
        $name = $request->input('name_user');
        $email = $request->input('email');
        $sect_id = $request->input('sect_id');
        $location = $request->input('location');
        $tel = $request->input('tel');
        $noti_subject_no = $request->input('noti_subject_no');
        $detail = $request->input('detail');
        $track = $request->input('track');

        DB::update('update noti_repair set name_user = ?, email = ?, sect_id = ?, location = ?, tel = ?, noti_subject_no = ?, detail = ? where noti_repair_no = ?',
                    [$name, $email, $sect_id, $location, $tel, $noti_subject_no, $detail, $noti_repair_no]);

        //log

        $noti_repair = DB::select('select track, images from noti_repair where noti_repair_no = ? limit 1', [$noti_repair_no]);

        $name = session()->get('name');
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        DB::connection('mysql2')->insert('insert into log_noti_repair (noti_repair_no, name_user, email, sect_id, location, tel, noti_subject_no, detail, date, track, images, 
                                        ip, status) values (?, ?, ?, ?, ?, ?, ?, ?, now(), ?, ?, ?, "edit")', [$noti_repair_no,
                                        $name, $email, $sect_id, $location, $tel, $noti_subject_no, $detail, $noti_repair[0]->track, $noti_repair[0]->images, $ip]);

        return redirect()->back();

    }

    function updateNotifyrepair(Request $request){
        $noti_repair_no = $request->input('noti_repair_no');
        $status = $request->input('status');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $result = $request->input('result');
        $remark = $request->input('remark');

        DB::update('update noti_repair set status_noti_repair = ? where noti_repair_no = ?',
                    [$status, $noti_repair_no]);

        DB::update('update noti_charge set start_date = ?, end_date = ?, result = ?, remark = ? where noti_repair_no = ?', [$start_date, $end_date, $result, $remark, $noti_repair_no]);

        $noti_repair = DB::select('select email, track, images from noti_repair where noti_repair_no = ? limit 1', [$noti_repair_no]);

        $name = session()->get('name');

        if($status == 1){
            DB::update('update noti_charge set user_id = ? where noti_repair_no = ?', [session()->get('user_id'), $noti_repair_no]);
        }

        if($status == 2){

            $status_return_mail = DB::select('select status_return_mail from noti_repair where noti_repair_no = ?', [$noti_repair_no]);
            
            if($status_return_mail[0]->status_return_mail != 1){

                DB::update('update noti_repair set status_return_mail = 1 where noti_repair_no = ?', [$noti_repair_no]);

                //send mail to user 
        
                $details = [
                    'dear' => 'Dear '.$name.',',
                    'content1' => 'แจ้งซ่อมหมายเลข : '.$noti_repair[0]->track.' ไม่สามารถดำเนินการแจ้งซ่อมได้ กรุณาส่งใบ Request กลับให้แผนก IT เพื่อดำเนินการต่อ',
                    'content2' => '(นี่เป็นข้อความอัตโนมัติไม่สามารถตอบกลับได้)',
                    'thank' => 'Thank you',
                    'sign' => 'IT Web'
                ];

                $toEmailuser = [$noti_repair[0]->email];

                Mail::to($toEmailuser)->send(new NotifyrepairReturnMail($details));
            }
        
        }

        return redirect()->back();
    }

    function deleteNotifyrepair($id){

        DB::delete('delete from noti_repair where noti_repair_no = ?', [$id]);

        DB::delete('delete from noti_charge where noti_repair_no = ?', [$id]);

        return redirect()->back();

    }

    function showSign($id){

        $notirepair = DB::select('select noti_repair_no from noti_repair where noti_repair_no = ?', [$id]);

        return view('notifyrepair.sign_notirepair', ['notirepair' => $notirepair]);

    }

    function updateSignature(Request $request){
        
        $noti_repair_no = $_POST['noti_repair_no'];

        //signature

        $result = array();
        $imagedata = base64_decode($_POST['img_data']);
        $filename = md5(date("dmYhisA"));
            
        $file_name = 'images/signature/'.$filename.'.png';
        file_put_contents($file_name,$imagedata);
        $result['status'] = 1;
        $result['file_name'] = $file_name;
        echo json_encode($result);

        DB::update('update noti_repair set sign = ? where noti_repair_no = ?', [$file_name, $noti_repair_no]);

    }

    function trackNotifyrepair(){

        $track = $_GET['track'];

        $noti_repair = DB::select('select nr.status_noti_repair, mb.name, mb.tel from noti_repair nr
                                    left join noti_charge nc
                                    on nr.noti_repair_no = nc.noti_repair_no
                                    left join member mb
                                    on mb.user_id = nc.user_id
                                    where nr.track = ?', [$track]);

        return view('notifyrepair.status_notirepair', ['noti_repair' => $noti_repair]);

    }

    function generateDigit($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

}
