<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use File;
use Response;

use DB;

class Controller extends BaseController
{

    public static function getIp(){

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

        return [$name, $ip];
        
    }

    function test(){
        $member = DB::connection('mysql3')->select('show columns from member');

        $member2 = DB::connection('mysql3')->select('select position from member group by position');

        foreach($member2 as $members){
            echo $members->position."<br>";
        }

        /*foreach($member as $members){
            echo $members->Field."<br>";
        }*/
    }
    
    function testftp(){

        $file = "C:\script\chk_put_ftp.bat 10.230.1.70 z020022 z020022 kuntalib";
        exec( $file, $log);
        echo implode("<br>",$log);

        print_r($log);

    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
