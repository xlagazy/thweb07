@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Approve request users</h1>
        </div>

        <div class="d-flex flex-row" style="margin-bottom:1%;">

            <a href="" style="margin-left:auto" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>

        </div>

        <!-- Modal Export Excel -->

        <!-- table list request user -->
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                @if(count($request_user) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <form action="{{URL::to('/listrequestuser/approve/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                        <tr>
                            <th scope="col" class="text-center align-middle" rowspan="2">No</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Request No.</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Track Number</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Name / Surname</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Section</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Subject</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Effective date</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Detail</th>
                            <th scope="col" class="text-center align-middle" colspan="3">Finish Approve</th>
                            <th scope="col" class="text-center align-middle" colspan="3">Receive Approve</th>
                        </tr>
                        <tr>
                            <th scope="col" class="text-center">Manager</th>
                            <th scope="col" class="text-center">Chief</th>
                            <th scope="col" class="text-center">Charge</th>
                            <th scope="col" class="text-center">Manager</th>
                            <th scope="col" class="text-center">Chief</th>
                            <th scope="col" class="text-center">Charge</th>
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

                            @for($x=0;$x<$count;$x++)
                                {{App\Http\Controllers\RequestUserController::getPrefix($arrPrefix[$x])}}{{$arrName[$x]}} {{$arrSurName[$x]}}
                            @endfor
                        </td>
                        <td class="text-center">{{$data->sect_name}}</td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::subjectRequestUser($data->subject)}}
                        </td>
                        <td class="text-center">
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
                            @php
                                App\Http\Controllers\RequestUserController::approveEndRequestUserManager($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveEndRequestUserChief($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveEndRequestUserCharge($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveRequestUserManager($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveRequestUserChief($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\Controller::getName($data->charge)}}
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

        <script type="text/javascript" src="{{asset('scripts/checklogin.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/approve.js')}}"></script>
        
    </div>

@endsection