$(".frm").on("click",".withdrawmaterial",function(e){

    var input_material_no = document.getElementById('input_material_no').value;
    var input_withdraw_material_qty = document.getElementById('input_withdraw_material_qty').value;
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
      if(input_withdraw_material_qty == 0){
        Swal.fire({
            title: 'Please input more than 0',
            text: "กรุณาใส่จำนวนในการเบิก",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
          }).then((result) => {
          })
      return false;
      }

      for(let stockmaterials of stockmaterial){
        if(input_material_no == stockmaterials.material_no){
              if(parseInt(input_withdraw_material_qty) > parseInt(stockmaterials.sumstockqty) || parseInt(stockmaterials.sumstockqty) == 0){
                  error = 1;
                  break;
              }
              else{
                error = 0;
                break;
              }
        }
        else{
          error = 2;
        }
      }

      console.log(error);
        
      if(error == 1){
        Swal.fire({
              title: 'Not enough material',
              text: "material ไม่เพียงพอกรุณาสั่งซื้อ material เพิ่ม",
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'ตกลง'
            }).then((result) => {});
        return false;
      }
      else if(error == 2){
        Swal.fire({
              title: 'Not stock material',
              text: "ไม่มีสต็อค material",
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'ตกลง'
            }).then((result) => {});
        return false;
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

    }
    
    form.addClass('was-validated');
});