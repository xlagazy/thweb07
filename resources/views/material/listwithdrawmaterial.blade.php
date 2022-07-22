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
         <form form action="{{URL::to('listwithdrawmaterial/search')}}" method="get" class="form-inline" style="margin-right:auto;">
            <div style="margin-right:auto;">
               <table>
                  <tr>
                     <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal">
                           เบิก Material      
                        </button>

                        <!-- Button trigger modal sum stock -->
                        <button type="button" class="btn btn-danger mb-2" data-toggle="modal" data-target="#modalsumstock">
                              Stock
                        </button>

                        @include('material.modal_sum_material')
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
                              <input type="date" name="date" value="{{$date}}" class="form-control">
                           </div>
                        </td>
                        <td>
                           <input type="submit" value="ค้นหา" class="btn btn-primary mb-2">
                        </td>
                     </tr>
               </table> 
            </div>
         </form>
      </div>
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
         <table class="table table-hover table-dark table-sm" id="withdrawtable" style="width:100%;">
            @if(count($withdrawmaterial) == 0)
               <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
         <thead>
               <tr>
                  <th scope="col" style="text-align:center;">No</th>
                  <th scope="col" style="text-align:center;">Material Name</th>
                  <th scope="col" style="text-align:center;">Withdraw QTY</th>
                  <th scope="col" style="text-align:center;">Remark</th>
                  <th scope="col" style="text-align:center;">Output Date</th>
                  <th scope="col" style="text-align:center;">Details</th>
               </tr>
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

   </div>

@endsection