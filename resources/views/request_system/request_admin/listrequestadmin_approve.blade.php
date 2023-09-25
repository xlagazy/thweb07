@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Approve request admin</h1>
        </div>

        <div class="d-flex flex-row" style="margin-bottom:1%;">

            <a href="" style="margin-left:auto" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>

        </div>

        <!-- table list request user -->
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                @if(count($request_admin) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <form action="{{URL::to('/listrequestadmin/approve/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                        <tr>
                            <th scope="col" class="text-center align-middle" rowspan="2">No</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Request No.</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Track Number</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Name / Surname</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Section</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Subject</th>
                            <th scope="col" class="text-center align-middle" rowspan="2">Need date</th>
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
                            </th>
                            <th>
                            </th>
                            <th></th>
                            <th>
                             </th>
                            <th>
                            </th>
                            <th>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    </form>
                </thead>
                <tbody id="myTable">
                    
                    @foreach($request_admin as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_admin->firstItem() + $key}}</td>
                        <td class="text-center">{{$data->request_admin_no}}</td>
                        <td>{{$data->track}}</td>
                        <td>
                            {{$data->name}} {{$data->surname}}
                        </td>
                        <td class="text-center">{{$data->sect_name}}</td>
                        <td class="text-center">
                            {{$data->subject}}
                        </td>
                        <td class="text-center">
                            {{date('d-M-Y', strtotime($data->need_date))}}
                        </td>
                        <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#requestadmindt{{$data->no}}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Detail
                            </a>
                            @include('request_system.request_admin.modal_detail_requestadmin')
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestAdminController::approveEndRequestAdminManager($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestAdminController::approveEndRequestAdminChief($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestAdminController::approveEndRequestAdminCharge($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestAdminController::approveRequestAdminManager($data->no, session()->get('user_id'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestAdminController::approveRequestAdminChief($data->no, session()->get('user_id'));
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

        Total Result {{ $request_admin->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_admin->withQueryString()->links('pagination') }}
        </div>

        <script type="text/javascript" src="{{asset('scripts/checklogin.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/approve.js')}}"></script>
        
    </div>

@endsection