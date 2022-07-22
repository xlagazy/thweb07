<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class LoginController extends Controller
{

    function login(){
        return view('login');
    }

    function loginUser(Request $request){
        $member = DB::select('select * from member');

        $employees_id = $request->input('employees_id');
        $password = $request->input('password');

        $check = 0;

        foreach($member as $members){
          if($members->employees_no == $employees_id && $members->password == $password){
            $check = 1;
            session()->put('user_id', $members->user_id);
            session()->put('name', $members->name);
            session()->put('image', $members->image);
            session()->put('type_user', $members->type_user);
            session()->put('sub', $members->sub);
          }
        }

        if($check != 0){
          if(session()->get('type_user') != 0){
            
            if(session()->get('pageref') != ""){
              //Log
              $controller = new Controller();

              list($name, $ip) = $controller->getIP();

              DB::connection('mysql2')->insert('insert into log_login (name, ip, status) value(?, ?, "login")', [$name, $ip]);

              return redirect(session()->get('pageref'));
            }else{
              //Log

              $controller = new Controller();

              list($name, $ip) = $controller->getIP();

              DB::connection('mysql2')->insert('insert into log_login (name, ip, status) value(?, ?, "login")', [$name, $ip]);

              return redirect()->action([UserController::class, 'home']);

            } 

          }
          else{
            //admin
          }
        }
        else{
            return back()->with('alert', "๊Username หรือ Password ไม่ถูกต้อง");
        }

    }

    function logOut(){

      session()->forget('user_id');
      session()->forget('name');
      session()->forget('image');
      session()->forget('type_user');

      return redirect()->action([LoginController::class, 'login']);

    }
}
