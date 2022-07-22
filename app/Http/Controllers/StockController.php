<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StockExport;
use Excel;
use DB;
use DateTime;

class StockController extends Controller
{
    function listStock(){

        //check null search
        isset($_GET['search']) != '' ? $search = $_GET['search'] : $search = "";
        isset($_GET['com_name']) != '' ? $com_name = $_GET['com_name'] : $com_name = "";
        isset($_GET['status']) != '' ? $status = $_GET['status'] : $status = "";

        $equipment = DB::select('select equipment_no from equipment');
        $st = DB::select('select equipment_no from stock');
        $stock_status = DB::select('select * from stock_status');
        $com_type = DB::select('select * from com_type');
        $stock = DB::table('stock')
                     ->join('equipment', 'stock.equipment_no', '=', 'equipment.equipment_no')
                     ->join('com_type', 'equipment.com_id', '=', 'com_type.com_id')
                     ->join('stock_status', 'stock.stock_status', '=', 'stock_status.stock_status_no')
                     ->select('stock.stock_no',
                              'equipment.equipment_no',
                              'equipment.equipment_name',
                              'com_type.com_name',
                              'stock.stock_status',
                              'stock_status.stock_status_name')
                     ->orderBy('stock.stock_no', 'DESC')
                     ->paginate(10);

        return view('stock.liststock', ['stock' => $stock, 'equipment' => $equipment, 'st' => $st, 'stock_status' => $stock_status,
                    'com_type' => $com_type, 'search' => $search, 'com_name' => $com_name, 'status' => $status]);

    }

    function searchStock(){

        //check null search
        isset($_GET['search']) != '' ? $search = $_GET['search'] : $search = "";
        isset($_GET['com_name']) != '' ? $com_name = $_GET['com_name'] : $com_name = "";
        isset($_GET['status']) != '' ? $status = $_GET['status'] : $status = "";

        $equipment = DB::select('select equipment_no from equipment');
        $st = DB::select('select equipment_no from stock');
        $stock_status = DB::select('select * from stock_status');
        $com_type = DB::select('select * from com_type');
        $stock = DB::table('stock')
                     ->join('equipment', 'stock.equipment_no', '=', 'equipment.equipment_no')
                     ->join('com_type', 'equipment.com_id', '=', 'com_type.com_id')
                     ->join('stock_status', 'stock.stock_status', '=', 'stock_status.stock_status_no')
                     ->select('stock.stock_no',
                              'equipment.equipment_no',
                              'equipment.equipment_name',
                              'com_type.com_name',
                              'stock.stock_status',
                              'stock_status.stock_status_name')
                     ->where(function($query) use($search){
                        $query->where('equipment.equipment_no', 'LIKE', '%'.$search.'%')
                            ->orWhere('equipment.equipment_name', 'LIKE', '%'.$search.'%');
                     })
                     ->where('com_type.com_name', 'LIKE', '%'.$com_name.'%')
                     ->where('stock.stock_status', 'LIKE', '%'.$status.'%')
                     ->orderBy('stock.stock_no', 'DESC')
                     ->paginate(10);

        return view('stock.liststock', ['stock' => $stock, 'equipment' => $equipment, 'st' => $st, 'stock_status' => $stock_status,
                     'com_type' => $com_type, 'search' => $search, 'com_name' => $com_name, 'status' => $status]);

    }

    function addStock(Request $request){
        
        $equipment_no = $request->input('equipment_no');

        DB::insert('insert into stock (equipment_no, stock_status) values (?, ?)', [$equipment_no, 1]);

        //Log

        $stock_no = DB::select('select stock_no from stock order by stock_no desc limit 1');

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        DB::connection('mysql2')->insert('insert into log_stock (stock_no, equipment_no, stock_status, name, ip, status) values (?, ?, ?, ?, ?, "add")', 
        [$stock_no[0]->stock_no, $equipment_no, 1, $name, $ip]);

        return redirect()->back();
        
    }

    function editStock(Request $request){

        $stock_no = $request->input('stock_no');
        $stock_status = $request->input('stock_status');

        DB::update("update stock set stock_status = ? where stock_no = ?", [$stock_status, $stock_no]);

        //log

        $equipment_no = DB::select('select equipment_no from stock where stock_no = ?', [$stock_no]);

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        DB::connection('mysql2')->insert('insert into log_stock (stock_no, equipment_no, stock_status, name, ip, status) values (?, ?, ?, ?, ?, "edit")', 
        [$stock_no, $equipment_no[0]->equipment_no, $stock_status, $name, $ip]);

        return redirect()->back();

    }

    function deleteStock($id){

        DB::delete("delete from stock where stock_no = ?", [$id]);

        $controller = new Controller();

        list($name, $ip) = $controller->getIP();

        DB::connection('mysql2')->insert('insert into log_stock (stock_no, name, ip, status) values (?, ?, ?, "delete")', 
        [$id, $name, $ip]);

        return redirect()->back();

    }

    function exportStock(Request $request){

        $com_id = $request->input('com_id');
        $stock_status = $request->input('stock_status');
        $date = date('d-m-Y');
        return Excel::download(new StockExport($com_id, $stock_status), 'stock_'.$date.'.xlsx');

    }
}
