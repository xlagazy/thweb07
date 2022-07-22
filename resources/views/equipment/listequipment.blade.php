@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

   <div class="ct_listuser">

      <div>
         <a href="{{URL::to('listequipment')}}" class="text-decoration-none text-dark">
            <h1 style="margin-bottom:2%">Equipment</h1>
         </a>
      </div>

      <div class="d-flex flex-row" style="margin-bottom:1%;">
      
         <form form action="{{URL::to('listequipment/search')}}" method="get" class="form-inline" style="margin-right:auto;">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
            <table>
               <tr>
                  <td>
                     <!-- Button trigger modal -->
                     <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
                        เพิ่ม Equipment
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
                        <select name="equip_type_name" class="form-control">
                           <option selected value="">Equipment Type...</option>
                           @foreach($equip_type as $equip_ties)
                              @if($equip_type_name == $equip_ties->equip_type_name)
                                 <option value="{{$equip_ties->equip_type_name}}" selected>{{$equip_ties->equip_type_name}}</option>
                              @else
                                 <option value="{{$equip_ties->equip_type_name}}">{{$equip_ties->equip_type_name}}</option>
                              @endif
                           @endforeach
                        </select>
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
                     <input type="submit" value="ค้นหา" class="btn btn-primary mb-2" style="margin:0 2% 0 2%">
                  </td>
               </tr>
            </table> 
         </form>

         <a href="" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>

      </div>

      <!-- Modal Export Excel -->
      @include('equipment.modal_export_excel')
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
         <table id="table" class="table table-hover table-dark" style="font-size:0.8em;">
            @if(count($equipment) == 0)
               <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
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
                  <th scope="col" >Edit</th>
                  <th scope="col">Delete</th>
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
                  <td>
                        <a href="/showeditequipment/{{$equipments->equipment_no}}">
                        <i class="fa fa-pencil-square-o fa-lg"></i>
                        Edit</a>
                  </td>
                  <td>
                     <a href="/deletequipment/{{$equipments->equipment_no}}" class="dlt_user" style="color:red;">
                     <i class="fa fa-trash-o fa-lg"></i>
                     Delete</a>
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