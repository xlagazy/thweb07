$("body").on("click",".export",function(e){
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
            window.location.href = "/exportsoftware"
          }
      });
    }
  })
});