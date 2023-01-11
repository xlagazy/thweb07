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
                    <tr>
                        <th scope="col" class="text-center align-middle" rowspan="2">No</th>
                        <th scope="col" class="text-center align-middle" rowspan="2">Request No.</th>
                        <th scope="col" class="text-center align-middle" rowspan="2">Track Number</th>
                        <th scope="col" class="text-center align-middle" rowspan="2">Name / Surname</th>
                        <th scope="col" class="text-center align-middle" rowspan="2">Section</th>
                        <th scope="col" class="text-center align-middle" rowspan="2">Subject</th>
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
                </thead>
                <tbody id="myTable">
                    
                    @foreach($request_user as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_user->firstItem() + $key}}</td>
                        <td class="text-center">{{$data->request_user_no}}</td>
                        <td>{{$data->track}}</td>
                        <td>{{$data->fullname}}</td>
                        <td class="text-center">{{$data->sect_name}}</td>
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
                            @php
                                App\Http\Controllers\RequestUserController::approveEndRequestUserManager($data->request_user_no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveEndRequestUserChief($data->request_user_no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\Controller::getName($data->end_charge)}}
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveRequestUserManager($data->request_user_no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveRequestUserChief($data->request_user_no, session()->get('user_id'));
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