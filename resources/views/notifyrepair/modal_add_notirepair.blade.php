<style>
    .imgPreview img {
        padding: 8px;
        max-width: 100px;
     } 
</style>
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">แจ้งซ่อม</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{URL::to('addnotifyrepair')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

                <label><b>ชื่อผู้แจ้งซ่อม/Name</b></label>
                <input type="text" class="form-control" name="name" placeholder="name" required>
                <div class="invalid-feedback">Please input data</div>

                <label><b>อีเมล์/Email</b></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="example@nisdt.co.th" required>
                <div class="invalid-feedback">Please input data</div>
                <p id="invalid-data-noti" style="color:red;"></p>

                <label><b>แผนก/Section</b></label>
                <select name="sect_id" class="form-control" required>
                <option disabled selected value>Choose...</option>
                @foreach($section as $sections)
                    <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                @endforeach
                </select>
                <div class="invalid-feedback">Please choose data</div>

                <label><b>สถานที่/Location</b></label>
                <input type="text" class="form-control" name="location" placeholder="location" required>
                <div class="invalid-feedback">Please input data</div>

                <label><b>เบอร์โทร/Tel</b></label>
                <input type="text" class="form-control" name="tel" placeholder="tel" maxlength="4" required>
                <div class="invalid-feedback">Please input data</div>

                <label><b>หัวข้อที่ต้องการแจ้ง/Subject</b></label>
                <select name="noti_subject_no" class="form-control" required>
                <option disabled selected value>Choose...</option>
                @foreach($noti_subject as $noti_subjects)
                    <option value="{{$noti_subjects->noti_subject_no}}">{{$noti_subjects->noti_subject_name}}</option>
                @endforeach
                </select>
                <div class="invalid-feedback">Please choose data</div>

                <label><b>รายละเอียดหรือปัญหา/Detail or problem</b></label>
                <textarea class="form-control" name="detail" rows="5" required></textarea>
                <div class="invalid-feedback">Please input data</div>
                
                <label><b>รูปภาพ</b></label>
                <div class="user-image mb-3 text-center">
                    <div class="imgPreview"> </div>
                </div>            

                <div class="custom-file">
                    <input type="file" name="imageFile[]" class="custom-file-input" id="images" multiple="multiple" accept="image/*">
                    <label class="custom-file-label" for="images">Choose image</label>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" name="btn2" class="btn btn-success addnoti">แจ้งซ่อม</button>
                </div>
            </form>

            <!-- jQuery -->
            <script>
                $(function() {
                // Multiple images preview with JavaScript
                var multiImgPreview = function(input, imgPreviewPlaceholder) {

                    if (input.files) {
                        var filesAmount = input.files.length;

                        for (i = 0; i < filesAmount; i++) {
                            var reader = new FileReader();

                            reader.onload = function(event) {
                                $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                            }

                            reader.readAsDataURL(input.files[i]);
                        }
                    }

                };

                $('#images').on('change', function() {
                    multiImgPreview(this, 'div.imgPreview');
                });
                });    
            </script>

        </div>
    </div>
</div>