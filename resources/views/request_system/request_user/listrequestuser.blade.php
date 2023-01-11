@extends('notifyrepair.master_notifyrepair')
@section('contents')
    <div style="margin-bottom:2%;">
        <button class="btnmenu" onclick="location.href='/showaddrequestuser'" >
            <i class="fa fa-plus" aria-hidden="true"></i> Request User
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-sm">

            @if(count($request_user) == 0)
                <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
            <thead>
                <tr>
                    <th scope="col" class="align-top text-center" width="5%">No</th>
                    <th scope="col" class="align-top" width="15%">Track Number</th>
                    <th class="align-top text-center" scope="col" width="30%">Name / Surname</th>
                    <th class="align-top text-center" scope="col" width="5%">Section</th>
                    <th class="align-top text-center" scope="col" width="20%">Subject</th>
                    <th class="align-top text-center" scope="col" width="10%">Detail</th>
                    <th class="align-top text-center" scope="col" width="20%">Status</th>
                </tr>
            </thead>

            <tbody id="myTable">
                
                @foreach($request_user as $key => $data)
                <tr>
                    <td class="text-center">{{$request_user->firstItem() + $key}}</td>
                    <td>{{$data->track}}</td>
                    <td>
                        {{$data->fullname}}
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
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection