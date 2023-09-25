<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Excel;
use DB;
use DateTime;
use Cookie;

class RequestController extends Controller
{

    private $server = '10.230.8.84';
    private $domain = '@nisdt.net';
    private $port = 389;
    
    function indexRequest(){
        return view('request_system.index_request');
    }

    function loginRequest(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        //connect LDAP
        $ldap_connection = ldap_connect($this->server, $this->port);

        if (! $ldap_connection)
        {
            echo '<p>LDAP SERVER CONNECTION FAILED</p>';
            exit;
        }

        // Help talking to AD
        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);

        $ldap_bind = @ldap_bind($ldap_connection, $username.$this->domain, $password);

        if (! $ldap_bind)
        {
            return redirect()->back()->with('alert', "Username หรือ Password ไม่ถูกต้อง");
        }
        else{
            if(empty(Cookie::get('name'))){
                $filter="(sAMAccountName=$username)";
                $result = ldap_search($ldap_connection,"OU=NISDT-Users,dc=nisdt,dc=net",$filter);
                $info = ldap_get_entries($ldap_connection, $result);
                for ($i=0; $i<$info["count"]; $i++){

                    if($info['count'] > 1){
                        break;
                    }
                    
                    $section = $this->getSectionId($info[$i]["company"][0]);

                    if(isset($info[$i]["title"][0])){
                        $position = $info[$i]["title"][0];
                    }
                    else{
                        $position = "";
                    }

                    //set cookies
                    Cookie::queue('employee_no', $info[$i]["physicaldeliveryofficename"][0], 2147483647);
                    Cookie::queue('name', $info[$i]["givenname"][0], 2147483647);
                    Cookie::queue('position', $position, 2147483647);
                    Cookie::queue('section', $section, 2147483647);
                    Cookie::queue('email', $info[$i]['mail'][0], 2147483647);

                    //update database
                    $data = DB::select('select ad_profile_no from ad_profile where employee_no = ?', [$info[$i]["physicaldeliveryofficename"][0]]);
                    if(empty($data)){
                        DB::insert("insert into ad_profile (employee_no, name, surname, email, position, section) values(?, ?, ?, ?, ?, ?)",
                                    [$info[$i]["physicaldeliveryofficename"][0], $info[$i]["givenname"][0], $info[$i]["sn"][0], $info[$i]["mail"][0],
                                    $position, $section]);
                    }
                    else{
                        DB::update("update ad_profile set employee_no = ?, name = ?, surname = ?, email = ?, position = ?, section = ? where employee_no = ?",
                                    [$info[$i]["physicaldeliveryofficename"][0], $info[$i]["givenname"][0], $info[$i]["sn"][0], $info[$i]["mail"][0],
                                    $position, $section, $info[$i]["physicaldeliveryofficename"][0]]);
                    }

                }
            }

            return redirect()->back();
        }

