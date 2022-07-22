@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

   <div class="ct_listuser">

      <div>
         <a href="{{URL::to('listmaterial')}}" class="text-decoration-none text-dark"><h1 style="margin-bottom:2%">Material</h1></a>
      </div>

      <div class="d-flex flex-row" style="margin-bottom:1%;">

         <div style="margin-right:auto;">
            <form form action="{{URL::to('listmaterial/search')}}" method="get" class="form-inline" style="margin-right:auto;">
               <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
               <table>
                  <tr>
                     <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
                              เพิ่ม Material      
                        </button>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="form-group mb-2">
                           <input type="text" name="search" class="form-control" placeholder="Search">
                        </div>
                     </td>
                     <td>
                        <input type="submit" value="ค้นหา" class="btn btn-primary mb-2" style="margin:0 2% 0 2%">
                     </td>
                  </tr>
               </table>
            </form>
         </div>
            
         <!-- <a href="" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a> -->

      </div>
      

      <!-- Modal Export Excel -->
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
         <table class="table table-hover table-dark table-sm" style="width:100%;">
            @if(count($material) == 0)
               <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
         <thead>
               <tr>
                  <th scope="col">No</th>
                  <th scope="col">Material Number</th>
                  <th scope="col">Material Name</th>
                  <th scope="col" >Edit</th>
                  <th scope="col">Delete</th>
               </tr>
         </thead>
         <tbody id="myTable">

            @foreach($material as $key => $materials)

               <tr id="$key">
                  <td style="text-align:center;">{{$key+1}}</td>
                  <td data-toggle="modal" data-target="#detail">{{$materials->material_no}}</td>
                  <td>{{$materials->material_name}}</td>
                  <td>
                        <a href="" data-toggle="modal" data-target="#edtmat{{$materials->material_no}}">
                        <i class="fa fa-pencil-square-o fa-lg"></i>
                        Edit</a>

                        <!-- Modal Edit -->
                        @include('material.modal_edit_material')
                  </td>
                  <td>
                     <a href="/deletematerial/{{$materials->material_no}}" class="dlt_user" style="color:red;">
                     <i class="fa fa-trash-o fa-lg"></i>
                     Delete</a>
                  </td>
               </tr>

               <!-- Modal detail -->

            @endforeach
         </tbody>
         </table>
      </div>

      Total Result {{ $material->total() }}

      <div class="d-flex justify-content-center">
         {{ $material->withQueryString()->links('pagination') }}
      </div>

      <!-- Modal add -->
      @include('material.modal_add_material')

      <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>
      <script type="text/javascript" src="{{asset('searchequipment.js')}}"></script>

   </div>

@endsection