@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">
        <form action="{{URL::to('edituser')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
            <input type = "hidden" name = "user_id" value = "{{$members[0]->user_id}}" >

            <div class="form-group">
                <label><b>Employees number</b></label>
                <input type="text" class="form-control" name="employees_no" placeholder="Employees number" value="{{$members[0]->employees_no}}" required>
                <div class="invalid-feedback">Please input data</div>
            </div>

            <div class="form-group">
                <label><b>Password</b></label>
                <input type="password" class="form-control" name="password" placeholder="Password" value="{{$members[0]->password}}" required>
                <div class="invalid-feedback">Please input data</div>
            </div>

            <div class="form-group">
                <label><b>Name</b></label>
                <input type="text" class="form-control" name="fname" placeholder="Name" value="{{$members[0]->name}}" required>
                <div class="invalid-feedback">Please input data</div>
                </div>

                <div class="form-group">
                <label><b>Section</b></label>
                <select name="section" class="form-control" required>
                <option disabled selected value>Choose...</option>
                @foreach($section as $sections)
                    @if($members[0]->section == $sections->sect_id)
                        <option value="{{$sections->sect_id}}" selected>{{$sections->sect_name}}</option>
                    @else
                        <option value="{{$sections->sect_id}}">{{$sections->sect_name}}</option>
                    @endif
                @endforeach
                </select>
                <div class="invalid-feedback">Please choose data</div>
            </div>

            <div class="form-group">
                <label><b>Sub</b></label>
                <select name="sub" class="form-control" required>
                <option disabled selected value>Choose...</option>
                @foreach($sub as $subs)
                    @if($members[0]->sub == $subs->sub_it_id)
                        <option value="{{$subs->sub_it_id}}" selected>{{$subs->sub_it_name}}</option>
                    @else
                        <option value="{{$subs->sub_it_id}}">{{$subs->sub_it_name}}</option>
                    @endif
                @endforeach
                </select>
                <div class="invalid-feedback">Please choose data</div>
            </div>

            <div class="form-group">
                <label><b>Position</b></label>
                <select name="position" class="form-control" required>
                <option disabled selected value>Choose...</option>
                @foreach($position as $positions)
                    @if($members[0]->position == $positions->position_id)
                        <option value="{{$positions->position_id}}" selected>{{$positions->position_name}}</option>
                    @else
                        <option value="{{$positions->position_id}}">{{$positions->position_name}}</option>
                    @endif
                @endforeach
                </select>
                <div class="invalid-feedback">Please choose data</div>
            </div>

            <div class="form-group">
                <label><b>Tel</b></label>
                <input type="text" class="form-control" name="tel" placeholder="Tel" value="{{$members[0]->tel}}" required>
                <div class="invalid-feedback">Please input data</div>
            </div>

            <div class="form-group">
                <label><b>Status user</b></label>
                <select name="status_user" class="form-control" required>
                    <option disabled selected value>Choose...</option>
                    @if($members[0]->status_user == 1)
                        <option value="1" selected>Resign</option>
                    @else
                        <option value="1">Resign</option>
                    @endif

                    @if($members[0]->status_user == 2)
                        <option value="2" selected>Work</option>
                    @else
                        <option value="2">Work</option>
                    @endif
                </select>
                <div class="invalid-feedback">Please choose data</div>
            </div>

            
            <div class="form-group">
                <label><b>Type user</b></label>
                <select name="type_user" class="form-control" required>
                    <option disabled selected value>Choose...</option>

                    @if($members[0]->type_user == 1)
                        <option value="1" selected>Admin</option>
                    @else
                        <option value="1">Admin</option>
                    @endif

                    @if($members[0]->status_user == 2)
                        <option value="2" selected>Member</option>
                    @else
                        <option value="2">Member</option>
                    @endif
                </select>
                <div class="invalid-feedback">Please choose data</div>
            </div>

            <div class="form-group">
                <label><b>Image Profile</b></label>
                <div style="text-align:center; margin-bottom:1%; ">
                    <img src="/images/{{$members[0]->image}}" id="imgpf" style="widht:150px;;height:200px;">
                </div>
                <input type="file" class="form-control" name="file"
                onchange="imgpf.src=window.URL.createObjectURL(this.files[0]) " />
                <input type="hidden" name="file_name" value="{{$members[0]->image}}" />
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.history.go(-1); return false;">ยกเลิก</button>
                <button type="button" name="btn1" class="btn btn-success edt">บันทึก</button>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>

@endsection