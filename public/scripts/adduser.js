$(".frm").on("click",".add_user",function(e){
     e.preventDefault();
     var form = $(this).parents('form');

     if (form[0].checkValidity() === false) {
        event.preventDefault()
        event.stopPropagation()
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
      
      form.addClass('was-validated');
});