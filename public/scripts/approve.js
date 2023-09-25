function apprveChiefUser(req_app_id, employee_no){
    console.log(req_app_id+" "+employee_no);
    Swal.fire({
        title: 'Approve!',
        text: "คุณต้องการ approve ใช่หรือไม่",
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

function approveRequestUserChief(request_user_no, employee_no){
    Swal.fire({
      title: 'Approve!',
      text: "คุณต้องการ approve ใช่หรือไม่",
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
              window.location.href='/listrequestuser/approve/chief/'+request_user_no+'/'+employee_no+'';
            }
        });
      }
    });
}

function approveRequestUserManager(request_user_no, user_id){
    Swal.fire({
      title: 'Approve!',
      text: "คุณต้องการ approve ใช่หรือไม่",
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

function approveEndRequestUserCharge(request_user_no, user_id){
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
            window.location.href='/listrequestuser/approve/endcharge/'+request_user_no+'/'+user_id+'';
          }
      });
    }
  });
}

function approveEndRequestUserChief(request_user_no, user_id){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
    text: "คุณต้องการ approve ใช่หรือไม่",
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

function approveRequestUserSectChief(fk_request_no, employee_no){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestuser/approve/sectchief/'+fk_request_no+'/'+employee_no+'';
          }
      });
    }
  });
}

function approveRequestUserSectManager(fk_request_no, employee_no){
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
            window.location.href='/listrequestuser/approve/sectmanager/'+fk_request_no+'/'+employee_no+'';
          }
      });
    }
  });
}

function approveRequestUserRelateSect(fk_request_no, employee_no, seq){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestuser/approve/relatesect/'+fk_request_no+'/'+employee_no+'/'+seq+'';
          }
      });
    }
  });
}

function confirmRequestUser(fk_request_no, employee_no){
  Swal.fire({
    title: 'Comfirm!',
    text: "คุณต้องการ confirm ใช่หรือไม่",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ใช่',
    cancelButtonText: 'ไม่ใช่'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
          'Confirmed',
          '',
          'success'
      ).then((result)=> {
          if(result.isConfirmed){
            window.location.href='/listrequestuser/confirmrequestuser/'+fk_request_no+'/'+employee_no+'';
          }
      });
    }
  });
}

function approveRequestAdminSectManager(fk_request_no, employee_no){
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
            window.location.href='/listrequestadmin/approve/sectmanager/'+fk_request_no+'/'+employee_no+'';
          }
      });
    }
  });
}

function approveRequestAdminSectChief(fk_request_no, employee_no){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestadmin/approve/sectchief/'+fk_request_no+'/'+employee_no+'';
          }
      });
    }
  });
}

function approveRequestAdminRelateSect(fk_request_no, employee_no, seq){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestadmin/approve/relatesect/'+fk_request_no+'/'+employee_no+'/'+seq+'';
          }
      });
    }
  });
}

function approveRequestAdminChief(request_admin_no, employee_no){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestadmin/approve/chief/'+request_admin_no+'/'+employee_no+'';
          }
      });
    }
  });
}

function approveRequestAdminManager(request_admin_no, user_id){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestadmin/approve/manager/'+request_admin_no+'/'+user_id+'';
          }
      });
    }
  });
}

function confirmRequestAdmin(fk_request_no, employee_no){
  Swal.fire({
    title: 'Comfirm!',
    text: "คุณต้องการ confirm ใช่หรือไม่",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'ใช่',
    cancelButtonText: 'ไม่ใช่'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
          'Confirmed',
          '',
          'success'
      ).then((result)=> {
          if(result.isConfirmed){
            window.location.href='/listrequestadmin/confirmrequestadmin/'+fk_request_no+'/'+employee_no+'';
          }
      });
    }
  });
}

function approveEndRequestAdminCharge(request_admin_no, user_id){
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
            window.location.href='/listrequestadmin/approve/endcharge/'+request_admin_no+'/'+user_id+'';
          }
      });
    }
  });
}

function approveEndRequestAdminChief(request_chief_no, user_id){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestadmin/approve/endchief/'+request_chief_no+'/'+user_id+'';
          }
      });
    }
  });
}

function approveEndRequestAdminManager(request_admin_no, user_id){
  Swal.fire({
    title: 'Approve!',
    text: "คุณต้องการ approve ใช่หรือไม่",
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
            window.location.href='/listrequestadmin/approve/endmanager/'+request_admin_no+'/'+user_id+'';
          }
      });
    }
  });
}