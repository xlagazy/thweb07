$(document).ready(function(){

  // code to read selected table row cell data (values).
  $("#withdrawtable").on('click','.editwithdraw',function(){
       // get the current row
       var currentRow=$(this).closest("tr"); 
       
       var material_no = currentRow.find("td:eq(6)").html(); 
       var withdraw_material_no = currentRow.find("td:eq(7)").html(); 
       var withdraw_material_qty = currentRow.find("td:eq(8)").html(); 
       var stock_material_no = currentRow.find("td:eq(9)").html(); 
       var withdraw_material_detail_no = currentRow.find("td:eq(10)").html(); 
       var remark = currentRow.find("td:eq(11)").html(); 
       
       for(let materials of material){
         if(material_no == materials.material_no){
          document.getElementById(materials.material_no).selected = true;
         }
       }

       document.getElementById("edt_withdraw_material_qty").value = withdraw_material_qty;
       document.getElementById("widthdraw_material_no").value = withdraw_material_no;
       document.getElementById("old_widthdraw_material_qty").value = withdraw_material_qty;
       document.getElementById("stock_material_no").value = stock_material_no;
       document.getElementById("withdraw_material_detail_no").value = withdraw_material_detail_no;
       document.getElementById("edt_remark").value = remark;
  });

});