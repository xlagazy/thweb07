@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Stock</h1>
        </div>

        <!-- table list eqmuipment -->
        <div class="table-responsive">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center;">No</th>
                        <th scope="col">Equipment Number</th>
                        <th scope="col">Equipment Name</th>
                        <th scope="col">Computer Type</th>
                        <th scope="col" style="text-align:center;">Status</th>
                    </tr>
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
                        <td >
                            @if($stocks->stock_status == 1)
                                <p style="background-color:green; text-align:center;"><b>{{$stocks->stock_status_name}}</b></p>
                            @else
                                <p style="background-color:red; text-align:center;"><b>{{$stocks->stock_status_name}}</b></p>
                            @endif
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
        
    </div>

@endsection