@extends('request_system.master_request')
@section('contents')

    <div class="row">
        <!-- button add request applocation -->
        @php 
            $signature = App\Http\Controllers\RequestController::imgSignature();
        @endphp

        @if(empty(Cookie::get('name')))
            <button class="btnmenu"  onclick="login()"><i class="fa fa-plus" aria-hidden="true"></i> Request Application</button>
        @elseif(empty($signature[0]->signature))
            <button class="btnmenu"  onclick="notsignature()"><i class="fa fa-plus" aria-hidden="true"></i> Request Application</button>
        @else
            <button class="btnmenu" data-toggle="modal" data-target="#addrequestappmodal"><i class="fa fa-plus" aria-hidden="true"></i> Request Application</button>
        @endif

        @include('request_system.request_app.modal_add_request_app')
        <!-- button add request developer -->
        <button class="btnmenu" style="margin-left:1%;"><i class="fa fa-plus" aria-hidden="true"></i> Request Developer</button>
    </div>

    {{Cookie::get('name')}}
    {{Cookie::get('position')}}
    {{Cookie::get('employee_no')}}
    {{Cookie::get('section')}}
    {{Cookie::get('email')}}

@endsection