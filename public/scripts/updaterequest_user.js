$(document).ready(function(){
    $('#requestusertable').on('click', '.requestuserup', function(){

        const status_request_user = document.getElementById("status_request_user");
        const end_date = document.getElementById("end_date");
        const program_install_date = document.getElementById("program_install_date");
        const time = document.getElementById("time");
        const end_detail = document.getElementById("end_detail");
        const work_detail = document.getElementById("work_detail");
        const yearly_no = document.getElementById("yearly_no");
        const time_type = document.getElementById("time_type");
        const time_type2 = document.getElementById("time_type2");
        const time_type3 = document.getElementById("time_type3");
        const request_user_no = document.getElementById("request_user_no");
        const hd_status_request = document.getElementById("hd_status_request");
        
        var currentRow=$(this).closest("tr");

        var dt_status_request_user = currentRow.find("td:eq(0)").html();
        var dt_end_date = currentRow.find("td:eq(1)").html();
        var dt_program_install_date = currentRow.find("td:eq(2)").html();
        var dt_time = currentRow.find("td:eq(3)").html();
        var dt_end_detail = currentRow.find("td:eq(4)").html();
        var dt_work_detail = currentRow.find("td:eq(5)").html();
        var dt_yearly_no = currentRow.find("td:eq(6)").html();
        var dt_time_type = currentRow.find("td:eq(7)").html();
        var dt_request_user_no = currentRow.find("td:eq(9)").html();

        end_date.value = dt_end_date;  
        program_install_date.value = dt_program_install_date;   
        time.value = dt_time;   
        end_detail.value = dt_end_detail;   
        work_detail.value = dt_work_detail; 
        yearly_no.value = dt_yearly_no;
        request_user_no.value = dt_request_user_no;
        hd_status_request.value = dt_status_request_user;

        if(dt_time_type == 0){
          time_type.checked = true;
        }
        if(dt_time_type == 1){
          time_type2.checked = true;
        }
        if(dt_time_type == 2){
          time_type3.checked = true;
        }

        if(dt_status_request_user <= 2){
          document.getElementById('0').selected = true;

          $('#hidden_finished').hide();
          $('#hidden_working').hide();
        }
        if(dt_status_request_user == 3){
          document.getElementById('3').selected = true;

          $('#hidden_finished').hide();
          $('#hidden_working').show();
  
          status_request_user.value = dt_status_request_user;
          work_detail.required = true;
          end_date.required = false;
          program_install_date.required = false
          time.required = false;
          end_detail.required = false;
        }
        if(dt_status_request_user == 4){
          document.getElementById('4').selected = true;

          $('#hidden_finished').show();
          $('#hidden_working').hide();
  
          status_request_user.value = dt_status_request_user;
          work_detail.required = false;
          end_date.required = true;
          program_install_date.required = true;
          time.required = true;
          end_detail.required = true;
        } 
        
        checkStatus(dt_status_request_user);

    });
});
      

$(".frm").on("click",".updaterequestuser",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
       event.preventDefault()
       event.stopPropagation()
    }
    else{
       Swal.fire({
         title: 'ร้องขอ',
         text: "คุณต้องการร้องขอสิทธิ์ผู้ใช้งานใช่หรือไม่่",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'ใช่',
         cancelButtonText: 'ไม่ใช่'
       }).then((result) => {
         if (result.isConfirmed) {
           Swal.fire(
             'ร้องขอสิืทธิ์ผู้ใช้งานเรียบร้อย',    
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

function checkStatus(){

    const status_request_user = document.getElementById("status_request_user");
    const end_date = document.getElementById("end_date");
    const program_install_date = document.getElementById("program_install_date");
    const time = document.getElementById("time");
    const end_detail = document.getElementById("end_detail");
    const work_detail = document.getElementById("work_detail");
    const hd_status_request = document.getElementById("hd_status_request").value;

    if(status_request_user.value == 0){
        $('#hidden_finished').hide();
        $('#hidden_working').hide();
    }
    if(status_request_user.value == 3){
        if(hd_status_request == 4){
          Swal.fire(
            'Warning!',
            'คุณจบงานไปเรียบร้อยแล้ว',
            'warning'
          )
          status_request_user.value = 4;
          $('#hidden_finished').show();
          $('#hidden_working').hide();
        }
        else{
          $('#hidden_working').show();
          $('#hidden_finished').hide();

          work_detail.required = true;
          end_date.required = false;
          program_install_date.required = false
          time.required = false;
          end_detail.required = false;
        }
    }
    if(status_request_user.value == 4){
        if(hd_status_request == 2){
            Swal.fire(
                'Warning!',
                'กรุณาดำเนินการก่อนที่จะจบงาน',
                'warning'
            )
            status_request_user.value = "";
            $('#hidden_finished').hide();
            $('#hidden_working').hide();
        }
        if(hd_status_request == 3){
            $('#hidden_finished').show();
            $('#hidden_working').hide();

            work_detail.required = false;
            end_date.required = true;
            program_install_date.required = true
            time.required = true;
            end_detail.required = true;
        }
    }
}