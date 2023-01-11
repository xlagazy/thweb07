<!-- Modal add -->
<style>
#hidden_div_input {
  display: none;
}
#hidden_div2_input {
  display: none;
}
</style>
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
         <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">เพิ่ม Others Equipment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{URL::to('addotherequipment')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">   
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

               <div class="row">
                  <div class="col">
                     <label><b>Equipment Type</b></label>
                     <select name="equip_type" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($other_equip_type as $equip_ties)
                           <option value="{{$equip_ties->ot_equip_type_id}}">{{$equip_ties->ot_equip_type_name}}</option>
                        @endforeach
                     </select>
                     <div class="invalid-feedback">Please choose data</div>
                  </div>

                  <div class="col">
                        <label><b>Equipment name</b></label>
                        <input type="text" class="form-control" name="equipment_name" placeholder="Equipment name" required>
                        <div class="invalid-feedback">Please input data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                        <label><b>Fix asset</b></label>
                        <input type="text" class="form-control" name="fix_asset" placeholder="Fix asset" maxlength="15" required>
                        <div class="invalid-feedback">Please input data</div>
                  </div>

                  <div class="col">
                        <label><b>Serial Number</b></label>
                        <input type="text" class="form-control" name="serial_number" placeholder="Serial Number" maxlength="15" required>
                        <div class="invalid-feedback">Please input data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                        <label><b>O/S</b></label>
                        <select name="os_id" class="form-control" required>
                           <option disabled selected value>Choose...</option>
                           @foreach($os as $osed)
                              <option value="{{$osed->os_id}}">{{$osed->os_name}}</option>
                           @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                  </div>

                  <div class="col">
                        <label><b>Location</b></label>
                        <select name="location" class="form-control border rounded selectpicker" data-live-search="true" required>
                            <option disabled selected value>Choose...</option>
                            @foreach($location as $locations)
                                <option value="{{$locations->locat_id}}">{{$locations->locat_name}}</option>
                            @endforeach
                        </select> 
                        <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                     <label><b>Control Person</b></label>
                     <input type="text" class="form-control" name="control_person" placeholder="Control Person" required>
                     <div class="invalid-feedback">Please input data</div>
                  </div>

                  <div class="col">
                     <label><b>Section</b></label>
                     <select name="sect_id" class="form-control border rounded selectpicker" data-live-search="true" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($section as $sections)
                           <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                        @endforeach
                     </select>
                     <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                     <label><b>Person in charge</b></label>
                     <select name="person_in_charge" class="form-control" required>
                     <option disabled selected value>Choose...</option>
                     @foreach($user as $users)
                        <option value="{{$users->user_id}}">{{$users->name}}</option>
                     @endforeach
                     </select>
                     <div class="invalid-feedback">Please choose data</div>
                  </div>
                  
                  <div class="col">
                     <label><b>Purechase from</b></label>
                     <select name="vendor_id" class="form-control" required>
                     <option disabled selected value>Choose...</option>
                     @foreach($vendor as $vendors)
                        <option value="{{$vendors->vendor_id}}">{{$vendors->vendor_name}}</option>
                     @endforeach
                     </select>
                     <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                     <label><b>Tel</b></label>
                     <input type="number" class="form-control" name="tel_no" placeholder="Tel" maxlength="4" required>
                     <div class="invalid-feedback">Please input data</div>
                  </div>

                  <div class="col">
                     <label><b>Status</b></label>
                     <select name="equipment_status_input" id="equipment_status" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        <option value="Using">Using</option>
                        <option value="Broken">Broken</option>
                        <option value="Write off">Write off</option>
                     </select>
                     <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="row">
                    <div class="col">
                    </div>

                    <div class="col">
                        <!-- Has check script on showdiv.js -->
                        <div id="hidden_div">
                            <!-- cause broken -->
                            <label style="color:red;"><b>Cause Broken</b></label>
                            <input type="" class="form-control" name="cause_broken" id="cause_broken" value="" placeholder="Cause Broken" maxlength="4">
                            <div class="invalid-feedback">Please input data</div>                     
                        </div>

                        <div id="hidden_div2">
                            <!-- write off date -->
                            <label style="color:red;"><b>Write off date</b></label>
                            <input type="date" name="write_off_date" id="write_off_date" value=""  class="form-control" />
                            <div class="invalid-feedback">Please choose date</div>
                        </div>
                    </div>
               </div>

               <div class="row">
                  <div class="col">
                     <label><b>Setup Date</b></label>
                     <input type="date" name="setup_date"  class="form-control" required />
                     <div class="invalid-feedback">Please choose date</div>
                  </div>

                  <div class="col">
                     <label><b>Warranty</b></label>
                     <select name="warranty" class="form-control" required>
                     <option disabled selected value>Choose...</option>
                     @for($i = 0; $i<=10; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                     @endfor
                     </select>
                     <div class="invalid-feedback">Please choose data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                     <label><b>Spec</b></label>
                     <textarea class="form-control" name="spec" rows="3" required></textarea>
                     <div class="invalid-feedback">Please input data</div>
                  </div>
               </div>

               <div class="row">
                  <div class="col">
                     <label><b>Remark</b></label>
                     <textarea class="form-control" name="remark" rows="3"></textarea>
                  </div>
               </div>

               <div class="form-group">
                        <label><b>Image Profile</b></label>
                        <div style="text-align:center; margin-bottom:1%; ">
                           <img src="" id="imgpf" style="widht:150px;;height:200px;">
                        </div>
                        <input type="file" class="form-control" name="file"
                        onchange="imgpf.src=window.URL.createObjectURL(this.files[0]) " accept="image/*" capture="camera"/>
               </div>
               
               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                     <button type="button" name="btn2" class="btn btn-success add_user">เพิ่ม</button>
               </div>

            </form>
         </div>
   </div>
</div>

