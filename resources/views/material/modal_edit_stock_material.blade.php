<!-- Modal add -->
<div class="modal fade" id="edt{{$stockmaterials->stock_material_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  style="color:black;">
   <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
         <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไข Stock Material</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{URL::to('editstockmaterial')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
               <input type = "hidden" name = "stock_material_no" value = "{{$stockmaterials->stock_material_no}}" >
               
               <div class="row">
                  <div class="col">
                        <label><b>Material name</b></label>
                        <select name="material_no" class="form-select form-control border rounded" required>
                           <option disabled selected value>Choose...</option>
                           @foreach($material as $materials)
                              @if($stockmaterials->material_no == $materials->material_no)
                                 <option value="{{$materials->material_no}}" selected>{{$materials->material_name}}</option>
                              @else
                                 <option value="{{$materials->material_no}}">{{$materials->material_name}}</option>
                              @endif
                           @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="form-group">
                        <label><b>จำนวน</b></label>
                        <input class="form-control" name="stock_material_qty" type="number" value="{{$stockmaterials->stock_material_qty}}" min="0" max="1000" step="1"/>
               </div>
               
               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                     <button type="button" name="btn2" class="btn btn-success edt">บันทึก</button>
               </div>

            </form>
         </div>
   </div>
</div>