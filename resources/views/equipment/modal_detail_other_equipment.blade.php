<div class="modal fade" id="equipotherdetail{{$equipments->ot_equipment_no}}" tabindex="-1" role="dialog" 
               aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Equipment : {{$equipments->ot_equipment_no}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <div style="text-align:center; margin-bottom:1%; ">
                        @if(!empty($equipments->image))
                        <a href="/images/equipment/{{$equipments->image}}" target="_blank">
                            <img src="/images/equipment/{{$equipments->image}}" style="widht:200px;height:300px;">
                        </a>
                        @else
                            <img src="/images/icons/noimage.png" style="widht:200px;height:300px;">
                        @endif
                    </div>
                </div>

                <div class="container border border-dark">

                    <!-- row 1 -->
                    <div class="row">
                        <div class="col-50p">
                            <label><b>Equipment Name</b></label>
                        </div>

                        <div class="col-50p">
                            <label><b>Equipment Type</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-50p">
                            <p>{{$equipments->ot_equip_type_name}}</p>
                        </div>

                        <div class="col-50p">
                            <p>{{$equipments->ot_equipment_name}}</p>
                        </div>
                    </div>

                    <!-- row 2 -->
                    <div class="row">
                        <div class="col-50p">
                            <label><b>Fix asset</b></label>
                        </div>

                        <div class="col-50p">
                            <label><b>Serial Number</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-50p">
                            <p>{{$equipments->fix_asset}}</p>
                        </div>

                        <div class="col-50p">
                            <p>{{$equipments->serial_number}}</p>
                        </div>
                    </div>

                    <!-- row 3 -->
                    <div class="row">
                        <div class="col-50p">
                            <label><b>O/S</b></label>
                        </div>

                        <div class="col-50p">
                            <label><b>Location</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-50p">
                            <p>{{$equipments->os_name}}</p>
                        </div>

                        <div class="col-50p">
                            <p>{{$equipments->locat_name}}</p>
                        </div>
                    </div>

                    <!-- row 4 -->
                    <div class="row">
                        <div class="col-100p">
                            <label><b>Control Person</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-100p">
                            <p>{{$equipments->control_person}}</p>
                        </div>
                    </div>

                    <!-- row 5 -->
                    <div class="row">
                        <div class="col-50p">
                            <label><b>Person in charge</b></label>
                        </div>
                        
                        <div class="col-50p">
                            <label><b>Purechase from</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-50p">
                            <p>{{$equipments->name}}</p>
                        </div>
                        
                        <div class="col-50p">
                            <p>{{$equipments->vendor_name}}</p>
                        </div>
                    </div>

                    <!-- row 6 -->
                    <div class="row">
                        <div class="col-50p">
                            <label><b>Department</b></label>
                        </div>

                        <div class="col-50p">
                            <label><b>Section</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-50p">
                            <p>{{$equipments->dept_name}}</p>
                        </div>

                        <div class="col-50p">
                            <p>{{$equipments->sect_name}}
                        </div>
                    </div>

                    <!-- row 7 -->
                    <div class="row">
                        <div class="col-50p">
                            <label><b>Tel</b></label>
                        </div>

                        <div class="col-50p">
                            <label><b>Status</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-50p">
                            <p>{{$equipments->tel_no}}</p>
                        </div>

                        <div class="col-50p">
                            @if($equipments->equipment_status == "Using")
                                <p>Using</p>
                            @elseif($equipments->equipment_status == "Broken")
                                <p>Broken</p>
                            @else
                                <p>Write off</p>
                            @endif

                            @if($equipments->cause_broken != "")
                                <b style="color:red;">Cause broken</b>
                                <p>{{$equipments->cause_broken}}</p>
                            @endif
                            @if($equipments->write_off_date != "")
                                <b style="color:red;">Write off date</b>
                                <p>{{date("d-M-Y", strtotime($equipments->write_off_date))}}</p>
                            @endif
                        </div>
                    </div>

                    <!-- row 8 -->
                    <div class="row">
                        <div class="col-50p">
                            <label><b>Setup Date</b></label>
                        </div>

                        <div class="col-50p">
                            <label><b>Warranty</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-50p">
                            <p>{{date("d-M-Y", strtotime($equipments->setup_date))}}</p>
                        </div>

                        <div class="col-50p">
                            <p>{{$equipments->warranty}} Years</p>
                        </div>
                    </div>

                    <!-- row 9 -->
                    <div class="row">
                        <div class="col-100p">
                            <label><b>Spec</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-100p">
                            <p>{{$equipments->spec}}</p>
                        </div>
                    </div>

                    <!-- row 10 -->
                    <div class="row">
                        <div class="col-100p">
                            <label><b>Remark</b></label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-100p">
                            @if(empty($equipments->remark))
                                <p>-</p>
                            @else
                                <p>{{$equipments->remark}}
                            @endif
                        </div>
                    </div>

                </div>

            </div>
    </div>
</div>