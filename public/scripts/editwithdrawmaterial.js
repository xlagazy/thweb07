$(".frmedt").on("click",".editwithdrawmaterial",function(e){

    var edt_material_no = document.getElementById("edt_material_no").value;
    var edt_withdraw_material_qty = document.getElementById("edt_withdraw_material_qty").value;
    var old_withdraw_material_qty = document.getElementById("old_widthdraw_material_qty").value;
    var error = 0;
    e.preventDefault();
    var form = $(this).parents('form');

    if (form[0].checkValidity() === false) {
      event.preventDefault()
      event.stopPropagation()
    }
    else{

      if(stockmaterial.length == null){
        Swal.fire({
            title: 'Not stock material',
            text: "ไม่มีสต็อค material",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
          }).then((result) => {
        })
        return false;
      }
      if(edt_withdraw_material_qty > old_withdraw_material_qty){
        Swal.fire({
            title: 'Can not input data',
            text: "ไม่สามารถแก้ไขข้อมูลได้มากกว่าจำนวนเดิม",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
          }).then((result) => {
        })
        return false;
      }

      for(let stockmaterials of stockmaterial){
        if(edt_material_no == stockmaterials.material_no){
                error = 0;
                break;
        }
        else{
          error = 2;
        }
      }
        
     if(error == 2){
        Swal.fire({
              title: 'Not stock material',
              text: "ไม่มีสต็อค material",
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'ตกลง'
            }).then((result) => {});
        return false;
      }
      else if(edt_withdraw_material_qty == 0){
        Swal.fire({
          title: 'ลบข้อมูล',
          text: "คุณต้องการลบข้อมูล ใช่หรือไม่่",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ไม่ใช่'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
                'ลบข้อมูล เรียบร้อย',
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
      else{
        Swal.fire({
          title: 'แก้ไขข้อมูล',
          text: "คุณต้องการแก้ไขข้อมูล ใช่หรือไม่่",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'ใช่',
          cancelButtonText: 'ไม่ใช่'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
                'แก้ไขข้อมูล เรียบร้อย',
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

    }
    
    form.addClass('was-validated');
});