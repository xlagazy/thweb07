@extends('request_system.master_request')
@section('contents')

<h2 class="text-center">IT Request User Control</h2>

        <script>

        var section = <?php echo json_encode($section); ?>;

        </script>

        <div class="border">
            <form action="/addrequestuser" method="post" enctype="multipart/form-data" class="frm">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <!-- group subject -->
                <div id="subject">
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0"><b>Subject (หัวข้อ)</b></legend>                    
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="subject" id="chkadd" value="0" checked>
                                <label class="form-check-label" for="chkadd">
                                    Add
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="subject" id="chkdelete" value="1">
                                <label class="form-check-label" for="chkdelete">
                                    Delete
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="subject" id="chkchange" value="2">
                                <label class="form-check-label" for="chkchange">
                                    Change
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Section (แผนก)</b></legend>
                    <div class="col-sm-10">           
                        <select name="sect_id" id="sect_id_1" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                            @foreach($section as $sections)
                                <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Effective date<br>(มีผลตั้งแต่วันที่)</b></legend>
                    <div class="col-sm-10">           
                        <input type="date" name="effective_date" id="effective_date" value=""  class="form-control" required />
                        <div class="invalid-feedback">Please input data</div>   
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Detail<br>(รายละเอียด)</b></legend>
                    <div class="col-sm-10">           
                        <textarea class="form-control" name="detail" id="detail" rows="3" required></textarea>
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
                                        <select name="relate_sect[]" id="relate_sect_1" class="form-control">
                                        <option disabled selected value>Choose...</option>
                                            @foreach($section as $sections)
                                                <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
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

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Attach file<br>(ไฟล์แนบ)</b></legend>
                    <div class="col-sm-10">           
                        <input type="file" name="files[]" accept=".pdf" id="attachment" multiple/>
                        <p id="files-area">
                        <span id="filesList">
                            <span id="files-names"></span>
                        </span>
                        </p>

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
                    </div>
                </div>

                <button type="button" id="addBtn" class="btn-success"><i class="fa fa-plus" aria-hidden="true"></i></button>
                <table style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">No. </th>
                            <th class="text-center" width="15%">Employee Number</th>
                            <th width="25%">Prefix</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Surname</th>
                            <th class="text-center">Position</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <tr id="R1">
                            <td class="text-center align-top">1</td>
                            <td class="align-top">
                                <input type="text" class="form-control" name="employee_no[]" id="employee_no_1" placeholder="Employee Number" required>
                                <div class="invalid-feedback">Please input data</div>  
                                <b>User Access</b>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="emailad[]" id="email-ad_1" onClick="selectEmailAD(this.id)">
                                    <label class="form-check-label" for="email-ad_1">
                                        Email and AD user
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="as400[]" id="as400_1" onClick="selectAS400(this.id)">
                                    <label class="form-check-label" for="as400_1">
                                        AS400 User
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="emailonly[]" id="emailonly_1" onClick="selectEmailOnly(this.id)">
                                    <label class="form-check-label" for="emailonly_1">
                                        Email Only
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="adonly[]" id="adonly_1" onClick="selectADOnly(this.id)">
                                    <label class="form-check-label" for="adonly_1">
                                        AD User Only
                                    </label>
                                </div>                        
                            </td>
                            <td class="align-top">
                                <select name="prefix_id[]" id="prefix_id_1" class="form-control" required>
                                <option disabled selected value>Choose...</option>
                                    @foreach($prefix as $prefixs)
                                        <option value="{{$prefixs->prefix_id}}">{{$prefixs->prefix_name}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please choose data</div> 
                                    <div id="hidden_ad_1" style="display:none;">
                                        <b>Permission</b>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="wireless[]" id="wireless_1" onClick="selectWireless(this.id)">
                                            <label class="form-check-label" for="wireless_1">
                                                Wireless Network
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="vpn[]" id="vpn_1" onClick="selectVPN(this.id)">
                                            <label class="form-check-label" for="vpn_1">
                                                VPN
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="fileshare[]" id="fileshare_1" onClick="selectFileshare(this.id)">
                                            <label class="form-check-label" for="fileshare_1">
                                                File Share
                                            </label>
                                        </div>
                                        <div id="hidden_folder_1" style="display:none;">
                                            <b>Folder Detail</b>
                                            <textarea class="form-control" name="folderdetail[]" id="folderdetail_1" rows="3"></textarea>
                                            <div class="invalid-feedback">Please input data</div>
                                        </div>
                                    </div>

                                    <div id="hidden_as400_1" style="display:none;">
                                        <b>AS400 User</b>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="workstation[]" id="workstation_1" onClick="selectWorkstation(this.id)" value="1">
                                            <label class="form-check-label" for="workstation_1">
                                                Work Station (If have not workstation don't check) 
                                        </div>
                                        <div id="hidden_wse_1" style="display:none;">
                                            <b>Work Station Number</b>
                                            <input type="text" class="form-control" name="workstation_no[]" id="workstation_no_1" placeholder="Work Station Number">
                                            <div class="invalid-feedback">Please input data</div>
                                        </div>
                                    </div>
                            </td>
                            <td class="align-top">
                                    <input type="text" class="form-control" name="name[]" id="name_1" placeholder="Name" required>
                                    <div class="invalid-feedback">Please input data</div>
                            </td>
                            <td class="align-top">
                                <input type="text" class="form-control" name="surname[]" id="surname_1" placeholder="Surname" required>
                                <div class="invalid-feedback">Please input data</div>
                            </td>
                            <td class="align-top">
                                <input type="text" class="form-control" name="position[]" id="position_1" placeholder="Position" required>
                                <div class="invalid-feedback">Please input data</div>
                            </td>
                        </tr>   
                    </tbody>
                </table>
                
                
                <div class="text-right">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                    <button type="button" name="btn2" class="btn btn-success addrequestuser">Request</button>
                </div>
            </form>
        </div>

    <script src="/scripts/showdiv_request_user.js"></script>
    <script src="/scripts/addrequest.js"></script>

@endsection