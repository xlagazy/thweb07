<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Excel;
use DB;
use DateTime;
use Cookie;

class RequestAppController extends Controller
{
    function listRequestAppUser(){
        $request_app = DB::table('request_app')
                        ->join('request_app_approve', 'request_app.req_app_id', '=', 'request_app_approve.req_app_id')
                        ->orderBy('request_app.issued_date', 'desc')
                        ->paginate(10);

        return view('request_system.request_app.listrequestapp_user', ['request_app' => $request_app]);
    }

    function addRequestApp(Request $request){
        $req_app_id = $this->idRequestApp();
        $req_app_need_date = $request->input('req_app_need_date');
        $req_app_subject = $request->input('req_app_subject');
        $req_app_problem = $request->input('req_app_problem');
        $req_app_refer = $request->input('req_app_refer');
        $req_app_detail = $request->input('req_app_detail');

        if($request->file('files') != ""){
            $request->validate([
                'files' => 'required',
                'files.*' => 'mimes:pdf|max:5120'
            ]);
          
            if($request->hasfile('files')) {
                  foreach($request->file('files') as $file)
                  {
                      $filename = uniqid().".".$file->getClientOriginalName();
                      $file->move(public_path().'/file/request_app/attach_file/', $filename);  
                      $fileData[] = $filename;  
                  }
    
                  $filename = json_encode($fileData);
            }
        }
        else{
            $filename = "";
        }

        //insert data to request_app
        DB::insert("insert into request_app (req_app_id, req_app_subject, req_app_problem, req_app_refer,
                    req_app_detail, need_date, employee_no, attach_file) values (?, ?, ?, ?, ?, ?, ?, ?)",
                    [$req_app_id, $req_app_subject, $req_app_problem, $req_app_refer, $req_app_detail, 
                    $req_app_need_date, Cookie::get('employee_no'), $filename]);

        //insert data to request_app_approve
        DB::insert("insert into request_app_approve (user_approve, req_app_id) values (?, ?)", 
                    [Cookie::get('employee_no'), $req_app_id]);

        return redirect()->back();
    }

    function addApproveChiefUser($req_app_id, $emplouee_no){
        DB::update('update request_app_approve set chf_user_approve = ? where req_app_id = ?', [$emplouee_no, $req_app_id]);

        return redirect()->back();
    }

    public static function approveUser($id){
        $profile = DB::select('select * from ad_profile where employee_no = ?', [$id]);
        
        echo '<img class="signature_request" src="/images/signature_request/'.$profile[0]->signature.'"></img>';
    }

    public static function approveChiefUser($req_app_id, $emplouee_no){
        $profile = DB::select('select * from ad_profile where employee_no = ?', [$emplouee_no]);
        $request_app = DB::select('select rq.chf_user_approve, pf.signature from request_app_approve rq
                                    inner join ad_profile pf
                                    on pf.employee_no = rq.chf_user_approve
                                    where rq.req_app_id = ?', [$req_app_id]);

        if(empty($request_app[0]->chf_user_approve)){
            if(strpos($profile[0]->position,'Chief') !== false || strpos($profile[0]->position,'Mgr') !== false ){
                if(empty($profile[0]->signature)){
                    echo '<button class="text-white bg-success" onclick="notsignature()" >Approve</button>';
                }
                else{
                    echo '<button class="text-white bg-success" onclick="apprveChiefUser('.$req_app_id.','.$emplouee_no.')">Approve</button>';
                }
            }
            else if(!strpos($profile[0]->position,'Chief') !== false){
                echo '<button class="text-white bg-secondary disabled">Approve</button>';
            }
        }
        else{
            echo '<img class="signature_request" src="/images/signature_request/'.$request_app[0]->signature.'"></img>';
        }
        
        
    }

    protected function idRequestApp(){
        $id = DB::select('select req_app_id from request_app order by req_app_id desc limit 1');
        
        if(empty($id)){
            $req_app_id = 1;
        }else{
            $req_app_id = $id[0]->req_app_id + 1;
        }

        return $req_app_id;
    }

}
