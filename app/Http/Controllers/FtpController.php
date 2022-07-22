<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class FtpController extends Controller
{
    function ftp(){
       return view('ftp.getftp');
    }

    function put(){
        return view('ftp.putftp');
    }

    function getandput(){
        return view('ftp.getandputftp');
    }

    function getftp(Request $request){

        $host = $request->input('host');
        $username = $request->input('username');
        $password = $request->input('password');
        $library = $request->input('library');
        $filename = $request->input('filename');

        $file = "C:\script\get_ftp.bat ".$host." ".$username." ".$password." ".$library." ".$filename."";
        exec( $file, $log );

        if(strpos($log[19], "226") !== false){
            session()->put('status', 1);
            session()->put('file', $filename);
        }
        else if(strpos($log[18], "550") !== false){
            session()->put('status', 2);
        }
        else if(strpos($log[18], "530") !== false){
            session()->put('status', 3);
        }
        else if(strpos($log[11], "550") !== false){
            session()->put('status', 4);
        }

        return redirect()->back()
                    ->withInput();

    }

    function putftp(Request $request){

        $host = $request->input('puthost');
        $username = $request->input('putusername');
        $password = $request->input('putpassword');
        $library = $request->input('putlibrary');

        $file = "C:\script\chk_put_ftp.bat ".$host." ".$username." ".$password." ".$library."";
        exec($file, $log);

        if(strpos($log[11], "250") !== false){

            //process data input to AS400
            if($request->file('putfilename') != ""){
                $fileName = $request->file('putfilename')->getClientOriginalName();
        
                $request->file('putfilename')->move(public_path('upsavf'), $fileName);
            }
            else{
                $fileName = "";
            }

            $file2 = "C:\script\put_ftp.bat ".$host." ".$username." ".$password." ".$library." ". $fileName;
            exec($file2, $log2);

            if(strpos($log2[19], "226") !== false){
                session()->put('status', 1);
            }
        }
        else if(strpos($log[11], "550") !== false){
            session()->put('status', 2);
        }
        else if(strpos($log[11], "530") !== false){
            session()->put('status', 3);
        }

        return redirect()->back()
                    ->withInput();

    }

    function getandputftp(Request $request){
        $host = $request->input('host');
        $username = $request->input('username');
        $password = $request->input('password');
        $library = $request->input('library');
        $filename = $request->input('filename');
        $puthost = $request->input('puthost');
        $putlibrary = $request->input('putlibrary');

        //get save file.
        $file = "C:\script\get_for_put_ftp.bat ".$host." ".$username." ".$password." ".$library." ".$filename."";
        exec( $file, $log );

        if(strpos($log[19], "226") !== false){

            //check put to library.
            $file2 = "C:\script\chk_put_ftp.bat ".$puthost." ".$username." ".$password." ".$putlibrary."";
            exec($file2, $log2);

            //check have library.
            if(strpos($log2[11], "250") !== false){
                //put save file.
                $file3 = "C:\script\put_ftp.bat ".$puthost." ".$username." ".$password." ".$putlibrary." ". $filename;
                exec($file3, $log3);
                //check sucessfully
                if(strpos($log3[19], "226") !== false){
                    session()->put('status', 1);
                }
            }
            //check not found put to library.
            else if(strpos($log2[11], "550") !== false){
                session()->put('status', 5);
            }
            
        }
        //check file not found.
        else if(strpos($log[18], "550") !== false){
            session()->put('status', 2);
        }
        //check invalid username or password.
        else if(strpos($log[18], "530") !== false){
            session()->put('status', 3);
        }
        //check not found library.
        else if(strpos($log[11], "550") !== false){
            session()->put('status', 4);
        }

        return redirect()->back()
                    ->withInput();

    }

    function downloadfile($filename){
        $filepath = public_path('savf/'.$filename.'');
        return Response::download($filepath); 
    }

}
