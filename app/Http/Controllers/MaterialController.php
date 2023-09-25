<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail; 
use App\Mail\ExpireSoftwareMail;
use Illuminate\Support\Facades\File; 
use DB;


class MaterialController extends Controller
{
    function listMaterial(){
        //check null search
        isset($_GET['search_material_number']) ? $search_material_number = $_GET['search_material_number'] : $search_material_number = "";
        isset($_GET['search_material_name']) ? $search_material_name = $_GET['search_material_name'] : $search_material_name = "";

        $material = DB::table('material')
                            ->join('member', 'member.user_id', '=', 'material.user_id')
                            ->select('material.material_no',
                                    'material.material_name',
                                    'material.image',
                                    'material.input_date')
                            ->orderBy('material.no', 'DESC')
                            ->paginate(10);

        return view('material.listmaterial', ['material' => $material, 'search_material_number' => $search_material_number,
                    'search_material_name' => $search_material_name]);
    }

    function searchMaterial(){
        //check null search
        isset($_GET['search_material_number']) ? $search_material_number = $_GET['search_material_number'] : $search_material_number = "";
        isset($_GET['search_material_name']) ? $search_material_name = $_GET['search_material_name'] : $search_material_name = "";

        $material = DB::table('material')
                            ->join('member', 'member.user_id', '=', 'material.user_id')
                            ->select('material.material_no',
                                    'material.material_name',
                                    'material.image',
                                    'material.input_date')
                            ->where('material.material_no', 'LIKE', '%'.$search_material_number.'%')
                            ->where('material.material_name', 'LIKE', '%'.$search_material_name.'%')
                            ->orderBy('material.no', 'DESC')
                            ->paginate(10);

        return view('material.listmaterial', ['material' => $material, 'search_material_number' => $search_material_number,
                    'search_material_name' => $search_material_name]);
    }

    function materialnumber(){
        
        $material = DB::select('select material_no from material where material_no LIKE "MAT%" order by no desc limit 1');

        if(empty($material)){
            return $material_no = "MAT000" . "1";
        }
        else{
            $no = (int)substr($material[0]->material_no, 3);

            if(strlen($no) == 1){
                if($no == 9){
                    return $material_no = "MAT00".($no+1);
                }
                else{
                    return $material_no = "MAT000".($no+1);
                }
            }
            else if(strlen($no) == 2){
                if($no == 99){
                    return $material_no = "MAT0".($no+1);
                }
                else{
                    return $material_no = "MAT00".($no+1);
                }
            }
            else if(strlen($no) == 3){
                if($no == 999){
                    return $material_no = "MAT".($no+1);
                }
                else{
                    return $material_no = "MAT0".($no+1);
                }
            }
            else{
                return $material_no = "MAT".($no+1);
            }
        }

    }

    function addMaterial(Request $request){

        //call function materialnumber() 
        $material_no = $this->materialnumber();

        $material_name = $request->input('material_name');

        //check image
        if($request->file('file') != ""){
            $request->validate([
                  'file' => 'required|mimes:jpg,jpeg,png|max:3072',
            ]);
    
            $fileName = uniqid().".".$request->file->getClientOriginalExtension();
    
            $request->file->move(public_path('images/material'), $fileName);
        }
        else{
            $fileName = "";
        }

        DB::insert('insert into material (material_no, material_name, image, user_id) values(?, ?, ?, ?)',
                   [$material_no, $material_name, $fileName, session()->get('user_id')]);
        
        return redirect()->back();

    }

    function editMaterial(Request $request){
        
        $material_no = $request->input('material_no');
        $material_name = $request->input('material_name');
        $file_name = $request->input('file_name');
        
        if($request->file('file') != ""){
            $request->validate([
                  'file' => 'required|mimes:jpg,jpeg,png|max:3072',
            ]);
    
            $fileName = uniqid().".".$request->file->getClientOriginalExtension();
    
            $request->file->move(public_path('images/material'), $fileName);

            //delete image old file
            File::delete(public_path("images/material/$file_name"));
        }
        else if($file_name != "" ){
            $fileName = $file_name;
        }
        else{
            $fileName = "";
        }

        DB::update('update material set material_name = ?, image = ? where material_no = ?', 
                   [$material_name, $fileName, $material_no]);

        return redirect()->back();

    }

