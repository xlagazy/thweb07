<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class PlanetpressController extends Controller
{
    
    function listPlanetPress(){
        isset($_GET['search_workstation']) != '' ? $search_workstation = $_GET['search_workstation'] : $search_workstation = "";
        isset($_GET['search_address']) != '' ? $search_address = $_GET['search_address'] : $search_address = "";
        isset($_GET['search_description']) != '' ? $search_description = $_GET['search_description'] : $search_description = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_user']) != '' ? $search_user = $_GET['search_user'] : $search_user = "";
        isset($_GET['search_printer']) != '' ? $search_printer = $_GET['search_printer'] : $search_printer = "";

        $planet = DB::connection("planet_2")->table('nisdt_printqueue as pq')
                                            ->select('pq.ID',
                                                     'pq.OutQueue',
                                                     'pq.Output',
                                                     'pq.Description',
                                                     'pq.Status',
                                                     'pq.User_ID',
                                                     'pq.Printername',
                                                     'pq.Printername')
                                            ->orderBy('pq.ID', 'DESC')
                                            ->paginate(10);

        return view('planetpress.list_planetpress', ['planet' => $planet, 'search_workstation' => $search_workstation, 'search_address' => $search_address,
                                                     'search_description' => $search_description, 'search_status' => $search_status, 
                                                     'search_user' => $search_user, 'search_printer' => $search_printer]);
    }
    
    function searchPlanetPress(){
        isset($_GET['search_workstation']) != '' ? $search_workstation = $_GET['search_workstation'] : $search_workstation = "";
        isset($_GET['search_address']) != '' ? $search_address = $_GET['search_address'] : $search_address = "";
        isset($_GET['search_description']) != '' ? $search_description = $_GET['search_description'] : $search_description = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_user']) != '' ? $search_user = $_GET['search_user'] : $search_user = "";
        isset($_GET['search_printer']) != '' ? $search_printer = $_GET['search_printer'] : $search_printer = "";

        $planet = DB::connection("planet_2")->table('nisdt_printqueue as pq')
                                            ->select('pq.ID',
                                                    'pq.OutQueue',
                                                    'pq.Output',
                                                    'pq.Description',
                                                    'pq.Status',
                                                    'pq.User_ID',
                                                    'pq.Printername',
                                                    'pq.Printername')
                                            ->where('pq.OutQueue', 'LIKE', '%'.$search_workstation.'%')
                                            ->where('pq.Output', 'LIKE', '%'.$search_address.'%')
                                            ->where('pq.Description', 'LIKE', '%'.$search_description.'%')
                                            ->where('pq.Status', 'LIKE', '%'.$search_status.'%')
                                            ->where('pq.User_ID', 'LIKE', '%'.$search_user.'%')
                                            ->where('pq.Printername', 'LIKE', '%'.$search_printer.'%')
                                            ->orderBy('pq.ID', 'DESC')
                                            ->paginate(10);

        return view('planetpress.list_planetpress', ['planet' => $planet, 'search_workstation' => $search_workstation, 'search_address' => $search_address,
                                                     'search_description' => $search_description, 'search_status' => $search_status, 
                                                     'search_user' => $search_user, 'search_printer' => $search_printer]);
    }

    function addPlanetPress(Request $request){
        $outqueue = $request->input('outqueue');
        $output = $request->input('output');
        $description = $request->input('description');
        $status = $request->input('status');
        $user_id = $request->input('user_id');
        $printername = $request->input('printername');

        DB::connection('planet_2')->insert('insert into nisdt_printqueue (OutQueue, Output, Description, Status, User_ID, Printername) 
                    values(?, ?, ?, ?, ?, ?)', [$outqueue, $output, $description, $status, $user_id, $printername]);
                
        return redirect()->back();
    }

    function copyPlanetPress(Request $request){
        $outqueue = $request->input('outqueue');
        $output = $request->input('output');
        $description = $request->input('description');
        $status = $request->input('status');
        $user_id = $request->input('user_id');
        $printername = $request->input('printername');

        DB::connection('planet_2')->insert('insert into nisdt_printqueue (OutQueue, Output, Description, Status, User_ID, Printername) 
                    values(?, ?, ?, ?, ?, ?)', [$outqueue, $output, $description, $status, $user_id, $printername]);
                
        return redirect()->back();
    }

    function editPlanetPress(Request $request){
        $id = $request->input('id');
        $outqueue = $request->input('outqueue');
        $output = $request->input('output');
        $description = $request->input('description');
        $status = $request->input('status');
        $user_id = $request->input('user_id');
        $printername = $request->input('printername');

        DB::connection('planet_2')->update('update nisdt_printqueue set OutQueue = ?, Output = ?, Description = ?, Status = ?,
                                            User_ID = ?, Printername = ? where ID = ?', [$outqueue, $output, $description, $status,
                                            $user_id, $printername, $id]);
        
         return redirect()->back();
        
    }

    function deletePlanetPress($id){
        DB::connection('planet_2')->delete('delete from nisdt_printqueue where id = ?', [$id]);

        return redirect()->back();
    }

    function listPlanetPressThai(){
        isset($_GET['search_workstation']) != '' ? $search_workstation = $_GET['search_workstation'] : $search_workstation = "";
        isset($_GET['search_address']) != '' ? $search_address = $_GET['search_address'] : $search_address = "";
        isset($_GET['search_description']) != '' ? $search_description = $_GET['search_description'] : $search_description = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_user']) != '' ? $search_user = $_GET['search_user'] : $search_user = "";
        isset($_GET['search_printer']) != '' ? $search_printer = $_GET['search_printer'] : $search_printer = "";

        $planet = DB::connection("planet")->table('nisdt_printqueue as pq')
                                            ->select('pq.ID',
                                                     'pq.OutQueue',
                                                     'pq.Output',
                                                     'pq.Description',
                                                     'pq.Status',
                                                     'pq.User_ID',
                                                     'pq.Printername',
                                                     'pq.Printername')
                                            ->orderBy('pq.ID', 'DESC')
                                            ->paginate(10);

        return view('planetpress.list_planetpress_thai', ['planet' => $planet, 'search_workstation' => $search_workstation, 'search_address' => $search_address,
                                                     'search_description' => $search_description, 'search_status' => $search_status, 
                                                     'search_user' => $search_user, 'search_printer' => $search_printer]);
    }
    
    function searchPlanetPressThai(){
        isset($_GET['search_workstation']) != '' ? $search_workstation = $_GET['search_workstation'] : $search_workstation = "";
        isset($_GET['search_address']) != '' ? $search_address = $_GET['search_address'] : $search_address = "";
        isset($_GET['search_description']) != '' ? $search_description = $_GET['search_description'] : $search_description = "";
        isset($_GET['search_status']) != '' ? $search_status = $_GET['search_status'] : $search_status = "";
        isset($_GET['search_user']) != '' ? $search_user = $_GET['search_user'] : $search_user = "";
        isset($_GET['search_printer']) != '' ? $search_printer = $_GET['search_printer'] : $search_printer = "";

        $planet = DB::connection("planet")->table('nisdt_printqueue as pq')
                                            ->select('pq.ID',
                                                    'pq.OutQueue',
                                                    'pq.Output',
                                                    'pq.Description',
                                                    'pq.Status',
                                                    'pq.User_ID',
                                                    'pq.Printername',
                                                    'pq.Printername')
                                            ->where('pq.OutQueue', 'LIKE', '%'.$search_workstation.'%')
                                            ->where('pq.Output', 'LIKE', '%'.$search_address.'%')
                                            ->where('pq.Description', 'LIKE', '%'.$search_description.'%')
                                            ->where('pq.Status', 'LIKE', '%'.$search_status.'%')
                                            ->where('pq.User_ID', 'LIKE', '%'.$search_user.'%')
                                            ->where('pq.Printername', 'LIKE', '%'.$search_printer.'%')
                                            ->orderBy('pq.ID', 'DESC')
                                            ->paginate(10);

        return view('planetpress.list_planetpress_thai', ['planet' => $planet, 'search_workstation' => $search_workstation, 'search_address' => $search_address,
                                                     'search_description' => $search_description, 'search_status' => $search_status, 
                                                     'search_user' => $search_user, 'search_printer' => $search_printer]);
    }

    function addPlanetPressThai(Request $request){
        $outqueue = $request->input('outqueue');
        $output = $request->input('output');
        $description = $request->input('description');
        $status = $request->input('status');
        $user_id = $request->input('user_id');
        $printername = $request->input('printername');

        echo $outqueue;

        DB::connection('planet')->insert('insert into nisdt_printqueue (OutQueue, Output, Description, Status, User_ID, Printername) 
                    values(?, ?, ?, ?, ?, ?)', [$outqueue, $output, $description, $status, $user_id, $printername]);
                
        return redirect()->back();
    }

    function copyPlanetPressThai(Request $request){
        $outqueue = $request->input('outqueue');
        $output = $request->input('output');
        $description = $request->input('description');
        $status = $request->input('status');
        $user_id = $request->input('user_id');
        $printername = $request->input('printername');

        DB::connection('planet')->insert('insert into nisdt_printqueue (OutQueue, Output, Description, Status, User_ID, Printername) 
                    values(?, ?, ?, ?, ?, ?)', [$outqueue, $output, $description, $status, $user_id, $printername]);
                
        return redirect()->back();
    }

    function editPlanetPressThai(Request $request){
        $id = $request->input('id');
        $outqueue = $request->input('outqueue');
        $output = $request->input('output');
        $description = $request->input('description');
        $status = $request->input('status');
        $user_id = $request->input('user_id');
        $printername = $request->input('printername');

        DB::connection('planet')->update('update nisdt_printqueue set OutQueue = ?, Output = ?, Description = ?, Status = ?,
                                            User_ID = ?, Printername = ? where ID = ?', [$outqueue, $output, $description, $status,
                                            $user_id, $printername, $id]);
        
         return redirect()->back();
        
    }

    function deletePlanetPressThai($id){
        DB::connection('planet')->delete('delete from nisdt_printqueue where id = ?', [$id]);

        return redirect()->back();
    }

}
