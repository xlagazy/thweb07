@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @foreach($borrow as $borrows)
    <div class="ct_listuser">

        <div class="row" >
            <div class="col alert alert-primary" role="alert">
                <b>แก้ไขข้อมูล Equipment number : {{$borrows->equipment_no}}</b>
            </div>
        </div>

        <div class="row border border-secondary rounded">
            <div class="col">
                <form action="{{URL::to('editborrow')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                    <input type = "hidden" id="borrow_no" name = "borrow_no" value = "{{$borrows->borrow_no}}" >
                    
                    <div class="row">
                        <div class="col">
                            <label><b>Equipment Number</b></label>
                            <input type="text" class="form-control" id="equipment_no" name="equipment_no" placeholder="Equipment number" value="{{$borrows->equipment_no}}" readonly="readonly">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label><b>User Borrow</b></label>
                            <input type="text" class="form-control" id="user_borrow" name="user_borrow" placeholder="User Borrow" value="{{$borrows->user_borrow}}" required>
                            <div class="invalid-feedback">Please input data</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label><b>Section</b></label>
                            <select name="sect_id" id="sect_id" class="form-control" required>
                            <option disabled selected value>Choose...</option>
                            @foreach($section as $sections)
                                @if($sections->sect_id == $borrows->sect_id)
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
                            <label><b>Start Date</b></label>
                            <input type="date" name="start_date" id="start_date"  class="form-control" value="{{$borrows->start_date}}" required />
                            <div class="invalid-feedback">Please choose date</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label><b>End Date</b></label>
                            <input type="date" name="end_date" id="end_date"   class="form-control" value="{{$borrows->end_date}}" required />
                            <div class="invalid-feedback">Please choose date</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label><b>Status</b></label>
                            <select name="status" id="status" class="form-control" required>
                            <option disabled selected value>Choose...</option>
                                @if($borrows->borrow_status == 1)
                                    <option value="1" selected>Restored</option>
                                @else
                                    <option value="1" >Restored</option>
                                @endif

                                @if($borrows->borrow_status == 2)
                                    <option value="2" selected>Borrow</option>
                                @else
                                    <option value="2" >Borrow</option>
                                @endif
                            </select>
                            <div class="invalid-feedback">Please choose data</div>
                        </div>
                    </div>

                    <label><b>Signature</b></label>
                        <div class="panel-body center-text">

                        <div id="signArea" >
                            <h2 class="tag-ingo">Put signature below,</h2>
                            <div class="sig sigWrapper" style="height:auto;">
                                <div class="typed"></div>
                                <canvas class="sign-pad noti-sign-size" id="sign-pad" ></canvas>
                            </div>
                        </div>

                        <button id="clear" class="btn btn-danger">Clear Signature</button>
                    </div>      

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="window.history.go(-1); return false;" data-dismiss="modal">ยกเลิก</button>
                        <button type="button" name="btn" class="btn btn-success edt">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    @endforeach

    <script type="text/javascript" src="{{asset('scripts/editborrow.js')}}"></script>
	
@endsection