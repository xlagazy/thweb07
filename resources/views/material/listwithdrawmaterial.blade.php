@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

   <div class="ct_listuser">

      <div>
         <a href="{{URL::to('listwithdrawmaterial')}}" class="text-decoration-none text-dark">
            <h1 style="margin-bottom:2%">Withdraw Material</h1>
         </a>
      </div>

      <!-- Get value to addborrow.js file -->
      <script>

        var stockmaterial = <?php echo json_encode($stockmaterial); ?>;

      </script>

      <div class="d-flex flex-row" style="margin-bottom:1%;">
         <!-- Button trigger modal -->
         <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
            เบิก Material      
         </button>

         <!-- Button trigger modal sum stock -->
         <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#modalsumstock" style="margin-left:0.5%;">
               Stock
         </button>

         @include('material.modal_sum_material')
      </div>
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
         <table class="table table-bordered table-sm">
            @if(count($withdrawmaterial) == 0)
               <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
         <thead>
               <tr>
                  <th scope="col" class="align-top" style="text-align:center;">No</th>
                  <th scope="col" class="align-top" style="text-align:center;">Material Name</th>
                  <th scope="col" class="align-top" style="text-align:center;">Withdraw QTY</th>
                  <th scope="col" class="align-top" style="text-align:center;">Remark</th>
                  <th scope="col" class="align-top" style="text-align:center;">Output Date</th>
                  <th scope="col" class="align-top" style="text-align:center;">Details</th>
               </tr>
               <form action="{{URL::to('listwithdrawmaterial/search')}}" method="get" id="form" class="form-inline" style="margin-right:auto;">
                  <tr style="border-top: hidden;">
                     <th></th>
                     <th style="text-align:center;">
                        <input type="text" name="search_material_name" value="{{$search_material_name}}" placeholder="Search" style="width:100%;">
                     </th>
                     <th></th>
                     <th></th>
                     <th style="text-align:center;">
                        <input type="date" name="date" value="{{$date}}" onchange="this.form.submit()" style="width:100%;">
                     </th>
                     <th></th>
                  </tr> 
               </form>
         </thead>
         <tbody>

            @foreach($withdrawmaterial as $key => $withdrawmaterials)

               <tr>
                  <td style="text-align:center;">{{$key+1}}</td>
                  <td data-toggle="modal" data-target="#detail">{{$withdrawmaterials->material_name}}</td>
                  <td style="text-align:center;">{{$withdrawmaterials->sumqty}}</td>
                  <td>{{$withdrawmaterials->remark}}</td>
                  <td style="text-align:center;">{{date("d-M-Y", strtotime($withdrawmaterials->out_date))}}</td>
                  <td style="text-align:center;">
                     <a href="/listdetailwithdrawmaterial/{{$withdrawmaterials->withdraw_material_no}}" style="color:#00FF0F;">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                        Details</a>
                  </td>
               </tr>

               <!-- Modal detail -->

            @endforeach
         </tbody>
         </table>
      </div>

      Total Result {{ $withdrawmaterial->total() }}

      <div class="d-flex justify-content-center">
         {{ $withdrawmaterial->withQueryString()->links('pagination') }}
      </div>

      <!-- Modal add -->
      @include('material.modal_add_withdraw_material')

      <script type="text/javascript" src="{{asset('scripts/withdrawmaterial.js')}}"></script>      
      
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