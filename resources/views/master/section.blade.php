@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <!-- Button trigger modal -->

        <div class="input-group rounded" >
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmodal" style="margin-bottom:2%">
                เพิ่ม Section      
            </button>
            <input type="search"class="form-control rounded" placeholder="Search" id="myInput" style="margin:0 60% 0 1%;" />
        </div>

        <!-- table list eqmuipment -->
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Section Name</th>
                    <th scope="col">Department</th>
                    <th scope="col" >Edit</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody id="myTable">

            @php 
                $no = 1;
            @endphp

            @foreach($section as $sections)
                <tr>
                    <td scope="row" >{{$no}}</td>
                    <td scope="row" >{{$sections->sect_name}}</td>
                    <td scope="row" >{{$sections->dept_name}}</td>
                    <td>
                        <a href="" data-toggle="modal" data-target="#edtmodal{{$sections->sect_id}}">
                        <i class="bi bi-pencil-square"></i>
                        Edit</a>

                        <!-- Modal edit -->
                        <div class="modal fade" id="edtmodal{{$sections->sect_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header" style="color:#000;">
                                        <h5 class="modal-title" id="exampleModalLongTitle">แก้ไข Section</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="color:#000;">
                                        <form action="{{URL::to('editsection')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">   
                                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                                            <input type = "hidden" name = "vendor_id" value = "{{$sections->sect_id}}" >

                                            <div class="row">
                                                <div class="col">
                                                    <label><b>Section name</b></label>
                                                    <input type="text" class="form-control" name="sect_name" placeholder="Sect name" value="{{$sections->sect_name}}" required>
                                                    <div class="invalid-feedback">Please input data</div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <label><b>Department</b></label>
                                                    <select class="form-control" name="dept_id">
                                                        <option selected value="" disabled>Choose...</option>
                                                        @foreach($department as $departments)
                                                            @if($sections->dept_id == $departments->dept_id)
                                                                <option value="{{$departments->dept_id}}" selected>{{$departments->dept_name}}</option>
                                                            @else
                                                                <option value="{{$departments->dept_id}}">{{$departments->dept_name}}</option>
                                                            @endif
                                                        @endforeach 
                                                    </select>
                                                    <div class="invalid-feedback">Please input data</div>
                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                                <button type="button" name="btn2" class="btn btn-success edt">บันทึก</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <a href="deletesection/{{$sections->sect_id}}" class="dlt_user" style="color:red;">
                        <i class="bi bi-trash"></i>
                        Delete</a>
                    </td>
                </tr>

                @php
                    $no++;
                @endphp

            @endforeach
            </tbody>

        </table>

        <!-- Modal add -->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">เพิ่ม Section</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{URL::to('addsection')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">   
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >

                        <div class="row">
                            <div class="col">
                                <label><b>Section name</b></label>
                                <input type="text" class="form-control" name="sect_name" placeholder="Section name" required>
                                <div class="invalid-feedback">Please input data</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label><b>Department</b></label>
                                <select class="form-control" name="dept_id">
                                    <option selected value="" disabled>Choose...</option>
                                    @foreach($department as $departments)
                                        <option value="{{$departments->dept_id}}">{{$departments->dept_name}}</option>
                                    @endforeach 
                                </select>
                                <div class="invalid-feedback">Please input data</div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                            <button type="button" name="btn2" class="btn btn-success add_user">เพิ่ม</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
        <script type="text/javascript" src="{{asset('searchequipment.js')}}"></script>

    </div>

@endsection