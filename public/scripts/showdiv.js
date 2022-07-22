document.getElementById('equipment_status_input').addEventListener('change', function () {
    var style = this.value == 'Broken' ? 'block' : 'none';
    document.getElementById('hidden_div_input').style.display = style;
    var style2 = this.value == 'Write off' ? 'block' : 'none';
    document.getElementById('hidden_div2_input').style.display = style2;
});
