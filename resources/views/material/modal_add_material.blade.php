<!-- Modal add -->
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
         <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่ม Material</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{URL::to('addmaterial')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">   
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

               <div class="row">

                  <div class="col">
                        <label><b>Material name</b></label>
                        <input type="text" class="form-control" name="material_name" placeholder="Material name" required>
                        <div class="invalid-feedback">Please input data</div>
                  </div>
               </div>

               <div class="form-group">
                        <label><b>Image</b></label>
                        <div style="text-align:center; margin-bottom:1%; ">
                           <img src="" id="img" style="widht:150px;;height:200px;">
                        </div>
                        <input type="file" class="form-control" name="file"
                        onchange="img.src=window.URL.createObjectURL(this.files[0]) " accept="image/*" />
               </div>
               
               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                     <button type="button" name="btn2" class="btn btn-success add_user">เพิ่ม</button>
               </div>

            </form>
         </div>
   </div>
</div>