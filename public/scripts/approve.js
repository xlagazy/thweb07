function apprveChiefUser(req_app_id, employee_no){
    console.log(req_app_id+" "+employee_no);
    Swal.fire({
        title: 'Approve!',
        text: "คุณต้องการ approve ใช่หรือไม่่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่ใช่'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
              'Approved',
              '',
              'success'
          ).then((result)=> {
              if(result.isConfirmed){
                window.location.href='/listrequestapp/approvechiefuser/'+req_app_id+'/'+employee_no+'';
              }
          });
        }
      });
}