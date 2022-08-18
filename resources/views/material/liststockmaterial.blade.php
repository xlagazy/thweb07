@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

   <div class="ct_listuser">

      <div>
         <a href="{{URL::to('liststockmaterial')}}" class="text-decoration-none text-dark"><h1 style="margin-bottom:2%">Stock Material</h1></a>
      </div>

      <div class="d-flex flex-row" style="margin-bottom:1%;">
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
            เพิ่ม Stock Material      
         </button>
   
         <!-- <a href="" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a> -->
      </div>

      <!-- Modal Export Excel -->
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
         <table class="table table-bordered table-sm">
            @if(count($stockmaterial) == 0)
               <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
         <thead>
               <tr>
                  <th scope="col">No</th>
                  <th scope="col">Material Name</th>
                  <th scope="col">QTY</th>
                  <th scope="col">Input Date</th>
                  <th scope="col" >Edit</th>
                  <th scope="col">Delete</th>
               </tr>
               <form action="{{URL::to('liststockmaterial/search')}}" id="form" method="get" class="form-inline" style="margin-right:auto;">
                  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                  <tr style="border-top: hidden;">
                     <th></th>
                     <th>
                        <input type="text" name="search_material_name" id="search_material_name" value="{{$search_material_name}}" placeholder="Search">
                     </th>
                     <th></th>
                     <th>
                        <input type="date" name="date" value="{{$date}}" onchange="this.form.submit()">
                     </th>
                     <th></th>
                     <th></th>
                  </tr>
               </form>
         </thead>
         <tbody>

            @foreach($stockmaterial as $key => $stockmaterials)

               <tr>
                  <td style="text-align:center;">{{$stockmaterial->firstItem() + $key}}</td>
                  <td data-toggle="modal" data-target="#detail">{{$stockmaterials->material_name}}</td>
                  <td>{{$stockmaterials->stock_material_qty}}</td>
                  <td>{{date("d-M-Y", strtotime($stockmaterials->input_date))}}</td>
                  <td>
                        <a href="" data-toggle="modal" data-target="#edt{{$stockmaterials->stock_material_no}}">
                        <i class="fa fa-pencil-square-o fa-lg"></i>
                        Edit</a>

                        <!-- Modal Edit -->
                        @include('material.modal_edit_stock_material')
                  </td>
                  <td>
                     <a href="/deletestockmaterial/{{$stockmaterials->stock_material_no}}" class="dlt_user" style="color:red;">
                     <i class="fa fa-trash-o fa-lg"></i>
                     Delete</a>
                  </td>
               </tr>

               <!-- Modal detail -->

            @endforeach
         </tbody>
         </table>
      </div>

      Total Result {{ $stockmaterial->total() }}

      <div class="d-flex justify-content-center">
         {{ $stockmaterial->withQueryString()->links('pagination') }}
      </div>

      <!-- Modal add -->
      @include('material.modal_add_stock_material')

      <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>

      <script>
         document.getElementById("search_material_name").addEventListener("keypress", function(event) {
               if (event.key === "Enter") {
                  event.preventDefault();
                  form.submit();
               }
         });
      </script>

   </div>

@endsection