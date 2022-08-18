<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use DB;
use Charts;

class UserController extends Controller
{
    function home(){
        $sumequip = DB::select('select com_name, count(com_name) as sumequip from equipment eq
                                inner join com_type ct
                                on eq.com_id = ct.com_id
                                group by ct.com_name
                                order by ct.com_name');
        $sumstock = DB::select('select ct.com_name, count(stock_status) as sumstock  
                                from stock st
                                inner join equipment eq
                                on st.equipment_no = eq.equipment_no
                                inner join com_type ct
                                on ct.com_id = eq.com_id
                                where st.stock_status = 1
                                group by ct.com_name
                                ');

        $sumstockmaterial = DB::select('select sm.material_no, mt.material_name, sum(sm.stock_material_qty) sumstockqty from stock_material sm
                                inner join material mt
                                on sm.material_no = mt.material_no 
                                group by material_no');
                                
        $borrow = DB::table('borrow')
                    ->join('section' ,'borrow.sect_id', '=', 'section.sect_id')
                    ->join('member', 'borrow.charge', '=', 'member.user_id')
                    ->join('stock', 'borrow.stock_no', '=', 'stock.stock_no')
                    ->join('equipment', 'stock.equipment_no', '=', 'equipment.equipment_no')
                    ->join('com_type', 'equipment.com_id', '=', 'com_type.com_id')
                    ->join('borrow_status', 'borrow.borrow_status', '=', 'borrow_status.borrow_status_no')
                    ->select('borrow.borrow_no',
                                'stock.stock_no',
                                'stock.equipment_no',
                                'equipment.equipment_name',
                                'com_type.com_name',
                                'borrow.user_borrow',
                                'borrow.sect_id',
                                'section.sect_name',
                                'borrow.start_date',
                                'borrow.end_date',
                                'borrow.borrow_status',
                                'borrow_status.borrow_status_name',
                                'member.name')
                    ->orderBy('borrow.borrow_no', 'DESC')
                    ->paginate(5);

        return view('home.home', ['sumequip' => $sumequip, 'sumstock' => $sumstock, 'sumstockmaterial' => $sumstockmaterial, 'borrow' => $borrow]);

    }

    function organization(){
        $member = DB::select('select *, mb.name, mb.tel, mb.image, sb.sub_it_name, st.status_name, pt.position_name from checklist cl
                            inner join member mb 
                            on mb.user_id = cl.user_id
                            inner join sub_it sb
                            on mb.sub = sb.sub_it_id
                            inner join status st
                            on cl.status = st.status_id
                            inner join position pt
                            on mb.position = pt.position_id
                            where check_date = current_date() and status_user = 2');

        return view('organize.organization', ['member' => $member]);
    }

    function listUser(){
        $member = DB::select('select *, sb.sub_it_name from member mb
                              inner join sub_it sb
                              on mb.sub = sb.sub_it_id
                              where status_user = 2
                              order by employees_no');
        $section = DB::select("select * from section");
        $sub = DB::select("select * from sub_it");
        $position = DB::select("select * from position");

        return view('organize.listuser', ['member' => $member, 'section' => $section, 'sub' => $sub, 'position' => $position]);
    }

    function addUser(Request $request){
        $employees_no = $request->input('employees_no');
        $password = $request->input('password');
        $fname = $request->input('fname');
        $section = $request->input('section');
        $sub = $request->input('sub');
        $position = $request->input('position');
        $tel = $request->input('tel');

        if($request->file('file') != ""){
            $request->validate([
                  'file' => 'required|mimes:jpg,jpeg,png|max:3072',
            ]);
    
            $fileName = uniqid().".".$request->file->getClientOriginalExtension();
    
            $request->file->move(public_path('images'), $fileName);
        }
        else{
        $fileName = "";
        }

        DB::insert('insert into member (employees_no, password, name, section, sub, position, tel, status_user, type_user, image)
                    values(?, ?, ?, ?, ?, ?, ?, ?, ? ,?)', [$employees_no, $password, $fname, $section, $sub, $position, $tel, 2, 2, $fileName]);

        return redirect()->back();
    }

    function showEditUser($id){
        $members = DB::select('select * from member where user_id = ?', [$id]);
        $section = DB::select("select * from section");
        $sub = DB::select("select * from sub_it");
        $position = DB::select("select * from position");

        return view('organize.edituser', ['members' => $members, 'section' => $section, 'sub' => $sub, 'position' => $position]);
    }

    function editUser(Request $request){
        $user_id = $request->input('user_id');
        $employees_no = $request->input('employees_no');
        $password = $request->input('password');
        $fname = $request->input('fname');
        $section = $request->input('section');
        $sub = $request->input('sub');
        $position = $request->input('position');
        $tel = $request->input('tel');
        $status_user = $request->input('status_user');
        $type_user = $request->input('type_user');
        $file_name = $request->input('file_name');

        if($request->file('file') != ""){
            $request->validate([
                  'file' => 'required|mimes:jpg,jpeg,png|max:3072',
            ]);
    
            $fileName = uniqid().".".$request->file->getClientOriginalExtension();
    
            $request->file->move(public_path('images'), $fileName);

             //delete image old file
            File::delete(public_path("images/$file_name"));
        }
        else if($file_name != "" ){
            $fileName = $file_name;
        }
        else{
            $fileName = "";
        }

        DB::update('update member set employees_no = ?, password = ?, name = ?, section = ?, sub = ?, position = ?, tel = ?,
                    status_user = ?, type_user = ?, image = ? where user_id = ?', [$employees_no, $password, $fname, $section,
                    $sub, $position, $tel, $status_user, $type_user, $fileName, $user_id]);

        return redirect()->action(
            [UserController::class, 'listUser']
        );
        
    }

    function deleteUser($id){

        DB::delete('delete from member where user_id = ?', [$id]);

        return redirect()->back();

    }

}
