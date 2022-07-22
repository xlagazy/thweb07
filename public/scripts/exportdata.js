$(".frmexport").on("click",".export",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
       event.preventDefault()
       event.stopPropagation()
     }
     else{
       Swal.fire({
         title: 'Export',
         text: "คุณต้องการ export ข้อมูลใช่หรือไม่่",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'ใช่',
         cancelButtonText: 'ไม่ใช่'
       }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
               'Export ข้อมูลเรียบร้อย',
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