        ldap_close($ldap_connection);

    }

    function logoutRequest(){
        Cookie::queue(Cookie::forget('employee_no'));
        Cookie::queue(Cookie::forget('name'));
        Cookie::queue(Cookie::forget('position'));
        Cookie::queue(Cookie::forget('section'));
        Cookie::queue(Cookie::forget('email'));

        return redirect('indexrequest');
    }

    function profileRequest(Request $request){
        //check image
        if($request->file('file') != ""){
            $request->validate([
                  'file' => 'required|mimes:jpg,jpeg,png|max:3072',
            ]);
    
            $fileName = uniqid().".".$request->file->getClientOriginalExtension();
    
            $request->file->move(public_path('images/signature_request'), $fileName);
        }
        else{
            $fileName = "";
        }

        DB::update("update ad_profile set signature = ? where employee_no = ?", [$fileName, Cookie::get('employee_no')]);

        return redirect()->back();
    }

    function updateUserProfileAD(){
        $username   = 'administrator';
        $password   = '2zx*9P02';

        $ldap_connection = ldap_connect($this->server, $this->port);

        if (! $ldap_connection)
        {
            echo '<p>LDAP SERVER CONNECTION FAILED</p>';
            exit;
        }

        // Help talking to AD
        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);

        $ldap_bind = @ldap_bind($ldap_connection, $username.$this->domain, $password);

        if (! $ldap_bind)
        {
            echo '<p>LDAP BINDING FAILED</p>';
            exit;
        }
        else{
            $filter="(&(objectClass=user)(objectCategory=person)(physicaldeliveryofficename=*))";
            $result = ldap_search($ldap_connection,"OU=M365,OU=NISDT-Users,dc=nisdt,dc=net", $filter);
            $info = ldap_get_entries($ldap_connection, $result);
            $employee_no = array();

            for ($i=0; $i<$info["count"]; $i++){
                $employee_no[] = $info[$i]['physicaldeliveryofficename'][0];
            }

            for ($i=0; $i<count($employee_no);$i++){
                if(strlen($employee_no[$i]) == 5){
                    $filter2="(physicaldeliveryofficename=$employee_no[$i])";
                    $result2 = ldap_search($ldap_connection,"OU=M365,OU=NISDT-Users,dc=nisdt,dc=net",$filter2);
                    $info2 = ldap_get_entries($ldap_connection, $result2);
    
                    for ($x=0; $x<$info2["count"]; $x++){
    
                        if(isset($info2[$x]["company"][0])){
                            $section = $this->getSectionId($info2[$x]["company"][0]);
                        }

                        if(isset($info2[$x]["title"][0])){
                            $position = $info2[$x]["title"][0];
                        }
                        else{
                            $position = "";
                        }
    
                        if(isset($info2[$x]["mail"][0])){
                            $email = $info2[$x]["mail"][0];
                        }
                        else{
                            $email = "";
                        }
    
                        $employee = DB::select('select employee_no from ad_profile where employee_no = ?', [$info2[$x]["physicaldeliveryofficename"][0]]);
    
                        if(empty($employee)){
                            DB::insert('insert into ad_profile (employee_no, name, surname, email, position, section) values (?, ?, ?, ?, ?, ?)', 
                                        [$info2[$x]["physicaldeliveryofficename"][0], $info2[$x]["givenname"][0], $info2[$x]["sn"][0], $email,
                                        $position, $section]);
                        }
                        else{
                            DB::update('update ad_profile set employee_no = ?, name = ?, surname = ?, email = ?, position = ?, section = ?
                                        where employee_no = ?', [$info2[$x]["physicaldeliveryofficename"][0], $info2[$x]["givenname"][0],
                                        $info2[$x]["sn"][0], $email, $position, $section, $info2[$x]["physicaldeliveryofficename"][0]]);
                        }       
                    }
                    echo $info[$i]["physicaldeliveryofficename"][0]." ".$section." ".$email." ".$position.$info[$i]["sn"][0]."<br>";            
                }
            }
        }

        ldap_close($ldap_connection);
    }


    protected function getSectionId($value){
        $data = DB::select('select sect_id from section where sect_name_ad = ?', [$value]);

        if(empty($data)){
            $section = "0";
        }
        else{
            $section = $data[0]->sect_id;
        }
        
        return $section;
    }

    public static function imgSignature(){
        $signature = DB::select('select signature from ad_profile where employee_no = ?', [Cookie::get('employee_no')]);

        return $signature;
    }

    function testldap(){
        $username   = 'administrator';
        $password   = '2zx*9P02';

        $ldap_connection = ldap_connect($this->server, $this->port);

        if (! $ldap_connection)
        {
            echo '<p>LDAP SERVER CONNECTION FAILED</p>';
            exit;
        }

        // Help talking to AD
        ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0);

        $ldap_bind = @ldap_bind($ldap_connection, $username.$this->domain, $password);

        if (! $ldap_bind)
        {
            echo '<p>LDAP BINDING FAILED</p>';
            exit;
        }
        else{
            $filter="(&(objectClass=user)(objectCategory=person)(physicaldeliveryofficename=*))";
            $result = ldap_search($ldap_connection,"OU=M365,OU=NISDT-Users,dc=nisdt,dc=net", $filter);
            $info = ldap_get_entries($ldap_connection, $result);
            $employee_no = array();

            $count = 0;

            for ($i=0; $i<$info["count"]; $i++){
                $employee_no[] = $info[$i]['physicaldeliveryofficename'][0];
            }

            for ($i=0; $i<count($employee_no);$i++){
                if(strlen($employee_no[$i]) == 5){
                    $filter2="(physicaldeliveryofficename=$employee_no[$i])";
                    $result2 = ldap_search($ldap_connection,"OU=M365,OU=NISDT-Users,dc=nisdt,dc=net",$filter2);
                    $info2 = ldap_get_entries($ldap_connection, $result2);

                    $count++;
    
                    for ($x=0; $x<$info2["count"]; $x++){
    
                        if(isset($info2[$x]["company"][0])){
                            $section = $this->getSectionId($info2[$x]["company"][0]);
                        }

                        if(isset($info2[$x]["title"][0])){
                            $position = $info2[$x]["title"][0];
                        }
                        else{
                            $position = "";
                        }
    
                        if(isset($info2[$x]["mail"][0])){
                            $email = $info2[$x]["mail"][0];
                        }
                        else{
                            $email = "";
                        }
    
                        /*$employee = DB::select('select employee_no from ad_profile where employee_no = ?', [$info2[$x]["physicaldeliveryofficename"][0]]);
    
                        if(empty($employee)){
                            DB::insert('insert into ad_profile (employee_no, name, surname, email, position, section) values (?, ?, ?, ?, ?, ?)', 
                                        [$info2[$x]["physicaldeliveryofficename"][0], $info2[$x]["givenname"][0], $info2[$x]["sn"][0], $email,
                                        $position, $section]);
                        }
                        else{
                            DB::update('update ad_profile set employee_no = ?, name = ?, surname = ?, email = ?, position = ?, section = ?
                                        where employee_no = ?', [$info2[$x]["physicaldeliveryofficename"][0], $info2[$x]["givenname"][0],
                                        $info2[$x]["sn"][0], $email, $position, $section, $info2[$x]["physicaldeliveryofficename"][0]]);
                        }*/       
                    }
                    echo $info[$i]["physicaldeliveryofficename"][0]." ".$section." ".$email." ".$position.$info[$i]["sn"][0]."<br>";

                    //var_dump($info2);
            
                }
            }

            echo $count;

        }

        ldap_close($ldap_connection);
    }

}
