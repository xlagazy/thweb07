@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

   <div class="ct_listuser">

      <div>
         <a href="{{URL::to('listotherequipment')}}" class="text-decoration-none text-dark">
            <h1 style="margin-bottom:2%">Others Equipment</h1>
         </a>
      </div>

      <div class="d-flex flex-row" style="margin-bottom:1%;">

         <!-- Button trigger modal -->
         <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
            เพิ่ม Others Equipment
         </button>

         <a href="" style="margin-left:auto" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>

      </div>

      <!-- Modal Export Excel -->
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
         <table class="table table-bordered table-sm w-auto">
            @if(count($other_equipment) == 0)
               <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
         <thead>
            <form action="{{URL::to('listotherequipment/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
               <tr>
                  <th scope="col" class="align-top">No</th>
                  <th scope="col" class="align-top">Equipment Number</th>
                  <th scope="col" class="align-top">Equipment Name</th>
                  <th scope="col" class="align-top">Fix Asset</th>
                  <th scope="col" class="align-top">Equipment Type</th>
                  <th scope="col" class="align-top">Control Person</th>
                  <th scope="col" class="align-top">Section</th>
                  <th scope="col" class="align-top" style="text-align:center;">Location</th>
                  <th scope="col" class="align-top" style="text-align:center;">Status</th>
                  <th scope="col" class="align-top" style="text-align:center;">Warranty</th>
                  <th scope="col" class="align-top" style="text-align:center;">QR Code</th>
                  <th scope="col" class="align-top">Edit</th>
                  <th scope="col" class="align-top">Delete</th>
               </tr>
               <tr style="border-top: hidden;">
                  <th></th>
                  <th>
                     <input type="text" name="search_equip_no" id="search_equip_no" value="{{$search_equip_no}}" size="12" placeholder="Search">
                  </th>
                  <th>
                     <input type="text" name="search_equip_name" id="search_equip_name" value="{{$search_equip_name}}" placeholder="Search">
                  </th>
                  <th>
                     <input type="text" name="search_fix_asset" id="search_fix_asset" value="{{$search_fix_asset}}" size="8" placeholder="Search">
                  </th>
                  <th>
                     <select name="equip_type_name" style="height:30px;width:100px;" onchange="this.form.submit()">
                        <option selected value="">Equipment Type...</option>
                        @foreach($other_equip_type as $equip_ties)
                           @if($equip_type_name == $equip_ties->ot_equip_type_name)
                              <option value="{{$equip_ties->ot_equip_type_name}}" selected>{{$equip_ties->ot_equip_type_name}}</option>
                           @else
                              <option value="{{$equip_ties->ot_equip_type_name}}">{{$equip_ties->ot_equip_type_name}}</option>
                           @endif
                        @endforeach
                     </select>
                  </th>
                  <th></th>
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
                  <th>
                  </th>
                  <th>
                     <select name="equipment_status" style="height:30px;" onchange="this.form.submit()">
                           <option  selected value="">Status...</option>
                           @if($equipment_status == "Using")
                              <option value="Using" selected>Using</option>
                           @else
                              <option value="Using">Using</option>
                           @endif
                           @if($equipment_status == "Broken")
                              <option value="Broken" selected>Broken</option>
                           @else
                              <option value="Broken">Broken</option>
                           @endif
                           @if($equipment_status == "Write off")
                              <option value="Write off" selected>Write off</option>
                           @else
                              <option value="Write off">Write off</option>
                           @endif
                     </select>
                  </th>
               </tr>
            </form>
         </thead>
         <tbody id="myTable">

            @foreach($other_equipment as $key => $equipments)
               <tr id="$key">
                  <td style="text-align:center;">{{$other_equipment->firstItem() + $key}}</td>
                  <td>{{$equipments->ot_equipment_no}}</td>
                  <td>
                     <div style="width: 150px; overflow:hidden; text-overflow: ellipsis;">
                        <a href="" data-toggle="modal" data-target="#equipotherdetail{{$equipments->ot_equipment_no}}">{{$equipments->ot_equipment_name}}</a>
                     </div>
                  </td>
                  <td>{{$equipments->fix_asset}}</td>
                  <td>{{$equipments->ot_equip_type_name}}</td>
                  <td>{{$equipments->control_person}}</td>
                  <td>{{$equipments->sect_name}}</td>
                  <td>{{$equipments->locat_name}}</td>
                  <td style="text-align:center;" data-toggle="modal" data-target="#equipdetail{{$equipments->ot_equipment_no}}">
                        @if($equipments->equipment_status == "Using")
                           Using
                        @elseif($equipments->equipment_status == "Broken")
                           Broken
                        @elseif($equipments->equipment_status == "Write off")
                           Write off
                        @endif
                  </td>
                  <td style="text-align:center;" data-toggle="modal">
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
                  <td style="text-align:center;">
                     <a href="" data-toggle="modal" data-target="#qrcodeother{{$equipments->ot_equipment_no}}">{{ QrCode::size(40)->generate($equipments->ot_equipment_no) }}</a>
                  </td>
                  <td>
                        <a href="/showeditotherequipment/{{$equipments->ot_equipment_no}}">
                        <i class="fa fa-pencil-square-o fa-lg"></i>
                        Edit</a>
                  </td>
                  <td>
                     <a href="/deleteotherequipment/{{$equipments->ot_equipment_no}}" class="dlt_user" style="color:red;">
                     <i class="fa fa-trash-o fa-lg"></i>
                     Delete</a>
                  </td>
               </tr>
               
               <!-- Modal QR Code -->
               @include('equipment.modal_qr_code_other')

               <!-- Modal detail -->
               @include('equipment.modal_detail_other_equipment')

               

         @endforeach
         </tbody>
         </table>
      </div>

      Total Result {{ $other_equipment->total() }}

      <div class="d-flex justify-content-center">
         {{ $other_equipment->withQueryString()->links('pagination') }}
      </div>

      <!-- Modal add -->
      @include('equipment.modal_add_other_equipment')
      
      <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/showdiv.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/checkequipstatus.js')}}"></script>

      <!-- enter search -->
      <script>
         document.getElementById("search_equip_no").addEventListener("keypress", function(event) {
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

         document.getElementById("search_fix_asset").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
               event.preventDefault();
               form.submit();
            }
         });
      </script>

   </div>

@endsection