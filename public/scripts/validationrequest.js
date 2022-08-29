$(".frm").on("click",".add",function(e){

    var form = $(this).parents('form');
    var req_app_need_date = document.getElementById('req_app_need_date');
    var message_req_app_need_date = document.getElementById('message_req_app_need_date');
    var req_app_subject = document.getElementById('req_app_subject');
    var message_req_app_subject = document.getElementById('message_req_app_subject');
    var req_app_problem = document.getElementById('req_app_problem');
    var message_req_app_problem = document.getElementById('message_req_app_problem');
    var req_app_detail = document.getElementById('req_app_detail');
    var message_req_app_detail = document.getElementById('message_req_app_detail');

    if(validationtext(req_app_need_date, message_req_app_need_date) & validationtext(req_app_subject, message_req_app_subject) &
       validationtext(req_app_problem, message_req_app_problem) & validationtext(req_app_detail, message_req_app_detail)){
        Swal.fire({
            title: 'ส่งคำร้องขอ!',
            text: "คุณต้องการส่งคำร้องใช่หรือไม่่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่',
            cancelButtonText: 'ไม่ใช่'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'ส่งคำร้องขอเรียบร้อย',    
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
});

function validationtext(input, message){
    if(input.value == ''){
        input.classList.add('invalid');
        message.innerHTML = '*กรุณากอรกข้อมูล';
        return false;
    }
    else{
        input.classList.remove('invalid');
        message.innerHTML = '';
        return true;
    }
}