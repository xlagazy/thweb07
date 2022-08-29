$(".frm").on("click",".add_borrow",function(e){

    var equipment_no = document.getElementById('equipment_no').value;
    var error = false;
    var error_borrow = false;
    var message_invalid;
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }
    else{

      //equipment data from listborrow.blade.php
      for(let stocks of stock){

          if(equipment_no === stocks.equipment_no && stocks.stock_status == 2){
              error_borrow = true;
              break;
          }
          if(equipment_no === stocks.equipment_no){
              error = true;
              break;
          }

      }

      if(error_borrow == true){
        message_invalid = "มีการยืม Equipment นี้อยู่แล้ว";
        document.getElementById( "invalid-data" ).innerHTML = message_invalid;
      
        return false;
      }

      if(error == false){

        message_invalid = "ไม่พบ Stock กรุณากรอกใหม่";
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