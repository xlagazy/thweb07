<div class="modal fade" id="settingmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Request Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <form action="/signaturerequest" method="post" enctype="multipart/form-data" class="frm">

                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                
                <div class="form-group">
                        <label><b>Signature</b></label>
                        <div style="text-align:center; margin-bottom:1%; ">
                            @php 
                              $signature = App\Http\Controllers\RequestController::imgSignature();
                            @endphp

                            @if(empty($signature)))
                                <img src="" id="img" style="widht:150px;;height:200px;">
                            @else
                                <img src="/images/signature_request/{{$signature[0]->signature}}" id="img" style="widht:150px;;height:200px;">
                            @endif
                        </div>
                        <input type="file" class="form-control" name="file"
                        onchange="img.src=window.URL.createObjectURL(this.files[0]) " accept="image/*" />
               </div>

               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                     <button type="button" name="btn2" class="btn btn-success save">บันทึก</button>
               </div>

            </form>

            <script type="text/javascript" src="{{ URL::asset('/scripts/savesignature.js') }}"></script>
        </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>