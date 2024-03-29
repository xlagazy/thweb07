$(".frm").on("click",".addrequestuser",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
       event.preventDefault()
       event.stopPropagation()
     }
     else{
       Swal.fire({
         title: 'ร้องขอ',
         text: "คุณต้องการร้องขอสิทธิ์ผู้ใช้งานใช่หรือไม่",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'ใช่',
         cancelButtonText: 'ไม่ใช่'
       }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'ร้องขอสิทธิ์ผู้ใช้งานเรียบร้อย',    
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
     
     form.addClass('was-validated');
});

$(".frm").on("click",".addrequestadmin",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
       event.preventDefault()
       event.stopPropagation()
     }
     else{
       Swal.fire({
         title: 'ร้องขอ',
         text: "คุณต้องการร้องขอใช่หรือไม่",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'ใช่',
         cancelButtonText: 'ไม่ใช่'
       }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'ร้องขอเรียบร้อย',    
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
     
     form.addClass('was-validated');
});