$(document).ready(function () {
 
    var rowIdx = 1;

    var options = new Array();
    $.each(section, function(index, data) {
        options.push('<option value="' + data.sect_id + '">'+ data.sect_name +'</option>');
    });

    for(let sections of section){
        '<option value="'+sections.sect_id+'">'+sections.sect_name+'</option>';
    };

    $('#addSect').on('click', function () {
        $('#tbodysect').append(`
            <tr id="RS${++rowIdx}">+
                <td>
                    <select name="relate_sect[]" id="relate_sect_${rowIdx}" class="form-control">
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

        rowIdx--;
    });

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
                <tr id="RS${++rowIdx}">+
                    <td>
                        <select name="relate_sect[]" id="relate_sect_${rowIdx}" class="form-control">
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
});