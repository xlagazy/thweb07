///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////LOAD PAGE//////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function () {

    const chkadd = document.getElementById("chkadd");
    const chkdelete = document.getElementById("chkdelete");
    const chkchange = document.getElementById("chkchange");
    
    var rowIdx = 1;
    var rowIdx2 = 1;
    
    //load begin page edit request user
    if(document.getElementById("email-ad_1").checked == true){
        loadEmailAD('1');
    }
    if(document.getElementById("as400_1").checked == true){
        loadAS400('1');
    }
    if(document.getElementById("emailonly_1").checked == true){
        loadEmailOnly('1');
    }
    if(document.getElementById("adonly_1").checked == true){
        loadADOnly('1');
    }
    if(document.getElementById('fileshare_1').checked == true){
        loadFileshare('1');
    }
    if(document.getElementById('workstation_1').checked == true){
        loadWorkstation('1');
    }
    if(document.getElementById('wireless_1').checked == true){
        loadWireless('1');
    }
    if(document.getElementById('vpn_1').checked == true){
        loadVPN('1');
    }


    //foreach option section
    var options = new Array();
    $.each(section, function(index, data) {
        options.push('<option value="' + data.sect_id + '">'+ data.sect_name +'</option>');
    });

    //add dato to list user access
    for(var i=0;i<arrEmployeeNo.length;i++){
        var optionprefix = new Array();
        $.each(prefix, function(index, data){
            if(arrPrefix[i] == data.prefix_id){
                optionprefix.push('<option value="'+ data.prefix_id + '" selected>'+ data.prefix_name +'</option>');
            }
            else{
                optionprefix.push('<option value="'+ data.prefix_id + '">'+ data.prefix_name +'</option>');
            }
        });

        if(i != 0){

            ++rowIdx;
            
            var checkedEmailAD = "";
            var checkedAS400 = "";
            var checkedEmailOnly = "";
            var checkedADOnly = "";
            var checkedWireless = "";
            var checkedVPN = "";
            var checkedFileshare = "";
            var checkedWorkstation = "";

            if(arrEmailAD !== null){
                for(var x=0;x<arrEmailAD.length;x++){
                    if(arrEmailAD[i].substr(-1) == i+1){
                        checkedEmailAD = "checked";
                        break;
                    }
                }
            }

            if(arrAS400 !== null){
                for(var x=0;x<arrAS400.length;x++){
                    if(arrAS400[x].substr(-1) == i+1){
                        checkedAS400 = "checked";
                        break;
                    }
                }
            }

            if(arrEmailOnly !== null){
                for(var x=0;x<arrEmailOnly.length;x++){
                    if(arrEmailOnly[x].substr(-1) == i+1){
                        checkedEmailOnly = "checked";
                        break;
                    }
                }
            }

            if(arrADOnly !== null){
                for(var x=0;x<arrADOnly.length;x++){
                    if(arrADOnly[x].substr(-1) == i+1){
                        checkedADOnly = "checked";
                        break;
                    }
                }
            }

            if(arrWireless !== null){
                for(var x=0;x<arrWireless.length;x++){
                    if(arrWireless[x].substr(-1) == i+1){
                        checkedWireless = "checked";
                        break;
                    }
                }
            }

            if(arrVPN !== null){
                for(var x=0;x<arrVPN.length;x++){
                    if(arrVPN[x].substr(-1) == i+1){
                        checkedVPN = "checked";
                        break;
                    }
                }
            }

            if(arrFileshare !== null){
                for(var x=0;x<arrFileshare.length;x++){
                    if(arrFileshare[x].substr(-1) == i+1){
                        checkedFileshare = "checked";
                        break;
                    }
                }
            }

            if(arrWorkstation !== null){
                for(var x=0;x<arrWorkstation.length;x++){
                    if(arrWorkstation[x].substr(-1) == i+1){
                        checkedWorkstation = "checked";
                        break;
                    }
                }
            }

            $('#tbody').append(`
            <tr id="R${rowIdx}">
                <td class="text-center align-top">${rowIdx}</td>
                <td class="align-top">
                    <input type="text" class="form-control" name="employee_no[]" id="employee_no_${rowIdx}" placeholder="Employee Number" value="${arrEmployeeNo[i]}" required>
                    <div class="invalid-feedback">Please input data</div>  
                    <b>User Access</b>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="emailad[]" id="email-ad_${rowIdx}" onClick="selectEmailAD(this.id)" ${checkedEmailAD}>
                        <label class="form-check-label" for="email-ad_${rowIdx}">
                            Email and AD user
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="as400[]" id="as400_${rowIdx}" onClick="selectAS400(this.id)" value="1" ${checkedAS400}>
                        <label class="form-check-label" for="as400_${rowIdx}">
                            AS400 User
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="emailonly[]" id="emailonly_${rowIdx}" onClick="selectEmailOnly(this.id)" value="1" ${checkedEmailOnly}>
                        <label class="form-check-label" for="emailonly_${rowIdx}">
                            Email Only
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="adonly[]" id="adonly_${rowIdx}" onClick="selectADOnly(this.id)" value="1" ${checkedADOnly}>
                        <label class="form-check-label" for="adonly_${rowIdx}">
                            AD User Only
                        </label>
                    </div>                        
                </td>
                <td class="align-top">
                       
                    <select name="prefix_id[]" id="prefix_id_${rowIdx}" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        ${optionprefix}
                    </select>

                    <div class="invalid-feedback">Please choose data</div> 
                        <div id="hidden_ad_${rowIdx}" style="display:none;">
                            <b>Permission</b>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="wireless[]" id="wireless_${rowIdx}" onClick="selectWireless(this.id)" value="1" ${checkedWireless}>
                                <label class="form-check-label" for="wireless_${rowIdx}">
                                    Wireless Network
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vpn[]" id="vpn_${rowIdx}" onClick="selectVPN(this.id)" value="1" ${checkedVPN}>
                                <label class="form-check-label" for="vpn_${rowIdx}">
                                    VPN
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fileshare[]" id="fileshare_${rowIdx}" onClick="selectFileshare(this.id)" value="1" ${checkedFileshare}>
                                <label class="form-check-label" for="fileshare_${rowIdx}">
                                    File Share
                                </label>
                            </div>
                            <div id="hidden_folder_${rowIdx}" style="display:none;">
                                <b>Folder Detail</b>
                                <textarea class="form-control" name="folderdetail[]" id="folderdetail_${rowIdx}" rows="3">${arrFolderDetail[i]}</textarea>
                                <div class="invalid-feedback">Please input data</div>
                            </div>
                        </div>

                        <div id="hidden_as400_${rowIdx}" style="display:none;">
                            <b>AS400 User</b>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="workstation[]" id="workstation_${rowIdx}" onClick="selectWorkstation(this.id)" value="1" ${checkedWorkstation}>
                                <label class="form-check-label" for="workstation_${rowIdx}">
                                    Work Station (If have not workstation don't check) 
                            </div>
                            <div id="hidden_wse_${rowIdx}" style="display:none;">
                                <b>Work Station Number</b>
                                <input type="text" class="form-control" name="workstation_no[]" id="workstation_no_${rowIdx}" placeholder="Work Station Number" value="${arrWorkstationNo[i]}">
                                <div class="invalid-feedback">Please input data</div>
                            </div>
                    </div>
                </td>
                <td class="align-top">
                    <input type="text" class="form-control" name="name[]" id="name_${rowIdx}" placeholder="Name" value="${arrName[i]}" required>
                    <div class="invalid-feedback">Please input data</div>
                </td>
                <td class="align-top">
                    <input type="text" class="form-control" name="surname[]" id="surname_${rowIdx}" placeholder="Surname" value="${arrSurname[i]}" required>
                    <div class="invalid-feedback">Please input data</div>
                </td>
                <td class="align-top">
                    <input type="text" class="form-control" name="position[]" id="position_${rowIdx}" placeholder="Position" value="${arrPosition[i]}" required>
                    <div class="invalid-feedback">Please input data</div>
                </td>
                <td>
                    <button class="btn btn-danger remove"
                    type="button"><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>`);

            checkUserAccess(document.getElementById("email-ad_"+rowIdx), document.getElementById("as400_"+rowIdx), 
                            document.getElementById("emailonly_"+rowIdx), document.getElementById("adonly_"+rowIdx));

            //load begin page edit request user
            if(document.getElementById("email-ad_"+rowIdx).checked == true){
                loadEmailAD(rowIdx.toString());
            }
            if(document.getElementById("as400_"+rowIdx).checked == true){
                loadAS400(rowIdx.toString());
            }
            if(document.getElementById("emailonly_"+rowIdx).checked == true){
                loadEmailOnly(rowIdx.toString());
            }
            if(document.getElementById("adonly_"+rowIdx).checked == true){
                loadADOnly(rowIdx.toString());
            }
            if(document.getElementById('fileshare_'+rowIdx).checked == true){
                loadFileshare(rowIdx.toString());
            }
            if(document.getElementById('workstation_'+rowIdx).checked == true){
                loadWorkstation(rowIdx.toString());
            }
            if(document.getElementById('wireless_'+rowIdx).checked == true){
                loadWireless(rowIdx.toString());
            }
            if(document.getElementById('vpn_'+rowIdx).checked == true){
                loadVPN(rowIdx.toString());
            }
        }
    }

    //add data to relate section
    if(relate_sect !== null){
        for(var i=0;i<relate_sect.length;i++){

            var optionsedt = new Array();
            $.each(section, function(index, data) {
                if(relate_sect[i] == data.sect_id){
                    optionsedt.push('<option value="' + data.sect_id + '" selected>'+ data.sect_name +'</option>');
                }
                else{
                    optionsedt.push('<option value="' + data.sect_id + '">'+ data.sect_name +'</option>');
                }
            });
    
            if(i != 0){
                $('#tbodysect').append(`
                <tr id="RS${rowIdx2+i}">+
                    <td>
                        <select name="relate_sect[]" id="relate_sect_${rowIdx2}" class="form-control">
                        <option disabled selected value>Choose...</option>
                        ${optionsedt}
                        </select>
                    </td>
                    <td width="5%">
                        <button class="btn btn-danger remove"
                        type="button"><i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>`);
            }
    }
    
    }

    for(let sections of section){
        '<option value="'+sections.sect_id+'">'+sections.sect_name+'</option>';
    };

    //load begin page check user access
    checkUserAccess(document.getElementById("email-ad_1"), document.getElementById("as400_1"), 
                    document.getElementById("emailonly_1"), document.getElementById("adonly_1"));

    //button add list request user
    $('#addBtn').on('click', function () {

        $('#tbody').append(`
            <tr id="R${++rowIdx}">
                <td class="text-center align-top">${rowIdx}</td>
                <td class="align-top">
                    <input type="text" class="form-control" name="employee_no[]" id="employee_no_${rowIdx}" placeholder="Employee Number" required>
                    <div class="invalid-feedback">Please input data</div>  
                    <b>User Access</b>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="emailad[]" id="email-ad_${rowIdx}" onClick="selectEmailAD(this.id)">
                        <label class="form-check-label" for="email-ad_${rowIdx}">
                            Email and AD user
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="as400[]" id="as400_${rowIdx}" onClick="selectAS400(this.id)" value="1">
                        <label class="form-check-label" for="as400_${rowIdx}">
                            AS400 User
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="emailonly[]" id="emailonly_${rowIdx}" onClick="selectEmailOnly(this.id)" value="1">
                        <label class="form-check-label" for="emailonly_${rowIdx}">
                            Email Only
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="adonly[]" id="adonly_${rowIdx}" onClick="selectADOnly(this.id)" value="1">
                        <label class="form-check-label" for="adonly_${rowIdx}">
                            AD User Only
                        </label>
                    </div>                        
                </td>
                <td class="align-top">
                       
                    <select name="prefix_id[]" id="prefix_id_${rowIdx}" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        <option value="1">Mr.</option>
                        <option value="2">Ms.</option>
                        <option value="3">Mrs.</option>
                    </select>

                    <div class="invalid-feedback">Please choose data</div> 
                        <div id="hidden_ad_${rowIdx}" style="display:none;">
                            <b>Permission</b>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="wireless[]" id="wireless_${rowIdx}" onClick="selectWireless(this.id)" value="1">
                                <label class="form-check-label" for="wireless_${rowIdx}">
                                    Wireless Network
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vpn[]" id="vpn_${rowIdx}" onClick="selectVPN(this.id)" value="1">
                                <label class="form-check-label" for="vpn_${rowIdx}">
                                    VPN
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fileshare[]" id="fileshare_${rowIdx}" onClick="selectFileshare(this.id)" value="1">
                                <label class="form-check-label" for="fileshare_${rowIdx}">
                                    File Share
                                </label>
                            </div>
                            <div id="hidden_folder_${rowIdx}" style="display:none;">
                                <b>Folder Detail</b>
                                <textarea class="form-control" name="folderdetail[]" id="folderdetail_${rowIdx}" rows="3"></textarea>
                                <div class="invalid-feedback">Please input data</div>
                            </div>
                        </div>

                        <div id="hidden_as400_${rowIdx}" style="display:none;">
                            <b>AS400 User</b>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="workstation[]" id="workstation_${rowIdx}" onClick="selectWorkstation(this.id)" value="1">
                                <label class="form-check-label" for="workstation_${rowIdx}">
                                    Work Station (If have not workstation don't check) 
                            </div>
                            <div id="hidden_wse_${rowIdx}" style="display:none;">
                                <b>Work Station Number</b>
                                <input type="text" class="form-control" name="workstation_no[]" id="workstation_no_${rowIdx}" placeholder="Work Station Number">
                                <div class="invalid-feedback">Please input data</div>
                            </div>
                    </div>
                </td>
                <td class="align-top">
                        <input type="text" class="form-control" name="name[]" id="name_${rowIdx}" placeholder="Name" required>
                        <div class="invalid-feedback">Please input data</div>
                </td>
                <td class="align-top">
                    <input type="text" class="form-control" name="surname[]" id="surname_${rowIdx}" placeholder="Surname" required>
                    <div class="invalid-feedback">Please input data</div>
                </td>
                <td class="align-top">
                    <input type="text" class="form-control" name="position[]" id="position_${rowIdx}" placeholder="Position" required>
                    <div class="invalid-feedback">Please input data</div>
                </td>
                <td>
                    <button class="btn btn-danger remove"
                    type="button"><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>`);

            checkUserAccess(document.getElementById("email-ad_"+rowIdx), document.getElementById("as400_"+rowIdx), 
                            document.getElementById("emailonly_"+rowIdx), document.getElementById("adonly_"+rowIdx));
    });

    //button add list relate section
    $('#addSect').on('click', function () {
        $('#tbodysect').append(`
            <tr id="RS${++rowIdx2}">+
                <td>
                    <select name="relate_sect[]" id="relate_sect_${rowIdx2}" class="form-control">
                    <option disabled selected value>Choose...</option>
                    ${options}
                    </select>
                </td>
                <td width="5%">
                    <button class="btn btn-danger remove"
                    type="button"><i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </tr>`);
    });

    //button delete list request user
    $('#tbody').on('click', '.remove', function () {

        var child = $(this).closest('tr').nextAll();

        child.each(function () {

        var id = $(this).attr('id');
        var idx = $(this).children('.row-index').children('label');
        var dig = parseInt(id.substring(1));

        idx.html(`${dig - 1}`);

        $(this).attr('id', `R${dig - 1}`);
        });

        $(this).closest('tr').remove();

        rowIdx--;
    });

    //button delete relate section
    $('#tbodysect').on('click', '.remove', function () {

        var child = $(this).closest('tr').nextAll();

        child.each(function () {

        var id = $(this).attr('id');
        var idx = $(this).children('.row-index').children('label');
        var dig = parseInt(id.substring(1));

        idx.html(`${dig - 1}`);

        $(this).attr('id', `R${dig - 1}`);
        });

        $(this).closest('tr').remove();

        rowIdx2--;
    });

});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////FUNCTION///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function selectEmailAD(selectEmailAD){
    var no = selectEmailAD.substring(selectEmailAD.length - 1);
    //subject add checked action 
    if(chkadd.checked == true){
        document.getElementById('email-ad_'+no).addEventListener('change', (event) =>{
            if (event.currentTarget.checked) {
                document.getElementById('email-ad_'+no).value = "1_"+no;

                document.getElementById('emailonly_'+no).disabled = true;
                document.getElementById('adonly_'+no).disabled = true;

                document.getElementById('hidden_ad_'+no).style.display = '';

                document.getElementById('wireless_'+no).required = true;
                document.getElementById('vpn_'+no).required = true;
                document.getElementById('fileshare_'+no).required = true;
            }
            else{                
                if(document.getElementById('as400_'+no).checked == true){
                    document.getElementById('emailonly_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;

                    document.getElementById('hidden_ad_'+no).style.display = 'none';

                    document.getElementById('wireless_'+no).required = false;
                    document.getElementById('vpn_'+no).required = false;
                    document.getElementById('fileshare_'+no).required = false;
                }
                else{
                    document.getElementById('emailonly_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;

                    document.getElementById('hidden_ad_'+no).style.display = 'none';

                    document.getElementById('wireless_'+no).required = false;
                    document.getElementById('vpn_'+no).required = false;
                    document.getElementById('fileshare_'+no).required = false;
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
        });
    }

    //subject delete and change checked action
    if(chkdelete.checked == true || chkchange.checked == true){
        document.getElementById('email-ad_'+no).addEventListener('change', (event) =>{
            if (event.currentTarget.checked) {
                document.getElementById('email-ad_'+no).value = "1_"+no;

                document.getElementById('emailonly_'+no).disabled = true;
                document.getElementById('adonly_'+no).disabled = true;

                document.getElementById('hidden_ad_'+no).style.display = 'none';
            }
            else{
                if(document.getElementById('as400_'+no).checked == true){
                    document.getElementById('emailonly_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
                else{
                    document.getElementById('emailonly_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
        });
    }    
}

function selectAS400(selectAS400){
    var no = selectAS400.substring(selectAS400.length - 1);
    //subject add checked action 
    if(chkadd.checked == true){

        document.getElementById('as400_'+no).addEventListener('change', (event) => {
            if(event.currentTarget.checked){    
                document.getElementById('as400_'+no).value = "1_"+no;

                document.getElementById('hidden_as400_'+no).style.display = '';
            }
            else{
                if(document.getElementById('email-ad_'+no).checked == true){
                    document.getElementById('hidden_as400_'+no).style.display = 'none';
                }
                else if(document.getElementById('emailonly_'+no).checked == true){
                    document.getElementById('hidden_as400_'+no).style.display = 'none';
                }
                else if(document.getElementById('adonly_'+no).checked == true){
                    document.getElementById('hidden_as400_'+no).style.display = 'none';
                }
                else{
                    document.getElementById('hidden_as400_'+no).style.display = 'none';
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
        });

    }

    //subject delete and change checked action
    if(chkdelete.checked == true || chkchange.checked == true){
        document.getElementById('as400_'+no).addEventListener('change', (event) => {
            if(event.currentTarget.checked){    
                document.getElementById('as400_'+no).value = "1_"+no;

                document.getElementById('hidden_as400_'+no).style.display = 'none';
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
        });
    }
}

function selectEmailOnly(selectEmailOnly){
    var no = selectEmailOnly.substring(selectEmailOnly.length - 1);
    //subject add checked action 
    if(chkadd.checked == true){

        document.getElementById('emailonly_'+no).addEventListener('change', (event) => {
            if(event.currentTarget.checked){
                document.getElementById('emailonly_'+no).value = "1_"+no;

                document.getElementById('email-ad_'+no).disabled = true;
                document.getElementById('adonly_'+no).disabled = true;
            }
            else{
                if(document.getElementById('as400_'+no).checked == true){
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
                else{
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
        });

    }

    //subject delete and change checked action
    if(chkdelete.checked == true || chkchange.checked == true){
        document.getElementById('emailonly_'+no).addEventListener('change', (event) => {
            if(event.currentTarget.checked){
                document.getElementById('emailonly_'+no).value = "1_"+no;

                document.getElementById('email-ad_'+no).disabled = true;
                document.getElementById('adonly_'+no).disabled = true;
            }
            else{
                if(document.getElementById('as400_'+no).checked == true){
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
                else{
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
        });
    }
}

function selectADOnly(selectADOnly){
    var no = selectADOnly.substring(selectADOnly.length - 1);
    //subject add checked action 
    if(chkadd.checked == true){
        document.getElementById('adonly_'+no).addEventListener('change', (event) => {
            if(event.currentTarget.checked){
                document.getElementById('adonly_'+no).value = "1_"+no;

                document.getElementById('email-ad_'+no).disabled = true;
                document.getElementById('emailonly_'+no).disabled = true;

                document.getElementById('hidden_ad_'+no).style.display = '';

                document.getElementById('wireless_'+no).required = true;
                document.getElementById('vpn_'+no).required = true;
                document.getElementById('fileshare_'+no).required = true;
            }
            else{
                if(document.getElementById('as400_'+no).checked == true){
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('emailonly_'+no).disabled = false;

                    document.getElementById('hidden_ad_'+no).style.display = 'none';

                    document.getElementById('wireless_'+no).required = false;
                    document.getElementById('vpn_'+no).required = false;
                    document.getElementById('fileshare_'+no).required = false;
                }
                else{
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('emailonly_'+no).disabled = false;

                    document.getElementById('hidden_ad_'+no).style.display = 'none';

                    document.getElementById('wireless_'+no).required = false;
                    document.getElementById('vpn_'+no).required = false;
                    document.getElementById('fileshare_'+no).required = false;
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
        });
    }

    //subject delete and change checked action
    if(chkdelete.checked == true || chkchange.checked == true){
        document.getElementById('adonly_'+no).addEventListener('change', (event) => {
            if(event.currentTarget.checked){
                document.getElementById('adonly_'+no).value = "1_"+no;

                document.getElementById('email-ad_'+no).disabled = true;
                document.getElementById('emailonly_'+no).disabled = true;

                document.getElementById('hidden_ad_'+no).style.display = 'none';
            }
            else{
                if(document.getElementById('as400_'+no).checked == true){
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('emailonly_'+no).disabled = false;
                }
                else{
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('emailonly_'+no).disabled = false;
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));

        });
    }
}

function loadEmailAD(selectEmailAD){
    var no = selectEmailAD.substring(selectEmailAD.length - 1);

    //subject add checked action 
    if(chkadd.checked == true){
        if (document.getElementById('email-ad_'+no).checked == true) {
            document.getElementById('email-ad_'+no).value = "1_"+no;

            document.getElementById('emailonly_'+no).disabled = true;
            document.getElementById('adonly_'+no).disabled = true;

            document.getElementById('hidden_ad_'+no).style.display = '';

            document.getElementById('wireless_'+no).required = true;
            document.getElementById('vpn_'+no).required = true;
            document.getElementById('fileshare_'+no).required = true;
        }
        else{                
            if(document.getElementById('as400_'+no).checked == true){
                document.getElementById('emailonly_'+no).disabled = false;
                document.getElementById('adonly_'+no).disabled = false;

                document.getElementById('hidden_ad_'+no).style.display = 'none';

                document.getElementById('wireless_'+no).required = false;
                document.getElementById('vpn_'+no).required = false;
                document.getElementById('fileshare_'+no).required = false;
            }
            else{
                document.getElementById('emailonly_'+no).disabled = false;
                document.getElementById('adonly_'+no).disabled = false;

                document.getElementById('hidden_ad_'+no).style.display = 'none';

                document.getElementById('wireless_'+no).required = false;
                document.getElementById('vpn_'+no).required = false;
                document.getElementById('fileshare_'+no).required = false;
            }
        }

        checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                        document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
    }
}

function loadAS400(selectAS400){
    var no = selectAS400.substring(selectAS400.length - 1);
    //subject add checked action 
    if(chkadd.checked == true){

        if(document.getElementById('as400_'+no).checked == true){    
            document.getElementById('as400_'+no).value = "1_"+no;

            document.getElementById('hidden_as400_'+no).style.display = '';
        }
        else{
            if(document.getElementById('email-ad_'+no).checked == true){
                document.getElementById('hidden_as400_'+no).style.display = 'none';
            }
            else if(document.getElementById('emailonly_'+no).checked == true){
                document.getElementById('hidden_as400_'+no).style.display = 'none';
            }
            else if(document.getElementById('adonly_'+no).checked == true){
                document.getElementById('hidden_as400_'+no).style.display = 'none';
            }
            else{
                document.getElementById('hidden_as400_'+no).style.display = 'none';
            }
        }

        checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                        document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));

    }

    //subject delete and change checked action
    if(chkdelete.checked == true || chkchange.checked == true){
        if(document.getElementById('as400_'+no).checked == true){    
            document.getElementById('as400_'+no).value = "1_"+no;

            document.getElementById('hidden_as400_'+no).style.display = 'none';
        }

        checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                        document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
    }
}

function loadEmailOnly(selectEmailOnly){
    var no = selectEmailOnly.substring(selectEmailOnly.length - 1);
    //subject add checked action 
    if(chkadd.checked == true){

        if(document.getElementById('emailonly_'+no).checked == true){
            document.getElementById('emailonly_'+no).value = "1_"+no;

            document.getElementById('email-ad_'+no).disabled = true;
            document.getElementById('adonly_'+no).disabled = true;
        }
        else{
            if(document.getElementById('as400_'+no).checked == true){
                document.getElementById('email-ad_'+no).disabled = false;
                document.getElementById('adonly_'+no).disabled = false;
            }
            else{
                document.getElementById('email-ad_'+no).disabled = false;
                document.getElementById('adonly_'+no).disabled = false;
            }
        }

       checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                       document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));

    }

    //subject delete and change checked action
    if(chkdelete.checked == true || chkchange.checked == true){
            if(document.getElementById('emailonly_'+no).checked == true){
                document.getElementById('emailonly_'+no).value = "1_"+no;

                document.getElementById('email-ad_'+no).disabled = true;
                document.getElementById('adonly_'+no).disabled = true;
            }
            else{
                if(document.getElementById('as400_'+no).checked == true){
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
                else{
                    document.getElementById('email-ad_'+no).disabled = false;
                    document.getElementById('adonly_'+no).disabled = false;
                }
            }

            checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                            document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
    }
}

function loadADOnly(selectADOnly){
    var no = selectADOnly.substring(selectADOnly.length - 1);

    //subject add checked action 
    if(chkadd.checked == true){
        if(document.getElementById('adonly_'+no).checked == true){
            document.getElementById('adonly_'+no).value = "1_"+no;

            document.getElementById('email-ad_'+no).disabled = true;
            document.getElementById('emailonly_'+no).disabled = true;

            document.getElementById('hidden_ad_'+no).style.display = '';

            document.getElementById('wireless_'+no).required = true;
            document.getElementById('vpn_'+no).required = true;
            document.getElementById('fileshare_'+no).required = true;
        }
        else{
            if(document.getElementById('as400_'+no).checked == true){
                document.getElementById('email-ad_'+no).disabled = false;
                document.getElementById('emailonly_'+no).disabled = false;

                document.getElementById('hidden_ad_'+no).style.display = 'none';

                document.getElementById('wireless_'+no).required = false;
                document.getElementById('vpn_'+no).required = false;
                document.getElementById('fileshare_'+no).required = false;
            }
            else{
                document.getElementById('email-ad_'+no).disabled = false;
                document.getElementById('emailonly_'+no).disabled = false;

                document.getElementById('hidden_ad_'+no).style.display = 'none';

                document.getElementById('wireless_'+no).required = false;
                document.getElementById('vpn_'+no).required = false;
                document.getElementById('fileshare_'+no).required = false;
            }
        }

        checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                        document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));
    }

    //subject delete and change checked action
    if(chkdelete.checked == true || chkchange.checked == true){
        if(document.getElementById('adonly_'+no).checked == true){
            document.getElementById('adonly_'+no).value = "1_"+no;

            document.getElementById('email-ad_'+no).disabled = true;
            document.getElementById('emailonly_'+no).disabled = true;

            document.getElementById('hidden_ad_'+no).style.display = 'none';
        }
        else{
            if(document.getElementById('as400_'+no).checked == true){
                document.getElementById('email-ad_'+no).disabled = false;
                document.getElementById('emailonly_'+no).disabled = false;
            }
            else{
                document.getElementById('email-ad_'+no).disabled = false;
                document.getElementById('emailonly_'+no).disabled = false;
            }
        }

        checkUserAccess(document.getElementById("email-ad_"+no), document.getElementById("as400_"+no), 
                        document.getElementById("emailonly_"+no), document.getElementById("adonly_"+no));

    }
}

function selectFileshare(selectFileshare){
    var no = selectFileshare.substring(selectFileshare.length - 1);

    document.getElementById('fileshare_'+no).addEventListener('change', (event) => {
        if(event.currentTarget.checked){
            document.getElementById('fileshare_'+no).value = "1_"+no;

            document.getElementById('hidden_folder_'+no).style.display = '';

            document.getElementById('folderdetail_'+no).required = true;

            document.getElementById('wireless_'+no).required = false;
            document.getElementById('vpn_'+no).required = false;
            document.getElementById('fileshare_'+no).required = false;
        }
        else{

            if(document.getElementById('wireless_'+no).checked == false && document.getElementById('vpn_'+no).checked == false &&
                document.getElementById('wireless_'+no).checked == false){
                document.getElementById('wireless_'+no).required = true;
                document.getElementById('vpn_'+no).required = true;
                document.getElementById('fileshare_'+no).required = true;
            }

            document.getElementById('hidden_folder_'+no).style.display = 'none';

            document.getElementById('folderdetail_'+no).required = false;
        }
    });
}

function loadFileshare(selectFileshare){
    var no = selectFileshare.substring(selectFileshare.length - 1);

    if(document.getElementById('fileshare_'+no).checked == true){
        document.getElementById('fileshare_'+no).value = "1_"+no;

        document.getElementById('hidden_folder_'+no).style.display = '';

        document.getElementById('folderdetail_'+no).required = true;

        document.getElementById('wireless_'+no).required = false;
        document.getElementById('vpn_'+no).required = false;
        document.getElementById('fileshare_'+no).required = false;
    }
    else{

        if(document.getElementById('wireless_'+no).checked == false && document.getElementById('vpn_'+no).checked == false &&
            document.getElementById('wireless_'+no).checked == false){
            document.getElementById('wireless_'+no).required = true;
            document.getElementById('vpn_'+no).required = true;
            document.getElementById('fileshare_'+no).required = true;
        }

        document.getElementById('hidden_folder_'+no).style.display = 'none';

        document.getElementById('folderdetail_'+no).required = false;
    }
}

function loadWorkstation(selectWorkstation){
    var no = selectWorkstation.substring(selectWorkstation.length - 1); 
    if(document.getElementById('workstation_'+no).checked == true){
        document.getElementById('workstation_'+no).value = "1_"+no;

        document.getElementById('hidden_wse_'+no).style.display = '';

        document.getElementById('workstation_no_'+no).required = true;
    }
    else{
        document.getElementById('hidden_wse_'+no).style.display = 'none';
        
        document.getElementById('workstation_no_'+no).required = false;
    }
}

function selectWorkstation(selectWorkstation){
    var no = selectWorkstation.substring(selectWorkstation.length - 1); 
    document.getElementById('workstation_'+no).addEventListener('change', (event) => {
        if(event.currentTarget.checked){
            document.getElementById('workstation_'+no).value = "1_"+no;

            document.getElementById('hidden_wse_'+no).style.display = '';

            document.getElementById('workstation_no_'+no).required = true;
        }
        else{
            document.getElementById('hidden_wse_'+no).style.display = 'none';
            
            document.getElementById('workstation_no_'+no).required = false;
        }
    });
}

function loadWireless(selectWireless){
    var no = selectWireless.substring(selectWireless.length - 1);
    if(document.getElementById('wireless_'+no).checked == true){
        document.getElementById('wireless_'+no).value = "1_"+no;

        document.getElementById('wireless_'+no).required = false;
        document.getElementById('vpn_'+no).required = false;
        document.getElementById('fileshare_'+no).required = false;
    }
    else{
        if(document.getElementById('wireless_'+no).checked == false && document.getElementById('vpn_'+no).checked == false &&
            document.getElementById('wireless_'+no).checked == false){
            document.getElementById('wireless_'+no).required = true;
            document.getElementById('vpn_'+no).required = true;
            document.getElementById('fileshare_'+no).required = true;
        }
    }
}

function selectWireless(selectWireless){
    var no = selectWireless.substring(selectWireless.length - 1);
    document.getElementById('wireless_'+no).addEventListener('change', (event) => {
        if(event.currentTarget.checked){
            document.getElementById('wireless_'+no).value = "1_"+no;

            document.getElementById('wireless_'+no).required = false;
            document.getElementById('vpn_'+no).required = false;
            document.getElementById('fileshare_'+no).required = false;
       }
       else{
            if(document.getElementById('wireless_'+no).checked == false && document.getElementById('vpn_'+no).checked == false &&
                document.getElementById('wireless_'+no).checked == false){
                document.getElementById('wireless_'+no).required = true;
                document.getElementById('vpn_'+no).required = true;
                document.getElementById('fileshare_'+no).required = true;
            }
       }
    });
}

function loadVPN(selectVPN){
    var no = selectVPN.substring(selectVPN.length - 1);

    if(document.getElementById('vpn_'+no).checked == true){
        document.getElementById('vpn_'+no).value = "1_"+no;

        document.getElementById('wireless_'+no).required = false;
        document.getElementById('vpn_'+no).required = false;
        document.getElementById('fileshare_'+no).required = false;
    }
    else{
        if(document.getElementById('wireless_'+no).checked == false && document.getElementById('vpn_'+no).checked == false &&
            document.getElementById('wireless_'+no).checked == false){
            document.getElementById('wireless_'+no).required = true;
            document.getElementById('vpn_'+no).required = true;
            document.getElementById('fileshare_'+no).required = true;
        }
    }
}

function selectVPN(selectVPN){
    var no = selectVPN.substring(selectVPN.length - 1);
    document.getElementById('vpn_'+no).addEventListener('change', (event) => {
        if(event.currentTarget.checked){
            document.getElementById('vpn_'+no).value = "1_"+no;

            document.getElementById('wireless_'+no).required = false;
            document.getElementById('vpn_'+no).required = false;
            document.getElementById('fileshare_'+no).required = false;
       }
       else{
            if(document.getElementById('wireless_'+no).checked == false && document.getElementById('vpn_'+no).checked == false &&
                document.getElementById('wireless_'+no).checked == false){
                document.getElementById('wireless_'+no).required = true;
                document.getElementById('vpn_'+no).required = true;
                document.getElementById('fileshare_'+no).required = true;
            }
       }
    });
}

function checkUserAccess(chkemailad, chkas400, chkemailonly, chkadonly){
    if(chkemailad.checked == false && chkas400.checked == false && chkemailonly.checked == false && chkadonly.checked == false){
        chkemailad.required = true;
        chkas400.required = true;
        chkemailonly.required = true;
        chkadonly.required = true;
    }
    else if(chkemailad.checked == true){
        chkemailad.required = false;
        chkas400.required = false;
        chkemailonly.required = false;
        chkadonly.required = false;
    }
    else if(chkas400.checked == true){
        chkemailad.required = false;
        chkas400.required = false;
        chkemailonly.required = false;
        chkadonly.required = false;
    }
    else if(chkemailonly.checked == true){
        chkemailad.required = false;
        chkas400.required = false;
        chkemailonly.required = false;
        chkadonly.required = false;
    }
    else if(chkadonly.checked == true){
        chkemailad.required = false;
        chkas400.required = false;
        chkemailonly.required = false;
        chkadonly.required = false;
    }
}
