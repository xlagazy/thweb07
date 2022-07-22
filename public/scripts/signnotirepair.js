$(document).ready(function(e){
  sigApi = $('#signArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:150, validateFields : false});
});

$('#clear').click(function (e){
  e.preventDefault();

  $('#signArea').signaturePad().clearCanvas ();
});

$(".frmedt").on("click",".edt",function(e){
    e.preventDefault();
    var form = $(this).parents('form');

    let noti_repair_no = $('#noti_repair_no').val();
    
    if (form[0].checkValidity() === false) {
       event.preventDefault();
       event.stopPropagation();       
    }
    else{
      if(sigApi.validateForm() == false){
        return false;
      }else {
            Swal.fire({
              title: 'บันทึก',
              text: "คุณต้องการบันทึก ใช่หรือไม่่",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'ใช่',
              cancelButtonText: 'ไม่ใช่'
            }).then((result) => {
              if (result.isConfirmed) {
                  Swal.fire(
                      'บันทึกเรียบร้อย',
                      '',
                    'success'
                  ).then((result)=> {
                      if(result.isConfirmed){
                        html2canvas([document.getElementById('sign-pad')], {
                          onrendered: function (canvas) {
                            var canvas_img_data = canvas.toDataURL('image/png');
                            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
        
                            //ajax call to save image inside folder
                            $.ajaxSetup({
                              headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              }
                            });
        
                            $.ajax({
                                method: 'POST',
                                url : '/updatesignature',
                                data : {noti_repair_no : noti_repair_no,
                                        img_data : img_data},
                                dataType: 'json',
                                success : function() {
                                  window.history.go(-1); 
                                  return false;
                                },
                                error : function(request, status, error) {
                                    console.log(status, error);
                                }
                            }); 
                          } 
                        });
                      }
                  });
              }
            });
          
      }
    }
     
     form.addClass('was-validated');
});