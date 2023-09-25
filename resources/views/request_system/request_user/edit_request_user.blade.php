@extends('request_system.master_request')
@section('contents')

<div class="ct_listuser">
    <h2 class="text-center">Update IT Request User Control (#{{$request_user[0]->track}})</h2>

        <script>

        var section = <?php echo json_encode($section); ?>;
        var prefix = <?php echo json_encode($prefix); ?>;

        </script>

        <div class="border">
            <form action="/updaterequestuserit" method="post" enctype="multipart/form-data" class="frm">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "no" value = "{{$request_user[0]->no}}" >
                <!-- group subject -->
                <div id="subject">
                    <div class="form-group row">
                        <legend class="col-form-label col-sm-2 pt-0"><b>Subject (หัวข้อ)</b></legend>                    
                        <div class="col-sm-10">
                            <div class="form-check">
                                @if($request_user[0]->subject == 0)
                                    <input class="form-check-input" type="radio" name="subject" id="chkadd" value="0" checked>
                                    <label class="form-check-label" for="chkadd">
                                        Add
                                    </label>
                                @else
                                    <input class="form-check-input" type="radio" name="subject" id="chkadd" value="0">
                                    <label class="form-check-label" for="chkadd">
                                        Add
                                    </label>
                                @endif
                            </div>
                            <div class="form-check">
                                @if($request_user[0]->subject == 1)
                                    <input class="form-check-input" type="radio" name="subject" id="chkdelete" value="1" checked>
                                    <label class="form-check-label" for="chkdelete">
                                        Delete
                                    </label>
                                @else
                                    <input class="form-check-input" type="radio" name="subject" id="chkdelete" value="1">
                                    <label class="form-check-label" for="chkdelete">
                                        Delete
                                    </label>
                                @endif
                            </div>
                            <div class="form-check">
                                @if($request_user[0]->subject == 2)
                                    <input class="form-check-input" type="radio" name="subject" id="chkchange" value="2" checked>
                                    <label class="form-check-label" for="chkchange">
                                        Change
                                    </label>
                                @else
                                    <input class="form-check-input" type="radio" name="subject" id="chkchange" value="2">
                                    <label class="form-check-label" for="chkchange">
                                        Change
                                    </label>
                                @endif
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
                                @if($request_user[0]->sect_id == $sections->sect_id)
                                    <option value="{{$sections->sect_id}}" selected>{{$sections->sect_name}}</option>
                                @else
                                    <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Effective date<br>(มีผลตั้งแต่วันที่)</b></legend>
                    <div class="col-sm-10">           
                        <input type="date" name="effective_date" id="effective_date" value="{{$request_user[0]->effective_date}}"  class="form-control" required />
                        <div class="invalid-feedback">Please input data</div>   
                    </div>
                </div>

                <div class="form-group row">
                    <legend class="col-form-label col-sm-2 pt-0"><b>Detail<br>(รายละเอียด)</b></legend>
                    <div class="col-sm-10">           
                        <textarea class="form-control" name="detail" id="detail" rows="3" required>{{$request_user[0]->detail}}</textarea>
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
                                            $arr_relate_sect = json_decode($request_user[0]->relate_sect);
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
                    $arr_attach_file = json_decode($request_user[0]->attach_file);
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

                <!-- Parse relate_sect data to php -->
                @php
                    $arrEmployeeNo = json_decode($request_user[0]->employee_no);
                    $arrPrefix = json_decode($request_user[0]->prefix);
                    $arrName = json_decode($request_user[0]->name_user);
                    $arrSurname = json_decode($request_user[0]->surname_user);
                    $arrPosition = json_decode($request_user[0]->position);
                    $arrEmailAD = json_decode($request_user[0]->email_ad);
                    $arrAS400 = json_decode($request_user[0]->as400_user);
                    $arrEmailOnly = json_decode($request_user[0]->email_only);
                    $arrADOnly = json_decode($request_user[0]->ad_only);
                    $arrEmailOnly = json_decode($request_user[0]->email_only);
                    $arrWireless = json_decode($request_user[0]->wireless);
                    $arrVPN = json_decode($request_user[0]->vpn);
                    $arrFileshare = json_decode($request_user[0]->fileshare);
                    $arrFolderDetail = json_decode($request_user[0]->folder_detail);
                    $arrWorkstation = json_decode($request_user[0]->workstation);
                    $arrWorkstationNo = json_decode($request_user[0]->workstation_no);

                    $count = count($arrEmployeeNo);

                    if(isset($arrEmailAD)){
                        $countEmailAD = count($arrEmailAD);
                    }
                    if(isset($arrAS400)){
                        $countAS400 = count($arrAS400);
                    }
                    if(isset($arrEmailOnly)){
                        $countEmailOnly = count($arrEmailOnly);
                    }
                    if(isset($arrADOnly)){
                        $countADOnly = count($arrADOnly);
                    }
                    if(isset($arrWireless)){
                        $countWireless = count($arrWireless);
                    }
                    if(isset($arrVPN)){
                        $countVPN = count($arrVPN);
                    }
                    if(isset($arrFileshare)){
                        $countFileshare = count($arrFileshare);
                    }
                    if(isset($arrWorkstation)){
                        $countWorkstation = count($arrWorkstation);
                    }
                @endphp
                
                <!-- parse data to script-->
                <script>
                    var arrEmployeeNo = <?php echo json_encode($arrEmployeeNo); ?>;
                    var arrPrefix = <?php echo json_encode($arrPrefix); ?>;
                    var arrName = <?php echo json_encode($arrName); ?>;
                    var arrSurname = <?php echo json_encode($arrSurname); ?>;
                    var arrPosition = <?php echo json_encode($arrPosition); ?>;
                    var arrEmailAD = <?php echo json_encode($arrEmailAD); ?>;
                    var arrAS400 = <?php echo json_encode($arrAS400); ?>;
                    var arrEmailOnly = <?php echo json_encode($arrEmailOnly); ?>;
                    var arrADOnly = <?php echo json_encode($arrADOnly); ?>;
                    var arrEmailOnly = <?php echo json_encode($arrEmailOnly); ?>;
                    var arrWireless = <?php echo json_encode($arrWireless); ?>;
                    var arrVPN = <?php echo json_encode($arrVPN); ?>;
                    var arrFileshare = <?php echo json_encode($arrFileshare); ?>;
                    var arrFolderDetail = <?php echo json_encode($arrFolderDetail); ?>;
                    var arrWorkstation = <?php echo json_encode($arrWorkstation); ?>;
                    var arrWorkstationNo = <?php echo json_encode($arrWorkstationNo); ?>;
                </script>

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
                                <input type="text" class="form-control" name="employee_no[]" id="employee_no_1" placeholder="Employee Number" value="{{$arrEmployeeNo[0]}}" required>
                                <div class="invalid-feedback">Please input data</div>  
                                <b>User Access</b>
                                @php
                                    $chkEmailAd = 1;
                                    $chkAS400 = 1;
                                    $chkEmailOnly = 1;
                                    $chkADOnly = 1;
                                    $chkWireless = 1;
                                    $chkVPN = 1;
                                    $chkFileshare = 1;
                                    $chkWorkStation = 1;

                                    $stEmailAd = 1;
                                    $stAS400 = 1;
                                    $stFileshare = 1;
                                    $stWorkstation = 1;
                                @endphp  
                                <div class="form-check">
                                    @if($request_user[0]->email_ad == "null")
                                        <input class="form-check-input" type="checkbox" name="emailad[]" id="email-ad_1" onClick="selectEmailAD(this.id)">
                                        <label class="form-check-label" for="email-ad_1">
                                            Email and AD user
                                        </label>
                                    @else
                                        @for($x=0;$x<$countEmailAD;$x++)
                                            @if($chkEmailAd != 2)
                                                @if(substr($arrEmailAD[$x], -1) == 1)
                                                    <input class="form-check-input" type="checkbox" name="emailad[]" id="email-ad_1" onClick="selectEmailAD(this.id)" checked>
                                                    <label class="form-check-label" for="email-ad_1">
                                                        Email and AD user
                                                    </label>
                                                    @php
                                                        $chkEmailAd = 2;
                                                        $stEmailAd = 2;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endfor

                                        @if($chkEmailAd == 1)
                                            <input class="form-check-input" type="checkbox" name="emailad[]" id="email-ad_1" onClick="selectEmailAD(this.id)" checked>
                                            <label class="form-check-label" for="email-ad_1">
                                                Email and AD user
                                            </label>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-check">
                                    @if($request_user[0]->as400_user == "null")
                                        <input class="form-check-input" type="checkbox" name="as400[]" id="as400_1" onClick="selectAS400(this.id)">
                                        <label class="form-check-label" for="as400_1">
                                            AS400 User
                                        </label>
                                    @else
                                        @for($x=0;$x<$countAS400;$x++)
                                            @if($chkAS400 != 2)
                                                @if(substr($arrAS400[$x], -1) == 1)
                                                    <input class="form-check-input" type="checkbox" name="as400[]" id="as400_1" onClick="selectAS400(this.id)" checked>
                                                    <label class="form-check-label" for="as400_1">
                                                        AS400 User
                                                    </label>
                                                    @php
                                                        $chkAS400 = 2;
                                                        $stAS400 = 2;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endfor

                                        @if($chkAS400 == 1)
                                            <input class="form-check-input" type="checkbox" name="as400[]" id="as400_1" onClick="selectAS400(this.id)">
                                            <label class="form-check-label" for="as400_1">
                                                AS400 User
                                            </label>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-check">
                                    @if($request_user[0]->email_only == "null")
                                        <input class="form-check-input" type="checkbox" name="emailonly[]" id="emailonly_1" onClick="selectEmailOnly(this.id)">
                                        <label class="form-check-label" for="emailonly_1">
                                            Email Only
                                        </label>
                                    @else
                                        @for($x=0;$x<$countEmailOnly;$x++)
                                            @if($chkEmailOnly != 2)
                                                @if(substr($arrEmailOnly[$x], -1) == 1)
                                                    <input class="form-check-input" type="checkbox" name="emailonly[]" id="emailonly_1" onClick="selectEmailOnly(this.id)" checked>
                                                    <label class="form-check-label" for="emailonly_1">
                                                        Email Only
                                                    </label>
                                                    @php
                                                        $chkEmailOnly = 2;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endfor

                                        @if($chkEmailOnly == 1)
                                            <input class="form-check-input" type="checkbox" name="emailonly[]" id="emailonly_1" onLoad="selectEmailOnly(this.id)" onClick="selectEmailOnly(this.id)">
                                            <label class="form-check-label" for="emailonly_1">
                                                Email Only
                                            </label>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-check">
                                    @if($request_user[0]->ad_only == "null")
                                        <input class="form-check-input" type="checkbox" name="adonly[]" id="adonly_1" onClick="selectADOnly(this.id)">
                                        <label class="form-check-label" for="adonly_1">
                                            AD User Only
                                        </label>
                                    @else
                                        @for($x=0;$x<$countADOnly;$x++)
                                            @if($chkADOnly != 2)
                                                @if(substr($arrADOnly[$x], -1) == 1)
                                                    <input class="form-check-input" type="checkbox" name="adonly[]" id="adonly_1" onClick="selectADOnly(this.id)" checked>
                                                    <label class="form-check-label" for="adonly_1">
                                                        AD User Only
                                                    </label>
                                                    @php
                                                        $chkADOnly = 2;
                                                    @endphp
                                                @endif
                                            @endif
                                        @endfor

                                        @if($chkADOnly == 1)
                                            <input class="form-check-input" type="checkbox" name="adonly[]" id="adonly_1" onClick="selectADOnly(this.id)">
                                            <label class="form-check-label" for="adonly_1">
                                                AD User Only
                                            </label>
                                        @endif
                                    @endif
                                </div>          
                            </td>
                            <td class="align-top">
                                <select name="prefix_id[]" id="prefix_id_1" class="form-control" required>
                                <option disabled selected value>Choose...</option>
                                    @foreach($prefix as $prefixs)
                                        @if($arrPrefix[0] == $prefixs->prefix_id)
                                            <option value="{{$prefixs->prefix_id}}" selected>{{$prefixs->prefix_name}}</option>
                                        @else
                                            <option value="{{$prefixs->prefix_id}}">{{$prefixs->prefix_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please choose data</div> 
                                    <div id="hidden_ad_1" style="display:none;">
                                        <b>Permission</b>
                                        <div class="form-check">
                                            @if($request_user[0]->wireless == "null")
                                                <input class="form-check-input" type="checkbox" name="wireless[]" id="wireless_1" onClick="selectWireless(this.id)">
                                                <label class="form-check-label" for="wireless_1">
                                                    Wireless Network
                                                </label>
                                            @else
                                                @for($x=0;$x<$countWireless;$x++)
                                                    @if($chkWireless != 2)
                                                        @if(substr($arrWireless[$x], -1) == 1)
                                                            <input class="form-check-input" type="checkbox" name="wireless[]" id="wireless_1" onClick="selectWireless(this.id)" checked>
                                                            <label class="form-check-label" for="wireless_1">
                                                                Wireless Network
                                                            </label>
                                                            @php
                                                                $chkWireless = 2;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endfor

                                                @if($chkWireless == 1)
                                                    <input class="form-check-input" type="checkbox" name="wireless[]" id="wireless_1" onClick="selectWireless(this.id)" >
                                                    <label class="form-check-label" for="wireless_1">
                                                        Wireless Network
                                                    </label>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="form-check">
                                            @if($request_user[0]->vpn == "null")
                                                <input class="form-check-input" type="checkbox" name="vpn[]" id="vpn_1" onClick="selectVPN(this.id)">
                                                <label class="form-check-label" for="vpn_1">
                                                    VPN
                                                </label>
                                            @else
                                                @for($x=0;$x<$countVPN;$x++)
                                                    @if($chkVPN != 2)
                                                        @if(substr($arrVPN[$x], -1) == 1)
                                                            <input class="form-check-input" type="checkbox" name="vpn[]" id="vpn_1" onClick="selectVPN(this.id)" checked>
                                                            <label class="form-check-label" for="vpn_1">
                                                                VPN
                                                            </label>
                                                            @php
                                                                $chkVPN = 2;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endfor

                                                @if($chkVPN == 1)
                                                    <input class="form-check-input" type="checkbox" name="vpn[]" id="vpn_1" onClick="selectVPN(this.id)">
                                                    <label class="form-check-label" for="vpn_1">
                                                        VPN
                                                    </label>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="form-check">
                                            @if($request_user[0]->fileshare == "null")
                                                <input class="form-check-input" type="checkbox" name="fileshare[]" id="fileshare_1" onClick="selectFileshare(this.id)">
                                                <label class="form-check-label" for="fileshare_1">
                                                    File Share
                                                </label>
                                            @else
                                                @for($x=0;$x<$countFileshare;$x++)
                                                    @if($chkFileshare != 2)
                                                        @if(substr($arrFileshare[$x], -1) == 1)
                                                            <input class="form-check-input" type="checkbox" name="fileshare[]" id="fileshare_1" onClick="selectFileshare(this.id)" checked>
                                                            <label class="form-check-label" for="fileshare_1">
                                                                File Share
                                                            </label>
                                                            @php
                                                                $chkFileshare = 2;
                                                                $stFileshare = 2;
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endfor

                                                @if($chkFileshare == 1)
                                                    <input class="form-check-input" type="checkbox" name="fileshare[]" id="fileshare_1" onClick="selectFileshare(this.id)">
                                                    <label class="form-check-label" for="fileshare_1">
                                                        File Share
                                                    </label>
                                                @endif
                                            @endif
                                        </div>
                                        <div id="hidden_folder_1" style="display:none;">
                                                <b>Folder Detail</b>
                                                <textarea class="form-control" name="folderdetail[]" id="folderdetail_1" rows="3">{{$arrFolderDetail[0]}}</textarea>
                                                <div class="invalid-feedback">Please input data</div>
                                        </div>
                                    </div>

                                    <div id="hidden_as400_1" style="display:none;">
                                        <b>AS400 User</b>
                                        <div class="form-check">
                                            @if($request_user[0]->workstation == "null")
                                                <input class="form-check-input" type="checkbox" name="workstation[]" id="workstation_1" onClick="selectWorkstation(this.id)" value="1">
                                                <label class="form-check-label" for="workstation_1">
                                                    Work Station (If have not workstation don't check) 
                                            @else
                                                @for($x=0;$x<$countWorkstation;$x++)
                                                    @if($chkWorkStation != 2)
                                                        @if(substr($arrWorkstation[$x], -1) == 1)
                                                            <input class="form-check-input" type="checkbox" name="workstation[]" id="workstation_1" onClick="selectWorkstation(this.id)" value="1" checked>
                                                            <label class="form-check-label" for="workstation_1">
                                                                Work Station (If have not workstation don't check) 
                                                            @php
                                                                $chkWorkStation = 2;
                                                                $stWorkstation = 2
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endfor

                                                @if($chkWorkStation == 1)
                                                    <input class="form-check-input" type="checkbox" name="workstation[]" id="workstation_1" onClick="selectWorkstation(this.id)" value="1">
                                                    <label class="form-check-label" for="workstation_1">
                                                        Work Station (If have not workstation don't check) 
                                                @endif

                                            @endif
                                        </div>
                                        <div id="hidden_wse_1" style="display:none;">
                                            <b>Work Station Number</b>
                                            <input type="text" class="form-control" name="workstation_no[]" id="workstation_no_1" placeholder="Work Station Number" value="{{$arrWorkstationNo[0]}}">
                                            <div class="invalid-feedback">Please input data</div>
                                        </div>
                                    </div>
                            </td>
                            <td class="align-top">
                                    <input type="text" class="form-control" name="name[]" id="name_1" placeholder="Name" value="{{$arrName[0]}}" required>
                                    <div class="invalid-feedback">Please input data</div>
                            </td>
                            <td class="align-top">
                                <input type="text" class="form-control" name="surname[]" id="surname_1" placeholder="Surname" value="{{$arrSurname[0]}}" required>
                                <div class="invalid-feedback">Please input data</div>
                            </td>
                            <td class="align-top">
                                <input type="text" class="form-control" name="position[]" id="position_1" placeholder="Position" value="{{$arrPosition[0]}}" required>
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

    <script src="/scripts/showdiv_request_user_edt.js"></script>
    <script src="/scripts/addrequestuser.js"></script>

</div>

@endsection