    function deleteMaterial($id){

        $img = DB::select('select image from material where material_no = ?', [$id]);

        if (File::exists(public_path('images/material/'.$img[0]->image))) {

            File::delete(public_path('images/material/'.$img[0]->image));

        }

        DB::delete('delete from material where material_no = ?', [$id]);

        return redirect()->back();

    }

    function listStockMaterial(){

        //check null search
        isset($_GET['search_material_name']) ? $search_material_name = $_GET['search_material_name'] : $search_material_name = "";
        isset($_GET['date']) ? $date = $_GET['date'] : $date = "";

        $stockmaterial = DB::table('stock_material')
            ->join('material', 'material.material_no', '=', 'stock_material.material_no')
            ->select('stock_material.stock_material_no',
                     'stock_material.material_no',
                     'material.material_name',
                     'stock_material.stock_material_qty',
                     'stock_material.input_date')
            ->orderBy('stock_material.stock_material_no', 'DESC')
            ->paginate(10);

        $material = DB::select('select material_no, material_name from material');

        return view('material.liststockmaterial', ['stockmaterial' => $stockmaterial, 'material' => $material, 'search_material_name' => $search_material_name, 
                    'date' => $date]);
        
    }

    function searchStockMaterial(){
        
        //check null search
        isset($_GET['search_material_name']) ? $search_material_name = $_GET['search_material_name'] : $search_material_name = "";
        isset($_GET['date']) ? $date = $_GET['date'] : $date = "";

        $stockmaterial = DB::table('stock_material')
            ->join('material', 'material.material_no', '=', 'stock_material.material_no')
            ->select('stock_material.stock_material_no',
                     'stock_material.material_no',
                     'material.material_name',
                     'stock_material.stock_material_qty',
                     'stock_material.input_date')
            ->where('material.material_name', 'LIKE', '%'.$search_material_name.'%')
            ->where('stock_material.input_date', 'LIKE', '%'.$date.'%')
            ->orderBy('stock_material.stock_material_no', 'DESC')
            ->paginate(10);

        $material = DB::select('select material_no, material_name from material');

        return view('material.liststockmaterial', ['stockmaterial' => $stockmaterial, 'material' => $material, 'search_material_name' => $search_material_name
                    , 'date' => $date]);
        
    }

    function addStockMaterial(Request $request){
        $material_no = $request->input('material_no');
        $stock_material_qty = $request->input('stock_material_qty');

        DB::insert('insert into stock_material (material_no, stock_material_qty, input_date, user_id) values(?, ?, now(), ?)',
                    [$material_no, $stock_material_qty, session()->get('user_id')]);

        return redirect()->back();
    }

    function editStockMaterial(Request $request){
        $stock_material_no = $request->input('stock_material_no');
        $material_no = $request->input('material_no');
        $stock_material_qty = $request->input('stock_material_qty');

        DB::update('update stock_material set material_no = ?, stock_material_qty = ? where stock_material_no = ?',
                    [$material_no, $stock_material_qty, $stock_material_no]);

        return redirect()->back();
    }

    function deleteStockMaterial($id){
        DB::delete('delete from stock_material where stock_material_no = ?', [$id]);

        return redirect()->back();
    }
    
