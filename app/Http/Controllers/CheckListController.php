<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class CheckListController extends Controller
{
    function checkList(){
        $member = DB::select('select user_id, employees_no, password, name, section, sub, position, tel, image, status_user, sc.sect_name, sb.sub_it_name 
                              from member mb 
                              inner join section sc 
                              on sc.sect_id = mb.section
                              inner join sub_it sb
                              on sb.sub_it_id = mb.sub
                              where status_user = 2
                              order by employees_no');
        $status = DB::select('select * from status');

        return view('organize.checklist', ['member' => $member, 'status' => $status]);
    }

    function addCheckList(Request $request){

        for ($i=0;$i<count($request->user_id);$i++){

            $user_id = $request->input('user_id')[$i];
            $status = $request->input('status')[$i];
            $tempe = $request->input('tempe')[$i];
            $checkdate = $request->input('checkdate');

            DB::insert('insert into checklist (user_id, status, temperature, check_date)
                        values(?, ?, ?, ?)', [$user_id, $status, $tempe, $checkdate]);
        }

        return redirect()->back();

    }

    function showEditChecklist(){
        $checked = DB::select("select check_date from checklist group by check_date order by check_date desc limit 1");
        $member = DB::select('select mb.user_id, employees_no, password, name, section, sub, position, tel, image, status_user, sc.sect_name, sb.sub_it_name,
                              cl.check_id, cl.temperature, cl.status
                              from member mb 
                              inner join section sc 
                              on sc.sect_id = mb.section
                              inner join sub_it sb
                              on sb.sub_it_id = mb.sub
                              inner join checklist cl
                              on cl.user_id = mb.user_id
                              where cl.check_date = ? and status_user = 2
                              order by employees_no
                              ', [$checked[0]->check_date]);
        $status = DB::select('select * from status');
        $checkdate = DB::select("select check_date from checklist group by check_date order by check_date desc");

        return view('organize.editchecklist', ['member' => $member, 'status' => $status, 'checkdate' => $checkdate, 'checked' => $checked]);
    }

    function filterChecklist(Request $request){
        $checked = $request->input('check_date');
        $member = DB::select('select mb.user_id, employees_no, password, name, section, sub, position, tel, image, status_user, sc.sect_name, sb.sub_it_name,
                              cl.check_id, cl.temperature, cl.status
                              from member mb 
                              inner join section sc 
                              on sc.sect_id = mb.section
                              inner join sub_it sb
                              on sb.sub_it_id = mb.sub
                              inner join checklist cl
                              on cl.user_id = mb.user_id
                              where cl.check_date = ? and status_user = 2
                              order by employees_no
                              ', [$checked]);
        $status = DB::select('select * from status');
        $checkdate = DB::select("select check_date from checklist group by check_date order by check_date desc");

        return view('organize.editchecklist', ['member' => $member, 'status' => $status, 'checkdate' => $checkdate, 'checked' => $checked]);
    }

    function editChecklist(Request $request){

        for ($i=0;$i<count($request->user_id);$i++){
            
            $check_id = $request->input('check_id')[$i];
            $status = $request->input('status')[$i];
            $tempe = $request->input('tempe')[$i];

            DB::update('update checklist set status = ?, temperature = ? where check_id = ?'
                        , [$status, $tempe, $check_id ]);

        }

        return redirect()->action(
            [CheckListController::class, 'showEditChecklist']
        );

    }

    function checkEveryDay(){
        $member = DB::select('select user_id from member where section = 1 and status_user = 2');

        //insert checklist everyday 
        foreach($member as $members){
            DB::insert('insert into checklist (user_id, status, temperature, check_date) 
            values(?, 1, null, ?) ', [$members->user_id, date("Y-m-d")]);
        }
        
        //insert log run schedule
        DB::connection('mysql2')->insert('insert into log_schedule (schedule) values ("checklisteveryday")');

    }

}
