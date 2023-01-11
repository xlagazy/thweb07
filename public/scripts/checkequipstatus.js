document.getElementById('equipment_status').addEventListener('change', function () {
    if(this.value == 'Broken'){
        document.getElementById('cause_broken').required = true;
        document.getElementById('write_off_date').required = false;
    }
    if(this.value == 'Write off'){
        document.getElementById('write_off_date').required = true;
        document.getElementById('cause_broken').required = false;
    }
    if(this.value == 'Using'){
        document.getElementById('write_off_date').required = false;
        document.getElementById('cause_broken').required = false;
    }
});

$( document ).ready(function() {
    var cause_broken = document.getElementById('cause_broken').value;
    var write_off_date = document.getElementById('write_off_date').value;

    if(cause_broken != ""){
        document.getElementById('cause_broken').required = true;
    }
    if(write_off_date != ""){
        document.getElementById('write_off_date').required = true;
    }
});