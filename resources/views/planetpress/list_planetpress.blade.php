@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <a href="{{URL::to('listplanetpress')}}" class="text-decoration-none text-dark">
                <h1 style="margin-bottom:2%">Planet Press Printer</h1>
            </a>
        </div>

        <div class="d-flex flex-row" style="margin-bottom:1%;">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addprinter">
                Add
            </button> 
            
        </div>
        <div>
            @include('planetpress.modal_add_planetpress')
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm">
                @if(count($planet) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <form action="{{URL::to('listplanetpress/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Work Station</th>
                            <th scope="col">Address</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">User</th>
                            <th scope="col">Printer</th>
                            <th scope="col" >Edit</th>
                            <th scope="col" >Copy</th>
                            <th scope="col">Delete</th>
                        </tr>
                            <tr style="border-top: hidden;">
                                <th scope="col"></th>
                                <th scope="col">
                                    <input type="text" name="search_workstation" id="search_workstation" value="{{$search_workstation}}" size="10" onchange="this.form.submit()" placeholder="Search">
                                </th>
                                <th scope="col">
                                    <input type="text" name="search_address" id="search_address" value="{{$search_address}}" onchange="this.form.submit()" placeholder="Search">
                                </th>
                                <th scope="col">
                                    <input type="text" name="search_description" id="search_description" value="{{$search_description}}" onchange="this.form.submit()" placeholder="Search">
                                </th>
                                <th scope="col">
                                    <select name="search_status" style="height:30px;width:60px;" onchange="this.form.submit()">
                                        <option selected value="">Search...</option>
                                        @if($search_status == 'Y')
                                            <option value="Y" selected>Y</option>
                                        @else
                                            <option value="Y">Y</option>
                                        @endif
                                        
                                        @if($search_status == 'N')
                                            <option value="N" selected>N</option>
                                        @else
                                            <option value="N">N</option>
                                        @endif
                                    </select>
                                </th>
                                <th scope="col">
                                    <input type="text" name="search_user" id="search_user" value="{{$search_user}}" onchange="this.form.submit()" placeholder="Search">
                                </th>
                                <th scope="col">
                                    <select name="search_printer" style="height:30px;width:70px;" onchange="this.form.submit()" onchange="this.form.submit()">
                                        <option selected value="">Search...</option>
                                        <option value="CANON">CANON</option>
                                        <option value="HP">HP</option>
                                    </select>
                                </th>
                                <th scope="col" ></th>
                                <th scope="col" ></th>
                                <th scope="col"></th>
                            </tr>
                    </thead>
                </form>
                <tbody id="myTable">

                @foreach($planet as $key => $data)
                    <tr>
                        <td scope="row" >{{$planet->firstItem() + $key}}</td>
                        <td scope="row" >{{$data->OutQueue}}</td>
                        <td scope="row" >{{$data->Output}}</td>
                        <td scope="row" >{{$data->Description}}</td>
                        <td scope="row" >{{$data->Status}}</td>
                        <td scope="row" >{{$data->User_ID}}</td>
                        <td scope="row" >{{$data->Printername}}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#editprinter{{$data->ID}}">
                            <i class="bi bi-pencil-square"></i>
                            Edit</a>  
                            <div>
                                @include('planetpress.modal_edit_planetpress')
                            </div>                      
                        </td>
                        <td>
                            <a href="" class="text-warning" data-toggle="modal" data-target="#copyprinter{{$data->ID}}">
                            <i class="bi bi-pencil-square"></i>
                            Copy</a>  
                            <div>
                                @include('planetpress.modal_copy_planetpress')
                            </div>                      
                        </td>
                        <td>
                            <a href="/deleteplanetpress/{{$data->ID}}" class="dlt_user text-danger">
                            <i class="bi bi-trash"></i>
                            Delete</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>

        Total Result {{ $planet->total() }}

        <div class="d-flex justify-content-center">
            {{ $planet->withQueryString()->links('pagination') }}
        </div>
        
        <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>

    </div>

@endsection