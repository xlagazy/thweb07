@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    @foreach($equipment as $equipments)
    <div class="ct_listuser">

        <div class="row" >
            <div class="col alert alert-primary" role="alert">
                <b>แก้ไขข้อมูล Equipment number : {{$equipments->equipment_no}}</b>
            </div>
        </div>

        <div class="row border border-secondary rounded">

            <div class="col">

            <form action="{{URL::to('editequipment')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation ">   
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <input type = "hidden" name = "equipment_no" value = "{{$equipments->equipment_no}}" >

                <div class="row">
                    <div class="col">
                        <label><b>Equipment Type</b></label>
                        <select name="equip_type" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($equip_type as $equip_ties)
                            @if($equip_ties->equip_type_id == $equipments->equip_type_id)
                                <option value="{{$equip_ties->equip_type_id}}" selected>{{$equip_ties->equip_type_name}}</option>
                            @else
                                <option value="{{$equip_ties->equip_type_id}}" disabled>{{$equip_ties->equip_type_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <div class="col">
                        <label><b>Equipment name</b></label>
                        <input type="text" class="form-control" name="equipment_name" value="{{$equipments->equipment_name}}" placeholder="Equipment name" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Fix asset</b></label>
                        <input type="text" class="form-control" name="fix_asset" value="{{$equipments->fix_asset}}" placeholder="Fix asset" maxlength="14" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>

                    <div class="col">
                        <label><b>Serial Number</b></label>
                        <input type="text" class="form-control" name="serial_number" value="{{$equipments->serial_number}}" placeholder="Serial Number" maxlength="15" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>O/S</b></label>
                        <select name="os_id" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($os as $osed)
                            @if($osed->os_id == $equipments->os_id)
                                <option value="{{$osed->os_id}}" selected>{{$osed->os_name}}</option>
                            @else 
                                <option value="{{$osed->os_id}}">{{$osed->os_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <div class="col">
                        <label><b>Location</b></label>
                        <input type="text" class="form-control" name="location" value="{{$equipments->location}}" placeholder="Location" maxlength="15" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Computer Type</b></label>
                        <select name="com_id" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($com_type as $com_types)
                            @if($com_types->com_id == $equipments->com_id)
                                <option value="{{$com_types->com_id}}" selected>{{$com_types->com_name}}</option>
                            @else
                                <option value="{{$com_types->com_id}}">{{$com_types->com_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <div class="col">
                        <label><b>Control Person</b></label>
                        <input type="text" class="form-control" name="control_person" value="{{$equipments->control_person}}" placeholder="Control Person" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Person in charge</b></label>
                        <select name="person_in_charge" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($user as $users)
                            @if($users->user_id == $equipments->person_in_charge)
                                <option value="{{$users->user_id}}" selected>{{$users->name}}</option>
                            @else 
                                <option value="{{$users->user_id}}">{{$users->name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                
                    <div class="col">
                        <label><b>Purechase from</b></label>
                        <select name="vendor_id" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($vendor as $vendors)
                            @if($vendors->vendor_id == $equipments->vendor_id)
                                <option value="{{$vendors->vendor_id}}" selected>{{$vendors->vendor_name}}</option>
                            @else
                                <option value="{{$vendors->vendor_id}}">{{$vendors->vendor_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Department</b></label>
                        <select name="dept_id" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($depart as $departs)
                            @if($departs->dept_id == $equipments->dept_id)
                                <option value="{{$departs->dept_id}}" selected>{{$departs->dept_name}}</option>
                            @else
                                <option value="{{$departs->dept_id}}">{{$departs->dept_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <div class="col">
                        <label><b>Section</b></label>
                        <select name="sect_id" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                        @foreach($section as $sections)
                            @if($sections->sect_id == $equipments->sect_id)
                                <option value="{{$sections->sect_id}}" selected>{{$sections->sect_name}}</option>
                            @else
                                <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                            @endif
                        @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Tel</b></label>
                        <input type="tel" class="form-control" name="tel_no" value="{{$equipments->tel_no}}" placeholder="Tel" maxlength="4" required>
                        <div class="invalid-feedback">Please input data</div>
                    </div>

                    <div class="col">
                        <label><b>Status</b></label>
                        <select name="equipment_status" id="equipment_status" class="form-control" required>
                            <option disabled selected value>Choose...</option>
                            @if($equipments->equipment_status == "Using")
                                <option value="Using" selected>Using</option>
                            @else
                                <option value="Using">Using</option>
                            @endif
                            @if($equipments->equipment_status == "Broken")
                                <option value="Broken" selected>Broken</option>
                            @else
                                <option value="Broken">Broken</option>
                            @endif
                            @if($equipments->equipment_status == "Write off")
                                <option value="Write off" selected>Write off</option>
                            @else
                                <option value="Write off">Write off</option>
                            @endif
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>

                    <script>
                        $(document).ready(function(){
                            var equipment_status = $('#equipment_status').val();
                            hide_show(equipment_status);
                            
                            $("#equipment_status").change(function() {
                                    var val = $(this).val();
                                    hide_show(val);
                            });
                        });

                        function hide_show(equipment_status){
                            if (equipment_status == "Write off") {
                                $("#hidden_div2").show();
                                $("#hidden_div").hide();
                            }
                            else if(equipment_status == "Broken"){
                                $("#hidden_div").show();
                                $("#hidden_div2").hide();
                            } 
                            else{
                                $("#hidden_div").hide();
                                $("#hidden_div2").hide();
                            }    
                        }
                    </script>

                </div>

                <div class="row">
                    <div class="col">
                    </div>

                    <div class="col">
                        <!-- Has check script on showdiv.js -->
                        <div id="hidden_div" style="display:none;">
                            <!-- cause broken -->
                            <label style="color:red;"><b>Cause Broken</b></label>
                            <input type="" class="form-control" name="cause_broken" id="cause_broken" value="{{$equipments->cause_broken}}" placeholder="Cause Broken">
                            <div class="invalid-feedback">Please input data</div>                     
                        </div>

                        <div id="hidden_div2">
                            <!-- write off date -->
                            <label style="color:red;"><b>Write off date</b></label>
                            <input type="date" name="write_off_date" id="write_off_date" value="{{$equipments->write_off_date}}"  class="form-control" />
                            <div class="invalid-feedback">Please choose date</div>
                        </div>

                        <script>
                            document.getElementById('equipment_status').addEventListener('change', function () {
                                if(this.value == 'Broken'){
                                    document.getElementById('cause_broken').required = true;
                                }
                                if(this.value == 'Write off'){
                                    document.getElementById('write_off_date').required = true;
                                }
                            });
                        </script>  
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Setup Date</b></label>
                        <input type="date" name="setup_date" value="{{$equipments->setup_date}}"  class="form-control" required />
                        <div class="invalid-feedback">Please choose date</div>
                    </div>

                    <div class="col">
                        <label><b>Warranty</b></label>
                        <select name="warranty" class="form-control" required>
                        <option disabled selected value>Choose...</option>
                            @for($i = 0; $i<=10; $i++)
                                @if($i == $equipments->warranty)
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif
                            @endfor
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Spec</b></label>
                        <textarea class="form-control" name="spec" rows="3" required>{{$equipments->spec}}</textarea>
                        <div class="invalid-feedback">Please input data</div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label><b>Remark</b></label>
                        <textarea class="form-control" name="remark" rows="3">{{$equipments->remark}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label><b>Image Profile</b></label>
                    <div style="text-align:center; margin-bottom:1%; ">
                        <img src="/images/equipment/{{$equipments->image}}" id="imgpf" style="widht:150px;;height:200px;">
                    </div>
                    <input type="file" class="form-control" name="file"
                    onchange="imgpf.src=window.URL.createObjectURL(this.files[0]) " accept="image/*" />
                    <input type="hidden" name="file_name" value="{{$equipments->image}}" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.history.go(-1); return false;">ยกเลิก</button>
                    <button type="button" name="btn1" class="btn btn-success edt">บันทึก</button>
                </div>

            </form>
            </div>
        </div>

    </div>
    @endforeach

    <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>

@endsection