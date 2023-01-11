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

    public static function getName($id){

        $data = DB::select('select name from member where user_id = ?', [$id]);

        if(empty($data)){
            $name = "";
        }
        else{
            $name = $data[0]->name;
        }
        return $name;

    }

    public static function getStamp($id){

        $data = DB::select('select stamp from member where user_id = ?', [$id]);

        if(empty($data)){
            $stamp = "";
        }
        else{
            $stamp = $data[0]->stamp;
        }
        return $stamp;

    }

    function test(){
        /*$member = DB::connection('mysql3')->select('show columns from member');

        $member2 = DB::connection('mysql3')->select('select position from member group by position');

        foreach($member2 as $members){
            echo $members->position."<br>";
        }*/

        /*foreach($member as $members){
            echo $members->Field."<br>";
        }*/

        //////////////////////////////////////////////////////////////////////////////////////////////

        $user="ODBCWEB";
        $password="ODBCWEB";
            
        //storing connection id in $conn
        $conn=odbc_connect('IBMODBC',$user, $password);
        
        //Checking connection id or reference
        if (!$conn)
        {
            echo (die(odbc_error()));
        }
        else
        {
            $sql = "SELECT * FROM qsys2.SYS_STATUS";
            $query = odbc_exec($conn,$sql);
            
            $data = odbc_fetch_array($query);
            echo json_encode($data);
        }
        //Resource releasing
        odbc_close($conn);
    }
    
    function testftp(){

        $file = "C:\script\chk_put_ftp.bat 10.230.1.70 z020022 z020022 kuntalib";
        exec( $file, $log);
        echo implode("<br>",$log);

        print_r($log);

    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
