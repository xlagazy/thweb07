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
        
            <!-- Button trigger modal add borrow -->
            <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
                Borrow
            </button>

            <!-- Button trigger modal sum stock -->
            <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#modalsumstock" style="margin-left:0.5%;">
                Stock
            </button>

            <a href="" style="margin-left:auto;" data-toggle="modal" data-target="#modalexportexcel">
                <img src="/images/icons/excel.png" style="width:40px;height:40px;">
            </a>

        </div>

        <!-- Modal Export Excel -->
        @include('borrow.modal_export_borrow')

        <!-- Modal Export Excel -->
        @include('borrow.modal_sum_stock')

        <!-- table list eqmuipment -->
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                @if(count($borrow) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                        <tr>
                            <th class="align-top" scope="col" style="text-align:center;">No</th>
                            <th class="align-top" scope="col">Equipment Number</th>
                            <th class="align-top" scope="col">Equipment Name</th>
                            <th class="align-top" scope="col">Computer Type</th>
                            <th class="align-top" scope="col">User Borrow</th>
                            <th class="align-top" scope="col">Section</th>
                            <th class="align-top" scope="col">Start Date</th>
                            <th class="align-top" scope="col">End Date</th>
                            <th class="align-top" scope="col">Charge</th>
                            <th class="align-top" scope="col" style="text-align:center;">Status</th>
                            <th class="align-top" scope="col" >Edit</th>
                            <th class="align-top" scope="col">Delete</th>
                        </tr>
                        <form action="{{URL::to('listborrow/search')}}" method="get" id="form" class="form-inline" style="margin-right:auto;">
                            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                            <tr style="border-top: hidden;">
                                <th></th>
                                <th>
                                    <input type="text" name="search_equip_number" id="search_equip_number" value="{{$search_equip_number}}" size="10" placeholder="Search">
                                </th>
                                <th>
                                    <input type="text" name="search_equip_name" id="search_equip_name" value="{{$search_equip_name}}" placeholder="Search">
                                </th>
                                <th>
                                    <select name="com_name" style="height:30px;" onchange="this.form.submit()">
                                        <option selected value="">Computer Type...</option>
                                        @foreach($com_type as $com_types)
                                            @if($com_name == $com_types->com_name)
                                                <option value="{{$com_types->com_name}}" selected>{{$com_types->com_name}}</option>
                                            @else
                                                <option value="{{$com_types->com_name}}">{{$com_types->com_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <input type="text" name="search_user_borrow" id="search_user_borrow" value="{{$search_user_borrow}}" size="10" placeholder="Search">
                                </th>
                                <th>
                                    <select name="sect_name" style="height:30px;" onchange="this.form.submit()">
                                        <option selected value="">Section...</option>
                                        @foreach($section as $sections)
                                            @if($sect_name == $sections->sect_name)
                                                <option value="{{$sections->sect_name}}" selected>{{$sections->sect_name}}</option>
                                            @else
                                                <option value="{{$sections->sect_name}}">{{$sections->sect_name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <select name="status" style="height:30px;" onchange="this.form.submit()">
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
                                </th>
                            </tr>
                        </form>
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
                        <td style="color:#fff;">
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
        
        <script>
            document.getElementById("search_equip_number").addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    form.submit();
                }
            });

            document.getElementById("search_equip_name").addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    form.submit();
                }
            });

            document.getElementById("search_user_borrow").addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    form.submit();
                }
            });
        </script>
    </div>

@endsection