<form action="/addrequestapp" method="post" enctype="multipart/form-data" name="register" class="frm">
  <div class="modal fade" id="addrequestappmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title">Request Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                    
                  <div class="form-group border border-secondary frm-input">

                      <div class="row">
                          <div class="col">
                              <p><b>Need date (วันที่ต้องการ)</b><br>
                              <input type="date" id="req_app_need_date" name="req_app_need_date" required>
                              <span class="invalid-message" id="message_req_app_need_date"></span>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <p><b>Subject (โปรดระบุชื่อเรื่องที่ร้องขอ)</b><br>
                              <input type="text" id="req_app_subject" name="req_app_subject" required>
                              <span class="invalid-message" id="message_req_app_subject"></span>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <p><b>Now Situation or Problem (ลักษณะปัญหา หรือ งานปัจจุบันที่มีผลกระทบ)</b><br>
                              <textarea id="req_app_problem" name="req_app_problem" rows="4"></textarea>
                              <span class="invalid-message" id="message_req_app_problem"></span>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <p><b>Reference Document no. (Ex. Notice No., Control No.)</b><br>
                              <input type="text" name="req_app_refer">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <p><b>Request Details (รายละเอียดของงานที่ร้องขอ)</b><br>
                              <textarea id="req_app_detail" name="req_app_detail" rows="4"></textarea>
                              <span class="invalid-message" id="message_req_app_detail"></span>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <p><b>Attach File</b><br>
                              <input type="file" name="attach_file">
                          </div>
                      </div>
                </div>
            </div>

            <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button type="button" name="btn2" class="btn btn-success add">ส่งคำขอ</button>
            </div>
            
            <script type="text/javascript" src="{{ URL::asset('/scripts/validationrequest.js') }}"></script>

          </div>
      </div>
  </div>
</form>