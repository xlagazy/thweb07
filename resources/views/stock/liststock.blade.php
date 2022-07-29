@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">
        <div>
            <a href="{{URL::to('liststock')}}" class="text-decoration-none text-dark">
                <h1 style="margin-bottom:2%">Stock</h1>
            </a>
        </div>

        <!-- Get value to addstock.js file -->
        <script>

        var equipment = <?php echo json_encode($equipment); ?>;
        var stock = <?php echo json_encode($st); ?>;

        </script>

        <div class="d-flex flex-row" style="margin-bottom:1%;">
        
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
            เพิ่ม Stock
        </button>

        <a href="" style="margin-left:auto" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>

        </div>

        <!-- Modal Export Excel -->
        @include('stock.modal_export_stock')

        <!-- table list eqmuipment -->
        <div class="table-responsive">
            
            <table class="table table-bordered table-sm">
                @if(count($stock) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <form action="{{URL::to('liststock/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                        <tr>
                            <th scope="col" class="align-top" style="text-align:center;">No</th>
                            <th scope="col">Equipment Number
                                <br>
                                <input type="text" name="search_equip_number" id="search_equip_number" value="{{$search_equip_number}}" placeholder="Search">
                            </th>
                            <th scope="col">Equipment Name
                                <br>
                                <input type="text" name="search_equip_name" id="search_equip_name" value="{{$search_equip_name}}" placeholder="Search">
                            </th>
                            <th scope="col">Computer Type<br>
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
                            <th scope="col" style="text-align:center;">
                                Status
                                <br>
                                <select name="status" style="height:30px;" onchange="this.form.submit()">
                                <option selected value="">Status...</option>
                                    @if($status == 1)
                                        <option value="1" selected>Stock</option>
                                    @else
                                        <option value="1" >Stock</option>
                                    @endif

                                    @if($status == 2)
                                        <option value="2" selected>Borrow</option>
                                    @else
                                        <option value="2" >Borrow</option>
                                    @endif
                                </select>
                            </th>
                            <th scope="col" class="align-top">Edit</th>
                            <th scope="col" class="align-top">Delete</th>
                        </tr>
                    </form>
                </thead>
                <tbody id="myTable">

                @foreach($stock as $key => $stocks)
                    <tr>
                        <td style="text-align:center;">{{$stock->firstItem() + $key}}</td>
                        <td>{{$stocks->equipment_no}}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#dtmodal{{$stocks->stock_no}}">
                                {{$stocks->equipment_name}}
                            </a>

                            @include('stock.modal_detail_stock');
                        </td>
                        <td>{{$stocks->com_name}}</td>
                        <td>
                            @if($stocks->stock_status == 1)
                                <p style="background-color:green; color:#fff; text-align:center;"><b>{{$stocks->stock_status_name}}</b></p>
                            @else
                                <p style="background-color:red; color:#fff; text-align:center;"><b>{{$stocks->stock_status_name}}</b></p>
                            @endif
                        </td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#edtmodal{{$stocks->stock_no}}">
                            <i class="fa fa-pencil-square-o fa-lg"></i>
                            Edit</a>

                            @include('stock.modal_edit_stock');
                        </td>
                        <td>
                            <a href="deletestock/{{$stocks->stock_no}}" class="dlt_user" style="color:red;">
                            <i class="fa fa-trash-o fa-lg"></i>
                            Delete</a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $stock->total() }}

        <div class="d-flex justify-content-center">
            {{ $stock->withQueryString()->links('pagination') }}
        </div>
        
        <!-- Modal add -->
        @include('stock.modal_add_stock')

        <script type="text/javascript" src="{{asset('scripts/addstock.js')}}"></script>
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

      </script>

        
    </div>

@endsection