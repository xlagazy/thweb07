$(".frm").on("click",".assignrequestuser",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
       event.preventDefault()
       event.stopPropagation()
     }
     else{
       Swal.fire({
         title: 'Assign!',
         text: "คุณต้องการมอบหมายงานใช่หรือไม่่",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'ใช่',
         cancelButtonText: 'ไม่ใช่'
       }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'มอบหมายงานเรียบร้อย',    
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

$(".frmrefuse").on("click",".refuserequestuser",function(e){
  e.preventDefault();
  var form = $(this).parents('form');

  if (form[0].checkValidity() === false) {
     event.preventDefault()
     event.stopPropagation()
   }
   else{
     Swal.fire({
       title: 'Refuse!',
       text: "คุณต้องการปฏิเสธรับงานใช่หรือไม่่",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'ใช่',
       cancelButtonText: 'ไม่ใช่'
     }).then((result) => {
       if (result.isConfirmed) {
         Swal.fire(
           'ปฏิเสธรับงานเรียบร้อย',    
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