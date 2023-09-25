@extends('request_system.master_request')
@section('contents')
    @php 
        $signature = App\Http\Controllers\RequestController::imgSignature();
    @endphp
    <div style="margin-bottom:2%;">
        @if(empty(Cookie::get('name')))
            <button class="btnmenu" onclick="login()" >
                <i class="fa fa-plus" aria-hidden="true"></i> Request Admin
            </button>
            @if(Cookie::get('position') != "")
                <button class="btnmenu" onclick="login()" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Section Approve
                </button>
            @endif
        @elseif(empty($signature[0]->signature))
            <button class="btnmenu" onclick="notsignature()" >
                <i class="fa fa-plus" aria-hidden="true"></i> Request Admin
            </button>
            @if(Cookie::get('position') != "")
                <button class="btnmenu" onclick="notsignature()" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Section Approve
                </button>   
            @endif
        @else
            <button class="btnmenu" onclick="location.href='/showaddrequestadmin'" >
                <i class="fa fa-plus" aria-hidden="true"></i> Request Admin
            </button>
            @if(Cookie::get('position') != "")
                <button class="btnmenu" onclick="location.href='/listrequestadmin/approve/section'" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Section Approve
                </button>
            @endif
            @if(strpos(Cookie::get('position'), 'Mgr') !== false)
                <button class="btnmenu" onclick="location.href='/listrequestadmin/approve/relatesect'" >
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> 
                    Relate Approve
                </button>
            @endif
        @endif
    </div>

    <h2>Request Admin</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-sm"> 

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
                        <th class="text-center"></th>
                        <th></th>
                        <th></th>
                        <th class="text-center"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </form>
            </thead>
           
            <tbody id="myTable">
                @foreach($request_admin as $key => $data)
                <tr>
                    <td class="text-center">{{$request_admin->firstItem() + $key}}</td>
                    <td>{{$data->track}}</td>
                    <td>
                        {{$data->name}} {{$data->surname}}
                    </td>
                    <td class="text-center">
                        {{$data->sect_name}}
                    </td>
                    <td>{{$data->subject}}</td>
                    <td class="text-center">
                        <a href="" data-toggle="modal" data-target="#requestadmindt{{$data->no}}">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            Detail
                        </a>
                        @include('request_system.request_admin.modal_detail_requestadmin')
                    </td>
                    <td class="text-center">
                        {{App\Http\Controllers\RequestUserController::statusRequestUser($data->status_request_admin)}}
                    </td>
                    <td class="text-center">
                        {{App\Http\Controllers\RequestAdminController::confirmRequestAdmin($data->no, Cookie::get('employee_no'))}}
                    </td>
                    <td class="text-center">
                        @if($data->status_request_admin <= 2)
                            <a href="/editrequestadmin/{{$data->no}}" class="text-primary requestuseredt">Edit</a>
                        @else
                            <label class="text-secondary">Edit</label>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($data->status_request_admin <= 2)
                            <a href="/deleterequestadmin/{{$data->no}}" class="text-danger dlt_user">Delete</a>
                        @else
                            <label class="text-secondary">Delete</label>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        Total Result {{ $request_admin->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_admin->withQueryString()->links('pagination') }}
        </div>
        
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>

    </div>
@endsection