@extends('request_system.master_request')
@section('contents')

    <div class="row">
        <button class="btnmenu"><i class="fa fa-plus" aria-hidden="true"></i> Request Application</button>
        <button class="btnmenu" style="margin-left:1%;"><i class="fa fa-plus" aria-hidden="true"></i> Request Developer</button>
    </div>
    {{Cookie::get('name')}}
    {{Cookie::get('position')}}
    {{Cookie::get('employee_no')}}
    {{Cookie::get('section')}}
    {{Cookie::get('email')}}
@endsection