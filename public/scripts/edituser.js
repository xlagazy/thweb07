$(".frmedt").on("click",".edt",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
       event.preventDefault()
       event.stopPropagation()
     }
     else{
       Swal.fire({
         title: 'บันทึก',
         text: "คุณต้องการบันทึก ใช่หรือไม่่",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'ใช่',
         cancelButtonText: 'ไม่ใช่'
       }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
               'บันทึกเรียบร้อย',
               '',
              'success'
           ).then((result)=> {
               if(result.isConfirmed){
                 form.submit();
               }
           });
         }
       })
     }
     
     form.addClass('was-validated');
});