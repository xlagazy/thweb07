@extends('request_system.master_request')
@section('contents')
    @php 
        $signature = App\Http\Controllers\RequestController::imgSignature();
    @endphp
    <div style="margin-bottom:2%;">
        @if(empty(Cookie::get('name')))
            <button class="btnmenu" onclick="login()" >
                <i class="fa fa-plus" aria-hidden="true"></i> Request User
            </button>
            @if(Cookie::get('position') != "")
                <button class="btnmenu" onclick="login()" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Section Approve
                </button>
            @endif
        @elseif(empty($signature[0]->signature))
            <button class="btnmenu" onclick="notsignature()" >
                <i class="fa fa-plus" aria-hidden="true"></i> Request User
            </button>
            @if(Cookie::get('position') != "")
                <button class="btnmenu" onclick="notsignature()" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Section Approve
                </button>   
            @endif
        @else
            <button class="btnmenu" onclick="location.href='/showaddrequestuser'" >
                <i class="fa fa-plus" aria-hidden="true"></i> Request User
            </button>
            @if(Cookie::get('position') != "")
                <button class="btnmenu" onclick="location.href='/listrequestuser/approve/section'" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Section Approve
                </button>
            @endif
            @if(strpos(Cookie::get('position'), 'Mgr') !== false)
                <button class="btnmenu" onclick="location.href='/listrequestuser/approve/relatesect'" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                    Relate Approve
                </button>
            @endif
        @endif
    </div>

    <h2>Request User</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-sm"> 

            @if(count($request_user) == 0)
                <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
            <thead>
                <form action="{{URL::to('listrequestuser/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                    <tr>
                        <th scope="col" class="align-top text-center" width="5%">No</th>
                        <th scope="col" class="align-top" width="15%">Track Number</th>
                        <th class="align-top text-center" scope="col" width="30%">Name / Surname</th>
                        <th class="align-top text-center" scope="col" width="5%">Section</th>
                        <th class="align-top text-center" scope="col" width="20%">Subject</th>
                        <th class="align-top text-center" scope="col" width="10%">Detail</th>
                        <th class="align-top text-center" scope="col" width="20%">Status</th>
                        <th class="align-top text-center" scope="col" width="20%">Final Confirm</th>
                        <th class="align-top text-center" scope="col" width="20%">Edit</th>
                        <th class="align-top text-center" scope="col" width="20%">Delete</th>
                    </tr>
                    <tr style="border-top: hidden;">
                        <th></th>
                        <th class="text-center">
                            <input type="text" name="search_track_no" id="search_track_no" value="{{$search_track_no}}" size="12" placeholder="Search">
                        </th>
                        <th></th>
                        <th></th>
                        <th class="text-center">
                            <select name="search_subject" style="height:30px;" onchange="this.form.submit()">
                                <option  selected value="">Subject...</option>
                                @if($search_subject == 0)
                                    <option value="0" selected>Add</option>
                                @else
                                    <option value="0">Add</option>
                                @endif
                                @if($search_subject == 1)
                                    <option value="1" selected>Delete</option>
                                @else
                                    <option value="1">Delete</option>
                                @endif
                                @if($search_subject == 2)
                                    <option value="2" selected>Change</option>
                                @else
                                    <option value="2">Change</option>
                                @endif
                            </select>
                        </th>
                        <th></th>
                        <th>
                            <select name="search_status" style="height:30px;" onchange="this.form.submit()">
                                <option  selected value="">Status...</option>
                                @if($search_status == 0)
                                    <option value="0" selected>รออนุมัติจากแผนกต้นสังกัด</option>
                                @else
                                    <option value="0">รออนุมัติจากแผนกต้นสังกัด</option>
                                @endif
                                @if($search_status == 1)
                                    <option value="1" selected>รออนุมัติจากแผนกที่เกี่ยวข้อง</option>
                                @else
                                    <option value="1">รออนุมัติจากแผนกที่เกี่ยวข้อง</option>
                                @endif
                                @if($search_status == 2)
                                    <option value="2" selected>รอรับงาน</option>
                                @else
                                    <option value="2">รอรับงาน</option>
                                @endif
                                @if($search_status == 3)
                                    <option value="3" selected>รับงานเรียบร้อย</option>
                                @else
                                    <option value="3">รับงานเรียบร้อย</option>
                                @endif
                                @if($search_status == 4)
                                    <option value="4" selected>กำลังดำเนินการ</option>
                                @else
                                    <option value="4">กำลังดำเนินการ</option>
                                @endif
                                @if($search_status == 5)
                                    <option value="5" selected>ดำเนินการแล้ว</option>
                                @else
                                    <option value="5">ดำเนินการแล้ว</option>
                                @endif
                                @if($search_status == 6)
                                    <option value="6" selected>ดำเนินการแล้ว</option>
                                @else
                                    <option value="6">ดำเนินการแล้ว</option>
                                @endif
                                @if($search_status == 7)
                                    <option value="7" selected>จบงานเรียบร้อย</option>
                                @else
                                    <option value="7">จบงานเรียบร้อย</option>
                                @endif
                                @if($search_status == 8)
                                    <option value="8" selected>ปฏิเสธรับงาน</option>
                                @else
                                    <option value="8">ปฏิเสธรับงาน</option>
                                @endif
                            </select>
                        </th>
                        <th></th>
                    </tr>
                </form>
            </thead>

            <tbody id="myTable">
                
                @foreach($request_user as $key => $data)
                <tr>
                    <td class="text-center">{{$request_user->firstItem() + $key}}</td>
                    <td>{{$data->track}}</td>
                    <td>
                        @php
                            $arrPrefix = json_decode($data->prefix);
                            $arrName = json_decode($data->name_user);
                            $arrSurName = json_decode($data->surname_user);
                            $count = count($arrName);
                        @endphp

                        @for($i=0;$i<$count;$i++)
                            {{App\Http\Controllers\RequestUserController::getPrefix($arrPrefix[$i])}}{{$arrName[$i]}} {{$arrSurName[$i]}}
                        @endfor
                    </td>
                    <td class="text-center">
                        {{$data->sect_name}}
                    </td>
                    <td class="text-center">
                        {{App\Http\Controllers\RequestUserController::subjectRequestUser($data->subject)}}
                    </td>
                    <td class="text-center">
                        <a href="" data-toggle="modal" data-target="#requestuserdt{{$data->no}}">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            Detail
                        </a>
                        @include('request_system.request_user.modal_detail_requestuser')
                    </td>
                    <td class="text-center">
                        {{App\Http\Controllers\RequestUserController::statusRequestUser($data->status_request_user)}}
                    </td>
                    <td class="text-center">
                        {{App\Http\Controllers\RequestUserController::confirmRequestUser($data->no, Cookie::get('employee_no'))}}
                    </td>
                    <td class="text-center">
                        @if($data->status_request_user <= 2)
                            <a href="/editrequestuser/{{$data->no}}" class="text-primary requestuseredt">Edit</a>
                        @else
                            <label class="text-secondary">Edit</label>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($data->status_request_user <= 2)
                            <a href="/deleterequestuser/{{$data->no}}" class="text-danger dlt_user">Delete</a>
                        @else
                            <label class="text-secondary">Delete</label>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        Total Result {{ $request_user->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_user->withQueryString()->links('pagination') }}
        </div>
        
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>

    </div>
@endsection