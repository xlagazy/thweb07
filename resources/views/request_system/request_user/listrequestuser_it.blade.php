@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Request Users</h1>
        </div>

        <div class="d-flex flex-row" style="margin-bottom:1%;">

            <div style="margin-bottom:2%;">
                <button class="btn btn-success mb-2" onclick="location.href='/listrequestuser/receieved'" >
                    <i class="fa fa-file-text-o" aria-hidden="true"></i> งานที่รับแล้ว
                </button>
                <button class="btn btn-primary mb-2" onclick="location.href='/listrequestuser/approve'" >
                    <i class="fa fa-calendar-check-o"></i> Approve
                </button>
            </div>


            <!-- <a href="" style="margin-left:auto" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>-->

        </div>

         <!-- Modal Export Excel -->

        <!-- table list request user -->
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                @if(count($request_user) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <form action="{{URL::to('/listrequestuser/it/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Request No.</th>
                            <th scope="col" class="text-center">Track Number</th>
                            <th scope="col" class="text-center">Name / Surname</th>
                            <th scope="col" class="text-center">Section</th>
                            <th scope="col" class="text-center">Subject</th>
                            <th scope="col" class="text-center">Effective date</th>
                            <th scope="col" class="text-center">Detail</th>
                            <th scope="col" class="text-center">Charge</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Receive</th>
                            <th scope="col" class="text-center">PDF</th>
                        </tr>
                        <tr style="border-top: hidden;">
                            <th></th>
                            <th>
                                <input type="text" name="search_request_no" id="search_request_no" value="{{$search_request_no}}" size="5" placeholder="Search" onchange="this.form.submit()">
                            </th>
                            <th>
                                <input type="text" name="search_track_no" id="search_track_no" value="{{$search_track_no}}" size="5" placeholder="Search" onchange="this.form.submit()">
                            </th>
                            <th></th>
                            <th>
                                <select name="search_section" style="height:30px;width:80px;" onchange="this.form.submit()">
                                    <option selected value="">Section...</option>
                                    @foreach($section as $sections)
                                        @if($search_section == $sections->sect_name)
                                            <option value="{{$sections->sect_name}}" selected>{{$sections->sect_name}}</option>
                                        @else
                                            <option value="{{$sections->sect_name}}">{{$sections->sect_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </th>
                            <th>
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
                            <th>
                                <input type="date" name="search_date" value="{{$search_date}}" onchange="this.form.submit()">
                            </th>
                            <th></th>
                            <th>
                                <select name="search_charge" style="height:30px;width:80px;" onchange="this.form.submit()">
                                    <option selected value="">Charge...</option>
                                    @foreach($member as $members)
                                        @if($search_charge == $members->user_id)
                                            <option value="{{$members->user_id}}" selected>{{$members->name}}</option>
                                        @else
                                            <option value="{{$members->user_id}}">{{$members->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </th>
                            <th>
                                <select name="search_status" style="height:30px;width:150px;" onchange="this.form.submit()">
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
                            <th></th>
                        </tr>
                    </form>
                </thead>
                <tbody id="myTable">
                    
                @foreach($request_user as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_user->firstItem() + $key}}</td>
                        <td class="text-center">{{$data->request_user_no}}</td>
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
                        <td class="text-center">{{$data->sect_name}}</td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::subjectRequestUser($data->subject)}}
                        </td>
                        <td>
                            {{date('d-M-Y', strtotime($data->effective_date))}}
                        </td>
                        <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#requestuserdt{{$data->no}}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Detail
                            </a>
                            @include('request_system.request_user.modal_detail_requestuser')
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\Controller::getName($data->charge)}}
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::statusRequestUser($data->status_request_user)}}
                        </td>
                        <td class="text-center">
                            @if(session()->get('position') == 1 || session()->get('position') == 2)
                                @if($data->charge == "" && $data->status_request_user == 2)
                                    <div>
                                        <a href="" data-toggle="modal" data-target="#receiverequest{{$data->no}}">Receive</a>
                                        @include('request_system.request_user.modal_receive_requestuser')
                                    </div>
                                    <div>
                                        <a href="" data-toggle="modal" data-target="#refuserequest{{$data->no}}" class="text-danger">Refuse</a>
                                        @include('request_system.request_user.modal_refuse_requestuser')
                                    </div>             
                                @elseif($data->charge != "" && $data->status_request_user == 2)
                                    <i class="fa fa-pencil-square fa-lg text-info" aria-hidden="true"></i>   
                                @elseif($data->status_request_user >= 8)
                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>          
                                @elseif($data->status_request_user >= 3)
                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>
                                @endif
                            @else
                                @if($data->charge == "" && $data->status_request_user == 2)
                                    <i class="fa fa-pencil-square fa-lg text-info" aria-hidden="true"></i>
                                @elseif($data->charge != "" && $data->status_request_user == 2)
                                    <i class="fa fa-pencil-square fa-lg text-info" aria-hidden="true"></i>
                                @elseif($data->status_request_user >= 8)
                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                @elseif($data->status_request_user >= 3)
                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>
                                @endif  
                            @endif
                            
                        </td>
                        <td class="text-center">
                            @if($data->status_request_user == 7)
                                <a href="/pdfrequestuser/{{$data->request_user_no}}"><i class="fa fa-file-pdf-o fa-lg text-danger" aria-hidden="true"></i></a>
                            @else
                                <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $request_user->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_user->withQueryString()->links('pagination') }}
        </div>

        <script type="text/javascript" src="{{asset('scripts/receivenotifyrepair.js')}}"></script>
        
    </div>

@endsection