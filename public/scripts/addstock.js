$(".frm").on("click",".add_stock",function(e){

    var equipment_no = document.getElementById('equipment_no').value;
    var error = false;
    var error_stock = false;
    var message_invalid;
    e.preventDefault();
     var form = $(this).parents('form');

     if (form[0].checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
      }
      else{

        //equipment data from liststock.blade.php
        for(let equipments of equipment){
            if(equipment_no === equipments.equipment_no){
                error = true;
                break;
            }
        }

        //stock data from liststock.blade.php
        for(let stocks of stock){
            if(equipment_no === stocks.equipment_no){
                error_stock = true;
                break;
            }
        }

        if(error == false){

            message_invalid = "ไม่พบ Equipment Number กรุณากรอกใหม่";
            document.getElementById( "invalid-data" ).innerHTML = message_invalid;
            
            return false;
        }
        else if(error_stock == true){
            message_invalid = "มี Equipment ในสต็อคอยู๋แล้ว";
            document.getElementById( "invalid-data" ).innerHTML = message_invalid;
            
            return false;
        }
        else{
            Swal.fire({
                title: 'เพิ่ม',
                text: "คุณต้องการเพิ่ม ใช่หรือไม่่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่',
                cancelButtonText: 'ไม่ใช่'
              }).then((result) => {
                if (result.isConfirmed) {
                  Swal.fire(
                      'เพิ่ม เรียบร้อย',
                      '',
                     'success'
                  ).then((result)=> {
                      if(result.isConfirmed){
                        form.submit();
                      }
                  });
                }
              });
        }

      }
      
      form.addClass('was-validated');
});