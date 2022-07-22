@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <a href="{{URL::to('listborrow')}}" class="text-decoration-none text-dark">
                <h1 style="margin-bottom:2%">Borrow</h1>
            </a>
        </div>

        <!-- Get value to addborrow.js file -->
        <script>

        var stock = <?php echo json_encode($stock); ?>;

        </script>

        <div class="d-flex flex-row" style="margin-bottom:1%;">
        
            <form action="{{URL::to('searchborrow')}}" method="get" class="form-inline" style="margin-right:auto;">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <table>
                    <tr>
                        <td>
                            <!-- Button trigger modal add borrow -->
                            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
                                Borrow
                            </button>

                            <!-- Button trigger modal sum stock -->
                            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#modalsumstock">
                                Stock
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group mb-2">
                                <input type="text" name="search" class="form-control" value="{{$search}}" placeholder="Search">
                            </div>
                        </td>
                        <td>
                            <div class="form-group mb-2">
                                <select name="com_name" class="form-control">
                                <option selected value="">Computer Type...</option>
                                @foreach($com_type as $com_types)
                                    @if($com_name == $com_types->com_name)
                                        <option value="{{$com_types->com_name}}" selected>{{$com_types->com_name}}</option>
                                    @else
                                        <option value="{{$com_types->com_name}}">{{$com_types->com_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group mb-2">
                                <select name="sect_name" class="form-control">
                                <option selected value="">Section...</option>
                                @foreach($section as $sections)
                                    @if($sect_name == $sections->sect_name)
                                        <option value="{{$sections->sect_name}}" selected>{{$sections->sect_name}}</option>
                                    @else
                                        <option value="{{$sections->sect_name}}">{{$sections->sect_name}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="form-group mb-2">
                                <select name="status" class="form-control">
                                <option selected value="">Status...</option>
                                @if($status == 1)
                                    <option value="1" selected>Restored</option>
                                @else
                                    <option value="1" >Restored</option>
                                @endif

                                @if($status == 2)
                                    <option value="2" selected>Borrow</option>
                                @else
                                    <option value="2" >Borrow</option>
                                @endif
                                </select>
                            </div>
                        </td>
                        <td>
                            <input type="submit" value="ค้นหา" class="btn btn-primary mb-2" style="margin:0 2% 0 2%">
                        </td>
                    </tr>
                </table> 
            </form>

            <a href="" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>

        </div>

        <!-- Modal Export Excel -->
        @include('borrow.modal_export_borrow')

        <!-- Modal Export Excel -->
        @include('borrow.modal_sum_stock')

        <!-- table list eqmuipment -->
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                @if(count($borrow) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center;">No</th>
                        <th scope="col">Equipment Number</th>
                        <th scope="col">Equipment Name</th>
                        <th scope="col">Computer Type</th>
                        <th scope="col">User Borrow</th>
                        <th scope="col">Section</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Charge</th>
                        <th scope="col" style="text-align:center;">Status</th>
                        <th scope="col" >Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="myTable">

                @foreach($borrow as $key => $borrows)
                    <tr>
                        <td style="text-align:center;">{{$borrow->firstItem() + $key}}</td>
                        <td>{{$borrows->equipment_no}}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#dtmodal{{$borrows->borrow_no}}">
                                {{$borrows->equipment_name}}
                            </a>

                            @include('borrow.modal_detail_borrow');
                        </td>
                        <td>{{$borrows->com_name}}</td>
                        <td>{{$borrows->user_borrow}}</td>
                        <td>{{$borrows->sect_name}}</td>
                        <td>{{date("d-M-Y", strtotime($borrows->start_date))}}</td>
                        <td>{{date("d-M-Y", strtotime($borrows->end_date))}}</td>
                        <td>{{$borrows->name}}</td>
                        <td>
                            @if($borrows->borrow_status == 1)
                                <p style="background-color:green; text-align:center;"><b>{{$borrows->borrow_status_name}}</b></p>
                            @else
                                <p style="background-color:red; text-align:center;"><b>{{$borrows->borrow_status_name}}</b></p>
                            @endif
                        </td>
                        <td>
                            @if($borrows->borrow_status != 1)
                                <a href="/showeditborrow/{{$borrows->borrow_no}}">
                                <i class="fa fa-pencil-square-o fa-lg"></i>
                                Edit</a>
                            @else
                                <i class="fa fa-pencil-square-o fa-lg"></i>
                                Edit
                            @endif
                        </td>
                        <td>
                            <a href="deleteborrow/{{$borrows->borrow_no}}&{{$borrows->borrow_status}}&{{$borrows->equipment_no}}" class="dlt_user" style="color:red;">
                            <i class="fa fa-trash-o fa-lg"></i>
                            Delete</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $borrow->total() }}

        <div class="d-flex justify-content-center">
            {{ $borrow->withQueryString()->links('pagination') }}
        </div>

        <!-- Modal add -->
        @include('borrow.modal_add_borrow')

        <script type="text/javascript" src="{{asset('scripts/addborrow.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>
        
    </div>

@endsection