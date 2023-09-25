@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Received Request Admin</h1>
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
                    <form action="{{URL::to('/listrequestuser/receieved/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                        <tr>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center" style="display:none"></th>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Request No.</th>
                            <th scope="col" class="text-center">Track Number</th>
                            <th scope="col" class="text-center">Name / Surname</th>
                            <th scope="col" class="text-center">Section</th>
                            <th scope="col" class="text-center">Subject</th>
                            <th scope="col" class="text-center">Need date</th>
                            <th scope="col" class="text-center">Detail</th>
                            <th scope="col" class="text-center">Charge</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Update Status</th>
                            <th scope="col" class="text-center">Edit</th>
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
                            <th>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    </form>
                </thead>
                <tbody id="requestadmintable">
                    @foreach($request_admin as $key => $data)
                    <tr>
                        <td style="display:none">{{$data->status_request_admin}}</td>
                        <td style="display:none">{{$data->end_date}}</td>
                        <td style="display:none">{{$data->program_install_date}}</td>
                        <td style="display:none">{{$data->time}}</td>
                        <td style="display:none">{{$data->end_detail}}</td>
                        <td style="display:none">{{$data->work_detail}}</td>
                        <td style="display:none">{{$data->yearly_no}}</td>
                        <td style="display:none">{{$data->time_type}}</td>
                        <td style="display:none">{{$data->no}}</td>
                        <td style="display:none">{{$data->kind_request}}</td>
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
                        <td>
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
                            {{App\Http\Controllers\Controller::getName($data->charge)}}
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::statusRequestUser($data->status_request_admin)}}
                        </td>
                        <td class="text-center">
                            @if($data->status_request_admin <= 6)
                                <a href="" class="text-warning requestadminup" data-toggle="modal" data-target="#requestadminup">Update</a>
                                @include('request_system.request_admin.modal_update_requestadmin')
                            @else($data->status_request_admin == 7)
                                Update 
                            @endif
                        </td>
                        <td class="text-center">
                            @if($data->status_request_admin <= 6)
                                <a href="/editrequestadminit/{{$data->no}}" class="text-primary requestuseredt">Edit</a>
                            @else($data->status_request_admin == 7)
                                Edit 
                            @endif
                           
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

        <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/receivenotifyrepair.js')}}"></script>
        
    </div>

@endsection