<!-- Modal add -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
         <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">เบิก Material</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{URL::to('addwithdrawmaterial')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">   
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

               <div class="row">
                  <div class="col">
                        <label><b>Material name</b></label>
                        <select name="material_no" id="input_material_no" class="form-select form-control border rounded" required>
                           <option disabled selected value>Choose...</option>
                           @foreach($material as $materials)
                                 <option value="{{$materials->material_no}}">{{$materials->material_name}}</option>
                           @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                        <label><b>Remark</b></label>
                        <input type="text" name="remark" id="input_remark" class="form-control">
                        <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="form-group">
                     <label><b>จำนวน</b></label>
                     <input class="form-control" name="withdraw_material_qty" id="input_withdraw_material_qty" type="number" value="0" min="0" max="1000" step="1"/>
               </div>
               
               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                     <button type="button" name="btn2" class="btn btn-success withdrawmaterial">เบิก</button>
               </div>

            </form>
         </div>
   </div>
</div>