<!-- Modal add -->
<script>
   var material = <?php echo json_encode($material); ?>;
</script>

<div class="modal fade" id="edtwithdrawmaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  style="color:black;">
   <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
         <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไข Withdraw Material</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{URL::to('editwithdrawmaterial')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
               <input type = "hidden" name="widthdraw_material_no" id = "widthdraw_material_no">
               <input type = "hidden" name="withdraw_material_detail_no" id = "withdraw_material_detail_no">
               <input type = "hidden" name="stock_material_no" id = "stock_material_no">
               <input type = "hidden" name="old_widthdraw_material_qty" id = "old_widthdraw_material_qty">
               
               <div class="row">
                  <div class="col">
                     <label><b>Material name</b></label>
                     <select name="material_no" id="edt_material_no" class="form-select form-control border rounded" disabled> 
                        <option disabled selected value>Choose...</option>
                        @foreach($material as $materials)
                           <option id="{{$materials->material_no}}" value="{{$materials->material_no}}">{{$materials->material_name}}</option>
                        @endforeach
                     </select>
                     <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                        <label><b>Remark</b></label>
                        <input type="text" name="remark" id="edt_remark" class="form-control">
                        <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="form-group">
                  <label><b>จำนวน</b></label>
                  <input class="form-control" name="sum_material_qty" id="edt_withdraw_material_qty" type="number" min="0" max="1000" step="1"/>
               </div>
               
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button type="button" name="btn2" class="btn btn-success editwithdrawmaterial">บันทึก</button>
               </div>
            </form>
         </div>
   </div>
</div>

<script type="text/javascript" src="{{asset('scripts/datainputwithdrawmaterial.js')}}"></script> 



