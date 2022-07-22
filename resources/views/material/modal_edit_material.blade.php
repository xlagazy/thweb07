<!-- Modal add -->
<div class="modal fade" id="edtmat{{$materials->material_no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  style="color:black;">
   <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
         <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">แก้ไข Material</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{URL::to('editmaterial')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
               <input type = "hidden" name = "material_no" value = "{{$materials->material_no}}" >
               <div class="row">

                  <div class="col">
                        <label><b>Material name</b></label>
                        <input type="text" class="form-control" name="material_name" value="{{$materials->material_name}}" placeholder="Material name" required>
                        <div class="invalid-feedback">Please input data</div>
                  </div>
               </div>

               <div class="form-group">
                    <label><b>Image</b></label>
                    <div style="text-align:center; margin-bottom:1%; ">
                        <img src="/images/material/{{$materials->image}}" id="img" style="widht:150px;;height:200px;">
                    </div>
                    <input type="file" class="form-control" name="file"
                    onchange="img.src=window.URL.createObjectURL(this.files[0]) " accept="image/*" />
                    <input type="hidden" name="file_name" value="{{$materials->image}}" />
                </div>
               
               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                     <button type="button" name="btn2" class="btn btn-success edt">บันทึก</button>
               </div>

            </form>
         </div>
   </div>
</div>