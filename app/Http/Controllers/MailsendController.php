<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ExpireSoftwareMail;
use DB;
use DateTime;

define('LINE_API',"https://notify-api.line.me/api/notify");

class MailsendController extends Controller
{
    public function sendExpireSoftwareMail(){
        $software = DB::select("select *, DATEDIFF(end_date, now()) as expiredate from software");
        foreach($software as $softwares){
            if($softwares->expiredate <=45){
                if($softwares->mail_status != 1){

                    //send email notify
                    
                    $details = [
                        'dear' => 'Dear All,',
                        'content1' => 'Notify me that the software '.$softwares->software_name.' will expire within that date '.date("d-M-Y", strtotime($softwares->end_date)),
                        'content2' => 'Please check and renew the software',
                        'thank' => 'Thank you',
                        'sign' => 'IT Web'
                    ];

                    $toEmail = ["kuntapon.k@nisdt.co.th", "wariyaporn.p@nisdt.co.th", "korakot.t@nisdt.co.th", "anupop.p@nisdt.co.th", "napatr.t@nisdt.co.th",
                                "sahapab.y@nisdt.co.th", "samart.w@nisdt.co.th", "wittaya.c@nisdt.co.th", "nuntaporn.w@nisdt.co.th"];

                    Mail::to($toEmail)->send(new ExpireSoftwareMail($details));

                    //send line notify 
                
                    $token = "QDu7v5lgaET4uxsjsg4LQh2dAqNBYubjrk3zx1SkRBH";

                    $str = 'Notify me that the software '.$softwares->software_name.' will expire within that date '.date("d-M-Y", strtotime($softwares->end_date)); 

                    $res = $this->notify_message($str,$token);

                    print_r($res);

                    //update status send email
                    DB::update('update software set mail_status = 1 where ?', [$softwares->software_no]);

                }
            }
        }

        //insert log run schedule
        DB::connection('mysql2')->insert('insert into log_schedule (schedule) values ("sendexpiresoftwaremail")');
        
        /*$message = "Email has been send ".date_create()->format('d-M-Y h:i:s');
        
        return $message;*/
    }

    //line notify function
    public function notify_message($message,$token){

        $queryData = array('message' => $message);

        $queryData = http_build_query($queryData,'','&');

        $headerOptions = array(

                'http'=>array(

                    'method'=>'POST',

                    'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"

                            ."Authorization: Bearer ".$token."\r\n"

                            ."Content-Length: ".strlen($queryData)."\r\n",

                    'content' => $queryData

                ),

        );

        $context = stream_context_create($headerOptions);

        $result = file_get_contents(LINE_API,FALSE,$context);

        $res = json_decode($result);

        return $res;
    }
}
?>