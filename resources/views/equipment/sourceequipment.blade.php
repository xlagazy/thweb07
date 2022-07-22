@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

   <div class="ct_listuser">

      <div>
         <h1 style="margin-bottom:2%">Equipment</h1>
      </div>
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
      <table id="table" class="table table-hover table-dark" style="font-size:0.8em;">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Equipment Number</th>
                <th scope="col">Equipment Name</th>
                <th scope="col">Fix Asset</th>
                <th scope="col">Equipment Type</th>
                <th scope="col">Computer Type</th>
                <th scope="col">Control Person</th>
                <th scope="col">Section</th>
                <th scope="col" style="text-align:center;">Location</th>
                <th scope="col" style="text-align:center;">Warranty</th>
                <th scope="col" style="text-align:center;">Status</th>
                <th scope="col" style="text-align:center;">QR Code</th>
            </tr>
        </thead>
        <tbody id="myTable">

         @foreach($equipment as $key => $equipments)
            <tr id="$key">
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}" style="text-align:center;">{{$equipment->firstItem() + $key}}</td>
                <td scope="row" data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">{{$equipments->equipment_no}}</td>
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">{{$equipments->equipment_name}}</td>
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">{{$equipments->fix_asset}}</td>
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">{{$equipments->equip_type_name}}</td>
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">{{$equipments->com_name}}</td>
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">{{$equipments->control_person}}</td>
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">{{$equipments->sect_name}}</td>
                <td data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}" style="text-align:center;">{{$equipments->location}}</td>
                <td style="text-align:center;" data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">
                     @php 
                        $setup_date = \App\Http\Controllers\EquipmentController::calWarranty($equipments->setup_date);
                     @endphp 

                     @if($equipments->warranty == 0)
                        <i class="fa fa-times-circle fa-2x" style="color:red;"></i>
                     @elseif($setup_date > $equipments->warranty)
                        <i class="fa fa-times-circle fa-2x" style="color:red;"></i>
                     @else
                        <i class="fa fa-check-circle fa-2x" style="color:#16FC07;"></i>
                     @endif
               </td>
                <td style="text-align:center;" data-toggle="modal" data-target="#equipdetail{{$equipments->equipment_no}}">
                     @if($equipments->equipment_status == "Using")
                        <i class="fa fa-check-circle fa-2x" style="color:#16FC07;"></i>
                     @else
                        <i class="fa fa-times-circle fa-2x" style="color:red;"></i>
                     @endif
                </td>
                <td style="text-align:center;">
                   <a href="" data-toggle="modal" data-target="#qrcode{{$equipments->equipment_no}}">{{ QrCode::size(40)->generate($equipments->equipment_no) }}</a>
               </td>
            </tr>

            <!-- Modal QR Code -->
            @include('equipment.modal_qr_code')

            <!-- Modal detail -->
            @include('equipment.modal_detail_equipment')

        @endforeach
        </tbody>
      </table>
      </div>

      Total Result {{ $equipment->total() }}

      <div class="d-flex justify-content-center">
         {{ $equipment->withQueryString()->links('pagination') }}
      </div>

      <!-- Modal add -->
      @include('equipment.modal_add_equipment')
      
      <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/showdiv.js')}}"></script>

   </div>

@endsection