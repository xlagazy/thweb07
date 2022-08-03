<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use App\Exports\BorrowExport;
use Excel;
use DB;
use DateTime;

class BorrowController extends Controller
{
    
    function listBorrow(){

        //check null search
        isset($_GET['search_equip_number']) != '' ? $search_equip_number = $_GET['search_equip_number'] : $search_equip_number = "";
        isset($_GET['search_equip_name']) != '' ? $search_equip_name = $_GET['search_equip_name'] : $search_equip_name = "";
        isset($_GET['search_user_borrow']) != '' ? $search_user_borrow = $_GET['search_user_borrow'] : $search_user_borrow = "";
        isset($_GET['com_name']) != '' ? $com_name = $_GET['com_name'] : $com_name = "";
        isset($_GET['sect_name']) != '' ? $sect_name = $_GET['sect_name'] : $sect_name = "";
        isset($_GET['status']) != '' ? $status = $_GET['status'] : $status = "";

        $sumstock = DB::select('select ct.com_name, count(stock_status) as summary  
                                from stock st
                                inner join equipment eq
                                on st.equipment_no = eq.equipment_no
                                inner join com_type ct
                                on ct.com_id = eq.com_id
                                where st.stock_status = 1
                                group by ct.com_name
                                ');
        $com_type = DB::select('select * from com_type');
        $stock = DB::select('select equipment_no, stock_status from stock');
        $section = DB::select('select * from section order by sect_name');
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
                               'member.name',
                               'borrow.signature')
                      ->orderBy('borrow.borrow_no', 'DESC')
                      ->paginate(10);

        return view('borrow.listborrow', ['stock' => $stock, 'borrow' => $borrow, 'section' => $section, 'sumstock' => $sumstock,
                    'com_type' => $com_type,'search_equip_number' => $search_equip_number, 'search_equip_name' => $search_equip_name,
                    'com_name' => $com_name, 'sect_name' => $sect_name, 'status' => $status, 'search_user_borrow' => $search_user_borrow]); 

    }

    function searchBorrow(){

        //check null search
        isset($_GET['search_equip_number']) != '' ? $search_equip_number = $_GET['search_equip_number'] : $search_equip_number = "";
        isset($_GET['search_equip_name']) != '' ? $search_equip_name = $_GET['search_equip_name'] : $search_equip_name = "";
        isset($_GET['search_user_borrow']) != '' ? $search_user_borrow = $_GET['search_user_borrow'] : $search_user_borrow = "";
        isset($_GET['com_name']) != '' ? $com_name = $_GET['com_name'] : $com_name = "";
        isset($_GET['sect_name']) != '' ? $sect_name = $_GET['sect_name'] : $sect_name = "";
        isset($_GET['status']) != '' ? $status = $_GET['status'] : $status = "";
        
        $sumstock = DB::select('select ct.com_name, count(stock_status) as summary  
                                from stock st
                                inner join equipment eq
                                on st.equipment_no = eq.equipment_no
                                inner join com_type ct
                                on ct.com_id = eq.com_id
                                where st.stock_status = 1
                                group by ct.com_name');
        $com_type = DB::select('select * from com_type');
        $stock = DB::select('select equipment_no, stock_status from stock');
        $section = DB::select('select * from section order by sect_name');
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
                               'member.name',
                               'borrow.signature')
                      ->where('equipment.equipment_no', 'LIKE', '%'.$search_equip_number.'%')
                      ->where('equipment.equipment_name', 'LIKE', '%'.$search_equip_name.'%')
                      ->where('borrow.user_borrow', 'LIKE', '%'.$search_user_borrow.'%')
                      ->where('com_type.com_name', 'LIKE', '%'.$com_name.'%')
                      ->where('section.sect_name', 'LIKE', '%'.$sect_name.'%')
                      ->where('borrow_status.borrow_status_no', 'LIKE', '%'.$status.'%')
                      ->orderBy('borrow.borrow_no', 'DESC')
                      ->paginate(10);

        return view('borrow.listborrow', ['stock' => $stock, 'borrow' => $borrow, 'section' => $section, 'sumstock' => $sumstock,
                    'com_type' => $com_type, 'search_equip_number' => $search_equip_number, 'search_equip_name' => $search_equip_name,
                    'com_name' => $com_name, 'sect_name' => $sect_name, 'status' => $status, 'search_user_borrow' => $search_user_borrow]);
        
    }

    function addBorrow(Request $request){

        $equipment_no = $request->input('equipment_no');
        $user_borrow = $request->input('user_borrow');
        $sect_id = $request->input('sect_id');
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $charge = session()->get('user_id');
        
        $stock = DB::select('select * from stock where equipment_no = ?', [$equipment_no]);

        foreach($stock as $stocks){
            $stock_no = $stocks->stock_no;
        }

        DB::insert('insert into borrow (stock_no, user_borrow, sect_id, start_date, end_date, charge, borrow_status) 
                    values(?, ?, ?, ?, ?, ?, ?)', [$stock_no, $user_borrow, $sect_id, $start_date,
                    $end_date, $charge, 2]);

        DB::update('update stock set stock_status = ? where equipment_no = ?', [2, $equipment_no]);

        return redirect()->back();

    }

    function showEditBorrow($id){
        $borrow = DB::select('select br.borrow_no, br.stock_no, br.user_borrow, br.sect_id, br.start_date, br.end_date, br.charge, br.borrow_status, br.signature, 
                              eq.equipment_no, eq.equipment_name 
                              from borrow br
                              inner join stock st
                              on br.stock_no = st.stock_no
                              inner join equipment eq
                              on st.equipment_no = eq.equipment_no
                              where borrow_no = ?', [$id]);
        $stock = DB::select('select equipment_no, stock_status from stock');
        $section = DB::select('select * from section');

        return view('borrow.editborrow', ['borrow' => $borrow, 'stock' => $stock, 'section' => $section]); 
    }

    function editBorrow(Request $request){

        $equipment_no = $_POST['equipment_no'];
        $borrow_no = $_POST['borrow_no'];
        $user_borrow = $_POST['user_borrow'];
        $sect_id = $_POST['sect_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $status = $_POST['status'];

        $result = array();
        $imagedata = base64_decode($_POST['img_data']);
        $filename = md5(date("dmYhisA"));
            
        $file_name = 'images/signature/'.$filename.'.png';
        file_put_contents($file_name,$imagedata);
        $result['status'] = 1;
        $result['file_name'] = $file_name;
        echo json_encode($result);

        DB::update('update borrow set user_borrow = ?, sect_id = ?, start_date = ?, end_date = ?, borrow_status = ?, signature = ? where borrow_no = ?',
                    [$user_borrow, $sect_id, $start_date, $end_date, $status, $file_name, $borrow_no]);

        DB::update('update stock set stock_status = ? where equipment_no = ?', [$status, $equipment_no]);

        //return redirect()->action([BorrowController::class, 'listBorrow']);
    }

    function deleteBorrow($id, $st, $no){
        
        if($st == 2){
            DB::delete('delete from borrow where borrow_no = ?', [$id]);

            DB::update('update stock set stock_status = ? where equipment_no = ?', [1, $no]);
        }
        else{
            DB::delete('delete from borrow where borrow_no = ?', [$id]);
        }

        return redirect()->back();

    }

    function exportBorrow(Request $request){
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $date = date('d-m-Y');
        return Excel::download(new BorrowExport($start_date, $end_date), 'borrow_'.$date.'.xlsx');
    }

}
