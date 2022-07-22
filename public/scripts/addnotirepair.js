$(".frm").on("click",".addnoti",function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@nisdt.co.th/;

    if (form[0].checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
    }
    else{
        if (!filter.test(email.value)) {
            message_invalid = "กรุณากรอกอีเมล์ให้ถูกต้อง เช่น example@nisdt.co.th";
            document.getElementById( "invalid-data-noti" ).innerHTML = message_invalid;
            
            return false;
        }
        else{
            //hide message if true data
            if (filter.test(email.value)){
              message_invalid = "";
              document.getElementById( "invalid-data-noti" ).innerHTML = message_invalid;
            }
            Swal.fire({
              title: 'แจ้งซ่อม',
              text: "คุณต้องการแจ้งซ่อม ใช่หรือไม่่",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'ใช่',
              cancelButtonText: 'ไม่ใช่'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                    'แจ้งซ่อมเรียบร้อยเรียบร้อย',
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