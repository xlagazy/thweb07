@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Received Request Users</h1>
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
                        <th scope="col" class="text-center">Detail</th>
                        <th scope="col" class="text-center">Charge</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Update Status</th>
                        <th scope="col" class="text-center">Edit</th>
                    </tr>
                </thead>
                <tbody id="requestusertable">
                    @foreach($request_user as $key => $data)
                    <tr>
                        <td style="display:none">{{$data->status_request_user}}</td>
                        <td style="display:none">{{$data->end_date}}</td>
                        <td style="display:none">{{$data->program_install_date}}</td>
                        <td style="display:none">{{$data->time}}</td>
                        <td style="display:none">{{$data->end_detail}}</td>
                        <td style="display:none">{{$data->work_detail}}</td>
                        <td style="display:none">{{$data->yearly_no}}</td>
                        <td style="display:none">{{$data->time_type}}</td>
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
                            {{App\Http\Controllers\Controller::getName($data->charge)}}
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::statusRequestUser($data->status_request_user)}}
                        </td>
                        <td class="text-center">
                            <a href="" class="text-warning requestuserup" data-toggle="modal" data-target="#requestuserup">Update</a>
                            
                            @include('request_system.request_user.modal_update_requestuser')
                        </td>
                        <td class="text-center">
                            Edit
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

        <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/receivenotifyrepair.js')}}"></script>
        
    </div>

@endsection