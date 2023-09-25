@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')
<div class="ct_listuser">
    <h2 class="text-center">IT Request Admin Control</h2>

        <script>

        var section = <?php echo json_encode($section); ?>;

        </script>

        <div class="border">
            <form action="/updaterequestadminit" method="post" enctype="multipart/form-data" class="frm">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "no" value = "{{$request_admin[0]->no}}" >
                <!-- group subject -->
                <div id="subject">
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0"><b>Subject <br> (โปรดระบุชื่องานที่ร้องขอ)</b></legend>                    
                        <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Please input data"  value="{{$request_admin[0]->subject}}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Requested Section <br>(แผนกที่ร้องขอ)</b></legend>
                    <div class="col-sm-10">           
                        <select name="sect_id" id="sect_id_1" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                            @foreach($section as $sections)
                                @if($request_admin[0]->sect_id == $sections->sect_id)
                                    <option value="{{$sections->sect_id}}" selected>{{$sections->sect_name}}</option>
                                @else
                                    <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Need date<br>(วันที่ต้องการ)</b></legend>
                    <div class="col-sm-10">           
                        <input type="date" name="need_date" id="need_date" value="{{$request_admin[0]->need_date}}"  class="form-control" required />
                        <div class="invalid-feedback">Please input data</div>   
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Reason or Problem<br>(เหตุผลหรืองานปัจจุบันที่มีผลกระทบ)</b></legend>
                    <div class="col-sm-10">           
                        <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="Please attach details" required>{{$request_admin[0]->reason}}</textarea>
                        <div class="invalid-feedback">Please input data</div> 
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Reference Document no.</b></legend>                    
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="reference" id="refernce" placeholder="(Ex. notice No, Control No., User Claim, Audit, Project name, 5S, KPI etc)" value="{{$request_admin[0]->reference}}" >
                        
                    </div>
                </div>
                
                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Request Details<br>(รายละเอียดงานที่ร้องขอ)</b></legend>
                    <div class="col-sm-10">           
                        <textarea class="form-control" name="detail" id="detail" rows="3" placeholder="Please attach details" required>{{$request_admin[0]->detail}}</textarea>
                        <div class="invalid-feedback">Please input data</div> 
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Related to Other section</b></legend>
                    <div class="col-sm-10">           
                        <table style="width:100%;">
                            <tbody id="tbodysect">
                                <tr id="RS1">
                                    <td>
                                        <!-- Parse relate_sect data to php -->
                                        @php
                                            $arr_relate_sect = json_decode($request_admin[0]->relate_sect);
                                        @endphp

                                        <!-- Parse relate_sect data to script -->
                                        <script>
                                            var relate_sect = <?php echo json_encode($arr_relate_sect); ?>
                                        </script>

                                        <select name="relate_sect[]" id="relate_sect_1" class="form-control">
                                        <option disabled selected value>Choose...</option>
                                            @foreach($section as $sections)
                                                @if(isset($arr_relate_sect[0]))
                                                    @if($arr_relate_sect[0] == $sections->sect_id)
                                                        <option value="{{$sections->sect_id}}" selected>{{$sections->sect_name}}</option>
                                                    @else
                                                        <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" id="addSect" class="btn btn-light" style="width:100%;margin-top:1%;">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <!-- Parse data attach to script -->
                @php
                    $arr_attach_file = json_decode($request_admin[0]->attach_file);
                @endphp
                <script>
                    var attach_file = <?php echo json_encode($arr_attach_file); ?>
                </script>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Attach file<br>(ไฟล์แนบ)</b></legend>
                    <div class="col-sm-10">           
                        <input type="file" name="files[]" accept=".pdf" id="attachment" multiple/>
                        @php
                            if(isset($arr_attach_file)){
                                $countattachfile = count($arr_attach_file);
                                for($i=0;$i<$countattachfile;$i++){
                                    echo '<input type="hidden" name="old_file[]" id="old_file_'.$i.'"/>';                            
                                }
                            }
                        @endphp
                        <p id="files-area">
                        <span id="filesList">
                            <span id="files-names"></span>
                        </span>
                        </p>

                        <!-- script for multiple input file -->
                        <script>
                            const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file
                            $( document ).ready(function() {
                                var old_file = [];
                                for(var i=0;i<attach_file.length;i++){
                                    let fileBloc = $('<span/>', {class: 'file-block'}),
                                    fileName = $('<span/>', {class: 'name', text: attach_file[i]});
                                    fileBloc.append('<span class="file-delete"><br>&times;</span></span>')
                                    .append(fileName);
                                    $("#filesList > #files-names").append(fileBloc);

                                    old_file.push(attach_file[i]);
                                    document.getElementById('old_file_'+i).value = attach_file[i];
                                }

                                $('span.file-delete').click(function(){
                                    let name = $(this).next('span.name').text();

                                    $(this).parent().remove();

                                    old_file = $.grep(old_file, function(n) {
                                        return n != name;
                                    });
                                    
                                    if(old_file == ""){
                                        old_file.push("null");
                                    }

                                    var result_old_file = [];
                                    for(var i=0;i<attach_file.length;i++){
                                        for(var x=0;x<old_file.length;x++){
                                            if(attach_file[i] != old_file[x]){
                                                document.getElementById('old_file_'+i).value = "";
                                            }
                                        }
                                    }
                                });

                            });

                            $("#attachment").on('change', function(e){
                                for(var i = 0; i < this.files.length; i++){
                                    let fileBloc = $('<span/>', {class: 'file-block'}),
                                    fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
                                    fileBloc.append('<span class="file-delete"><br>&times;</span></span>')
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
                    </div>
                </div>
                
                <div class="text-right">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                    <button type="button" name="btn2" class="btn btn-success addrequestadmin">Request</button>
                </div>
            </form>
        </div>
</div>

    <script src="/scripts/showdiv_request_admin_edt.js"></script>
    <script src="/scripts/addrequest.js"></script>

@endsection