const add = document.getElementById('add');
const deleted = document.getElementById('delete');
const change = document.getElementById('change');
const emailad = document.getElementById('email-ad');
const as400 = document.getElementById('as400');
const emailonly = document.getElementById('emailonly');
const adonly = document.getElementById('adonly');
const fileshare = document.getElementById('fileshare');
const workstation = document.getElementById('workstation');
const employee_no = document.getElementById('employee_no');
const name_user = document.getElementById('name');
const surname_user = document.getElementById('surname');
const position = document.getElementById('position');
const sect_id = document.getElementById('sect_id');
const system_as400 = document.getElementById('system_as400');
const prefix_id = document.getElementById('prefix_id');

$( document ).ready(function() {

    if(add.checked == true){
        selectedAdd();
    }

});

add.addEventListener('change', (event) => {
    if (event.currentTarget.checked) {
        selectedAdd();
        uncheckSubject();
        hideAdd();
        hideButton();
    }
});

deleted.addEventListener('change', (event) =>{
    if (event.currentTarget.checked) {
        selectedDeleteAndChange();
        uncheckSubject();
        hideAdd();
        hideButton();
    }
});

change.addEventListener('change', (event) =>{
    if (event.currentTarget.checked) {
        selectedDeleteAndChange();
        uncheckSubject();
        hideAdd();
        hideButton();
    }
});

function selectedAdd(){
    emailad.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            $('#hidden_user').show();
            $('#hidden_ad').show();
            emailonly.disabled  = true;
            adonly.disabled = true;
            
            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
        } 
        else{
            if(as400.checked == true){
                $('#hidden_user').show();
                $('#hidden_ad').hide();
                emailonly.disabled  = false;
                adonly.disabled = false;
            }
            else{
                $('#hidden_user').hide();
                $('#hidden_ad').hide();
                emailonly.disabled  = false;
                adonly.disabled = false;

                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
            }
        }
    
        hiddenbutton();
    });
    
    as400.addEventListener('change', (event) => {
        if(event.currentTarget.checked){
            $('#hidden_user').show();
            $('#hidden_as400').show();

            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
            system_as400.required = true;
        }
        else{
            if(emailad.checked == true){
                $('#hidden_user').show();
                $('#hidden_ad').show();
                $('#hidden_as400').hide();
                system_as400.required = false;
            }
            else if(emailonly.checked == true){
                $('#hidden_user').show();
                $('#hidden_as400').hide();
            }
            else if(adonly.checked == true){
                $('#hidden_user').show();
                $('#hidden_ad').show();
                $('#hidden_as400').hide();
            }
            else{
                $('#hidden_as400').hide();
                $('#hidden_user').hide();

                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
                system_as400.required = true;
            }
        }
    
        hiddenbutton();
    });
    
    emailonly.addEventListener('change', (event) => {
        if(event.currentTarget.checked){
            $('#hidden_user').show();
            emailad.disabled = true;
            adonly.disabled = true;

            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
        }
        else{
            if(as400.checked == true){
                $('#hidden_user').show();
                emailad.disabled = false;
                adonly.disabled = false;
            }
            else{
                $('#hidden_user').hide();
                emailad.disabled = false;
                adonly.disabled = false;

                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
            }
        }
    
        hiddenbutton();
    });
    
    adonly.addEventListener('change', (event) => {
        if(event.currentTarget.checked){
            $('#hidden_user').show();
            $('#hidden_ad').show();
            emailad.disabled = true;
            emailonly.disabled = true;

            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
        }
        else{
            if(as400.checked == true){
                $('#hidden_user').show();
                $('#hidden_ad').hide();
                emailad.disabled = false;
                emailonly.disabled = false;
            }
            else{
                $('#hidden_user').hide();
                $('#hidden_ad').hide();
                emailad.disabled = false;
                emailonly.disabled = false;

                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
            }
            
        }
    
        hiddenbutton();
    });
    
    fileshare.addEventListener('change', (event) =>{
        if(event.currentTarget.checked){
            $('#hidden_folder').show();
        }
        else{
            $('#hidden_folder').hide();
        }
    });
    
    workstation.addEventListener('change', (event) =>{
        if(event.currentTarget.checked){
            $('#hidden_workstation').show();
        }
        else{
            $('#hidden_workstation').hide();
        }
    });

}

function selectedDeleteAndChange(){
    emailad.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            $('#hidden_user').show();
            $('#hidden_ad').hide();
            emailonly.disabled  = true;
            adonly.disabled = true;

            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
        }
        else{
            if(as400.checked == true || emailonly.checked == true || adonly.checked == true){
                $('#hidden_user').show();
                $('#hidden_ad').hide();
                emailonly.disabled  = false;
                adonly.disabled = false;
            }
            else{
                $('#hidden_user').hide();
                $('#hidden_ad').hide();
                emailonly.disabled  = false;
                adonly.disabled = false;
                
                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
            }
        }
        hiddenbutton();
    });
    as400.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            $('#hidden_user').show();
            $('#hidden_as400').hide();

            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
            system_as400.required = false;
        }
        else{
            if(emailad.checked == true || emailonly.checked == true || adonly.checked == true){
                $('#hidden_delete').show();
            }else{
                $('#hidden_as400').hide();
                $('#hidden_user').hide();

                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
                system_as400.required = false;
            }
        }
        hiddenbutton();
    });
    emailonly.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            $('#hidden_delete').show();
            emailad.disabled = true;
            adonly.disabled = true;

            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
        }
        else{
            if(emailad.checked == true || as400.checked == true || adonly.checked == true){
                $('#hidden_delete').show();
                emailad.disabled = false;
                adonly.disabled = false;
            }
            else{
                $('#hidden_delete').hide();
                emailad.disabled = false;
                adonly.disabled = false;

                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
            }  
        }
        hiddenbutton();
    });

    adonly.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            $('#hidden_delete').show();
            $('#hidden_ad').hide();
            emailad.disabled = true;
            emailonly.disabled = true;

            employee_no.required = true;
            prefix_id.required = true;
            name_user.required = true;
            surname_user.required = true;
            position.required = true;
            sect_id.required = true;
        }
        else{
            if(emailad.checked == true || as400.checked == true || adonly.checked == true){
                $('#hidden_delete').show();
                emailad.disabled = false;
                emailonly.disabled = false;
            }
            else{
                $('#hidden_delete').hide();
                emailad.disabled = false;
                emailonly.disabled = false;

                employee_no.required = false;
                prefix_id.required = false;
                name_user.required = false;
                surname_user.required = false;
                position.required = false;
                sect_id.required = false;
            }
        }
        hiddenbutton();
    });
}

function hiddenbutton(){
    if(emailad.checked == true || as400.checked == true || emailonly.checked == true || adonly.checked == true){
        $('#hidden_button').show();
    }
    else{
        $('#hidden_button').hide();
    }
}

function hideAdd(){
    $('#hidden_user').hide();
    $('#hidden_ad').hide();
    $('#hidden_as400').hide();
}

function hideButton(){
    $('#hidden_button').hide();
}

function uncheckSubject(){
    emailad.checked = false;
    as400.checked = false;
    emailonly.checked = false;
    adonly.checked = false;
    emailad.disabled = false;
    as400.disabled = false;
    emailonly.disabled = false;
    adonly.disabled = false;
}