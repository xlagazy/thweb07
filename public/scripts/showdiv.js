/*document.getElementById('equipment_status').addEventListener('change', function () {
    var style = this.value == 'Broken' ? 'block' : 'none';
    document.getElementById('hidden_div_input').style.display = style;
    var style2 = this.value == 'Write off' ? 'block' : 'none';
    document.getElementById('hidden_div2_input').style.display = style2;
});*/

$(document).ready(function(){
    var equipment_status = $('#equipment_status').val();
    hide_show(equipment_status);
    
    $("#equipment_status").change(function() {
            var val = $(this).val();
            hide_show(val);
    });
});

function hide_show(equipment_status){
    if (equipment_status == "Write off") {
        $("#hidden_div2").show();
        $("#hidden_div").hide();
    }
    else if(equipment_status == "Broken"){
        $("#hidden_div").show();
        $("#hidden_div2").hide();
    } 
    else{
        $("#hidden_div").hide();
        $("#hidden_div2").hide();
    }    
}