    function listWithdrawMaterial(){
        //check null search
        //check null search
        isset($_GET['search_material_name']) ? $search_material_name = $_GET['search_material_name'] : $search_material_name = "";
        isset($_GET['date']) ? $date = $_GET['date'] : $date = "";

        $withdrawmaterial = DB::table('withdraw_material')
                                ->join('withdraw_material_detail', 'withdraw_material_detail.withdraw_material_no', '=', 'withdraw_material.withdraw_material_no')
                                ->join('material', 'material.material_no', '=', 'withdraw_material_detail.material_no')
                                ->select('withdraw_material.withdraw_material_no',
                                         'material.material_no',
                                         'material.material_name',
                                         DB::raw('sum(withdraw_material_detail.withdraw_material_qty) as sumqty'),
                                         'withdraw_material.out_date',
                                         'withdraw_material.user_id',
                                         'withdraw_material.remark')
                                ->orderBy('withdraw_material.withdraw_material_no', 'DESC')
                                ->groupBy('withdraw_material_detail.withdraw_material_no')
                                ->paginate(10);  

        $material = DB::select('select material_no, material_name from material');

        $stockmaterial = DB::select('select sm.material_no, mt.material_name, sum(sm.stock_material_qty) sumstockqty from stock_material sm
                                     inner join material mt
                                     on sm.material_no = mt.material_no 
                                     group by material_no');
                                
        return view('material.listwithdrawmaterial', ['withdrawmaterial' => $withdrawmaterial, 'material' => $material, 'stockmaterial' => $stockmaterial,
                    'search_material_name' => $search_material_name, 'date' => $date]);
    }

    function searchWithdrawMaterial(){
        //check null search
        //check null search
        isset($_GET['search_material_name']) ? $search_material_name = $_GET['search_material_name'] : $search_material_name = "";
        isset($_GET['date']) ? $date = $_GET['date'] : $date = "";
        
        $withdrawmaterial = DB::table('withdraw_material')
                                ->join('withdraw_material_detail', 'withdraw_material_detail.withdraw_material_no', '=', 'withdraw_material.withdraw_material_no')
                                ->join('material', 'material.material_no', '=', 'withdraw_material_detail.material_no')
                                ->select('withdraw_material.withdraw_material_no',
                                         'material.material_no',
                                         'material.material_name',
                                         DB::raw('sum(withdraw_material_detail.withdraw_material_qty) as sumqty'),
                                         'withdraw_material.out_date',
                                         'withdraw_material.user_id',
                                         'withdraw_material.remark')
                                ->where('material.material_name', 'LIKE', '%'.$search_material_name.'%')
                                ->where('withdraw_material.out_date', 'LIKE', '%'.$date.'%')
                                ->orderBy('withdraw_material.withdraw_material_no', 'DESC')
                                ->groupBy('withdraw_material_detail.withdraw_material_no')
                                ->paginate(10);  

        $material = DB::select('select material_no, material_name from material');

        $stockmaterial = DB::select('select sm.material_no, mt.material_name, sum(sm.stock_material_qty) sumstockqty from stock_material sm
                                     inner join material mt
                                     on sm.material_no = mt.material_no 
                                     group by material_no');
                                
        return view('material.listwithdrawmaterial', ['withdrawmaterial' => $withdrawmaterial, 'material' => $material, 'stockmaterial' => $stockmaterial,
                    'search_material_name' => $search_material_name, 'date' => $date]);
    }
    
    function listDetailWithdrawMaterial($id){
        $withdrawmaterial = DB::table('withdraw_material')
                                ->join('withdraw_material_detail', 'withdraw_material_detail.withdraw_material_no', '=', 'withdraw_material.withdraw_material_no')
                                ->join('material', 'material.material_no', '=', 'withdraw_material_detail.material_no')
                                ->join('stock_material', 'stock_material.stock_material_no', '=', 'withdraw_material_detail.stock_material_no')
                                ->join('member', 'member.user_id', '=', 'withdraw_material.user_id')
                                ->select('withdraw_material.withdraw_material_no',
                                         'withdraw_material_detail.withdraw_material_detail_no',
                                         'material.material_no',
                                         'material.material_name',
                                         'withdraw_material_detail.withdraw_material_qty',
                                         'stock_material.input_date',
                                         'withdraw_material.out_date',
                                         'withdraw_material.user_id',
                                         'member.name',
                                         'withdraw_material_detail.stock_material_no',
                                         'withdraw_material.remark')
                                ->where('withdraw_material_detail.withdraw_material_no', '=', $id)
                                ->orderBy('withdraw_material.withdraw_material_no', 'DESC')
                                ->paginate(10);  

        $material = DB::select('select material_no, material_name from material');

        $stockmaterial = DB::select('select sm.material_no, mt.material_name, sum(sm.stock_material_qty) sumstockqty from stock_material sm
                                     inner join material mt
                                     on sm.material_no = mt.material_no 
                                     group by material_no');
                                
        return view('material.listdetailwithdrawmaterial', ['withdrawmaterial' => $withdrawmaterial, 'material' => $material, 'stockmaterial' => $stockmaterial]);
    } 
    
    function addWithdrawMatrial(Request $request){
        $totalremaining = 0;
        $x = 0;
        $i =0;
        $material_no = $request->input('material_no');
        $withdraw_material_qty = $request->input('withdraw_material_qty');
        $remark = $request->input('remark');
        
        do{
            $stockmaterial = $this->dataStockMaterial($material_no);
            foreach($stockmaterial as $stockmaterials){
                
                if($stockmaterials->stock_material_qty < $withdraw_material_qty ){
                    (int)$withdraw_material_qty = (int)$withdraw_material_qty - (int)$stockmaterials->stock_material_qty;
    
                    DB::update('update stock_material set stock_material_qty = 0 where stock_material_no = ?', [$stockmaterials->stock_material_no]);
                    
                    if($i != 0){
                        $this->addDataWithdrawMaterialDetail($material_no, $stockmaterials->stock_material_qty, $stockmaterials->stock_material_no);
                    }
                    else{
                        //add data withdraw
                        $this->addDataWithdrawMaterial($remark);

                        //add data withdraw detail
                        $this->addDataWithdrawMaterialDetail($material_no, $stockmaterials->stock_material_qty, $stockmaterials->stock_material_no);
                    }

                    //check loop
                    $x = 1;
                }
                else if($stockmaterials->stock_material_qty == $withdraw_material_qty){
                    (int)$withdraw_material_qty = (int)$withdraw_material_qty - (int)$stockmaterials->stock_material_qty;
    
                    DB::update('update stock_material set stock_material_qty = 0 where stock_material_no = ?', [$stockmaterials->stock_material_no]);
                    
                    if($i != 0){
                        //add data withdraw detail
                        $this->addDataWithdrawMaterialDetail($material_no, $stockmaterials->stock_material_qty, $stockmaterials->stock_material_no);
                    }
                    else{
                        //add data withdraw
                        $this->addDataWithdrawMaterial($remark);

                        //add data withdraw detail
                        $this->addDataWithdrawMaterialDetail($material_no, $stockmaterials->stock_material_qty, $stockmaterials->stock_material_no);
                    }
                   
                    //check loop
                    $x = 0;
                }
                else if($withdraw_material_qty == 0){
                    //check loop
                    $x = 0;
                }
                else{
                    $totalremaining = (int)$stockmaterials->stock_material_qty - (int)$withdraw_material_qty;
    
                    DB::update('update stock_material set stock_material_qty = ? where stock_material_no = ?', [$totalremaining, $stockmaterials->stock_material_no]);

                    if($i != 0){
                        //add data withdraw detail
                        $this->addDataWithdrawMaterialDetail($material_no, $withdraw_material_qty, $stockmaterials->stock_material_no);
                    }
                    else{
                        //add data withdraw
                        $this->addDataWithdrawMaterial($remark);

                        //add data withdraw detail
                        $this->addDataWithdrawMaterialDetail($material_no, $withdraw_material_qty, $stockmaterials->stock_material_no);
                    }

                    //check loop
                    $x = 0;
                }

                $i++;
            }

        }while($x != 0);

        return redirect()->back();
    }

    function editWithdrawMaterial(Request $request){
        $withdraw_material_no = $request->input('widthdraw_material_no');
        $withdraw_material_detail_no = $request->input('withdraw_material_detail_no');
        $old_widthdraw_material_qty = $request->input('old_widthdraw_material_qty');
        $material_no = $request->input('material_no');
        $sum_material_qty = $request->input('sum_material_qty');
        $stock_material_no = $request->input('stock_material_no');
        $remark = $request->input('remark');

        (int)$totalremaining = (int)$old_widthdraw_material_qty - (int)$sum_material_qty;

        if($sum_material_qty == 0){
            DB::update('update stock_material set stock_material_qty = stock_material_qty + ? where stock_material_no = ?', 
            [$old_widthdraw_material_qty, $stock_material_no]);

            DB::delete('delete from withdraw_material_detail where withdraw_material_detail_no = ?', [$withdraw_material_detail_no]);

            $withdrawmaterial = DB::select('select withdraw_material_no from withdraw_material_detail where withdraw_material_no = ?', [$withdraw_material_no]);
            if(count($withdrawmaterial) == 0){
                DB::delete('delete from withdraw_material where withdraw_material_no = ?', [$withdraw_material_no]);

                return redirect()->action([MaterialController::class, 'listWithdrawMaterial']);
            }

            return redirect()->back();
        }
        else{
            //update stock
            DB::update('update stock_material set stock_material_qty = stock_material_qty + ? where stock_material_no = ?', [$totalremaining, $stock_material_no]);

            DB::update('update withdraw_material set remark = ? where withdraw_material_no = ?', [$remark, $withdraw_material_no]);

            //update withdraw material
            DB::update('update withdraw_material_detail set withdraw_material_qty = ? where withdraw_material_detail_no = ?', [$sum_material_qty, $withdraw_material_detail_no]);

            return redirect()->back();
        }

    }

    function deleteWithdrawMaterial($id, $id2){
        $withdrawmaterial = DB::select('select * from withdraw_material_detail where withdraw_material_detail_no = ?', [$id]);
        
        //update stock
        DB::update('update stock_material set stock_material_qty = stock_material_qty + ? where stock_material_no = ?', 
        [$withdrawmaterial[0]->withdraw_material_qty, $withdrawmaterial[0]->stock_material_no]);

        //delete withdraw material
        DB::delete('delete from withdraw_material_detail where withdraw_material_detail_no = ?', [$withdrawmaterial[0]->withdraw_material_detail_no]);

        //check null withdraw detail and delete withdraw material
        $withdrawmaterial2 = DB::select('select withdraw_material_no from withdraw_material_detail where withdraw_material_no = ?', [$id2]);
        if(count($withdrawmaterial2) == 0){
            DB::delete('delete from withdraw_material where withdraw_material_no = ?', [$id2]);

            return redirect()->action([MaterialController::class, 'listWithdrawMaterial']);
        }

        return redirect()->back();
        
    }

    public function addDataWithdrawMaterial($remark){
        //add data withdraw
        DB::insert('insert into withdraw_material (out_date, user_id, remark) values(now(), ?, ?)',
        [session()->get('user_id'), $remark]);
    }

    public function addDataWithdrawMaterialDetail($material_no, $withdraw_material_qty, $stock_material_no){
        //add data withdraw detail
        $withdraw_material = DB::select('select withdraw_material_no from withdraw_material order by withdraw_material_no desc limit 1');

        //add withdraw material detail         
        DB::insert('insert into withdraw_material_detail (material_no, withdraw_material_qty, stock_material_no, withdraw_material_no)
                    values(?, ?, ?, ?)', [$material_no, $withdraw_material_qty, $stock_material_no, $withdraw_material[0]->withdraw_material_no]);
    }

    public function dataStockMaterial($material_no){
        $stockmaterial = DB::select('select stock_material_no, stock_material_qty from stock_material where material_no = ? and stock_material_qty != 0 
                                         order by input_date limit 1 ', [$material_no]);

        return $stockmaterial;
    }

}
?>