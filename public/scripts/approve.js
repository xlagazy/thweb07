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

function approveRequestUserChief(request_user_no, user_id){
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
              window.location.href='/listrequestuser/approve/chief/'+request_user_no+'/'+user_id+'';
            }
        });
      }
    });
}

function approveRequestUserManager(request_user_no, user_id){
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
              window.location.href='/listrequestuser/approve/manager/'+request_user_no+'/'+user_id+'';
            }
        });
      }
    });
}

function approveEndRequestUserChief(request_user_no, user_id){
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
            window.location.href='/listrequestuser/approve/endchief/'+request_user_no+'/'+user_id+'';
          }
      });
    }
  });
}

function approveEndRequestUserManager(request_user_no, user_id){
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
            window.location.href='/listrequestuser/approve/endmanager/'+request_user_no+'/'+user_id+'';
          }
      });
    }
  });
}