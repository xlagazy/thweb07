@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">
        
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addmodal" style="margin-bottom:1%">
            เพิ่มผู้ใช้        
        </button>

        <table class="table table-hover table-dark">
        @if(count($member) == 0)
            <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
        @endif
        <thead>
            <tr>
                <th scope="col">Employees Number</th>
                <th scope="col">Name</th>
                <th scope="col">Sub</th>
                <th scope="col" >Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
        @foreach($member as $members)
            <tr>
                <th scope="row">{{$members->employees_no}}</th>
                <td>{{$members->name}}</td>
                <td>{{$members->sub_it_name}}</td>
                <td>
                    <a href="showedituser/{{$members->user_id}}" >
                    <i class="bi bi-pencil-square"></i>
                    Edit</a>
                </td>
                <td>
                    <a href="deleteuser/{{$members->user_id}}" class="dlt_user" style="color:red;">
                    <i class="bi bi-trash"></i>
                    Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>

        </table>

         <!-- Modal add -->
         @include('organize.modal_add_user')
        
    </div>

    <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
    <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>

@endsection