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
                              <p><b>Attach File (สามารถเลือกได้หลายไฟล์)</b><br>
                              <input type="file" name="files[]" accept=".pdf" id="attachment" multiple/>
                              <p id="files-area">
                                <span id="filesList">
                                  <span id="files-names"></span>
                                </span>
                              </p>
                          </div>
                      </div>
                </div>
            </div>

            <!-- script for multiple input file -->
            <script>
                const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

                $("#attachment").on('change', function(e){
                  for(var i = 0; i < this.files.length; i++){
                    let fileBloc = $('<span/>', {class: 'file-block'}),
                      fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
                    fileBloc.append('<span class="file-delete">&times;</span></span>')
                      .append(fileName);
                    $("#filesList > #files-names").append(fileBloc);
                  };
                  // Ajout des fichiers dans l'objet DataTransfer
                  for (let file of this.files) {
                    dt.items.add(file);
                  }
                  // Mise à jour des fichiers de l'input file après ajout
                  this.files = dt.files;

                  // EventListener pour le bouton de suppression créé
                  $('span.file-delete').click(function(){
                    let name = $(this).next('span.name').text();
                    // Supprimer l'affichage du nom de fichier
                    $(this).parent().remove();
                    for(let i = 0; i < dt.items.length; i++){
                      // Correspondance du fichier et du nom
                      if(name === dt.items[i].getAsFile().name){
                        // Suppression du fichier dans l'objet DataTransfer
                        dt.items.remove(i);
                        continue;
                      }
                    }
                    // Mise à jour des fichiers de l'input file après suppression
                    document.getElementById('attachment').files = dt.files;
                  });
                });
            </script>

            <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                  <button type="button" name="btn2" class="btn btn-success add">ส่งคำขอ</button>
            </div>
            
            <script type="text/javascript" src="{{ URL::asset('/scripts/validationrequest.js') }}"></script>

          </div>
      </div>
  </div>
</form>