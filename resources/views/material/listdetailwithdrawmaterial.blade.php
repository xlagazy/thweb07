@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

   <div class="ct_listuser">

      <div>
         <h1 style="margin-bottom:2%">Detail Withdraw Material</h1>
      </div>

      <!-- Get value to addborrow.js file -->
      <script>

        var stockmaterial = <?php echo json_encode($stockmaterial); ?>;

      </script>

      <div class="d-flex flex-row" style="margin-bottom:1%;">

         <div style="margin-right:auto;">
            <table>
               <tr>
                  <td>
                     <a href="/listwithdrawmaterial">Withdraw Material</a> / 
                  </td>
                  <td class="text-muted">
                     Detail Withdraw Material   
                  </td>
               </tr>
            </table> 
         </div>
            
      </div>
      
      <!-- table list eqmuipment -->
      <div class="table-responsive">
         <table class="table table-bordered table-sm">
            @if(count($withdrawmaterial) == 0)
               <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
         <thead>
               <tr>
                  <th scope="col" style="text-align:center">No</th>
                  <th scope="col" style="text-align:center;">Material Name</th>
                  <th scope="col" style="text-align:center;">Withdraw QTY</th>
                  <th scope="col" style="text-align:center;">Input Stock Date</th>
                  <th scope="col" style="text-align:center;">Out Date</th>
                  <th scope="col" style="text-align:center;">Charge</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Delete</th>
               </tr>
         </thead>
         <tbody>

            @foreach($withdrawmaterial as $key => $withdrawmaterials)

               <tr id="$key">
                  <td style="text-align:center;">{{$key+1}}</td>
                  <td data-toggle="modal" data-target="#detail">{{$withdrawmaterials->material_name}}</td>
                  <td style="text-align:center;">{{$withdrawmaterials->withdraw_material_qty}}</td>
                  <td style="text-align:center;">{{date("d-M-Y", strtotime($withdrawmaterials->input_date))}}</td>
                  <td style="text-align:center;">{{date("d-M-Y", strtotime($withdrawmaterials->out_date))}}</td>
                  <td style="text-align:center;">{{$withdrawmaterials->name}}</td>
                  <td style="display:none">{{$withdrawmaterials->material_no}}</td>
                  <td style="display:none">{{$withdrawmaterials->withdraw_material_no}}</td>
                  <td style="display:none">{{$withdrawmaterials->withdraw_material_qty}}</td>
                  <td style="display:none">{{$withdrawmaterials->stock_material_no}}</td>
                  <td style="display:none">{{$withdrawmaterials->withdraw_material_detail_no}}</td>
                  <td style="display:none">{{$withdrawmaterials->remark}}</td>
                  <td>
                     <a href="" data-toggle="modal" data-target="#edtwithdrawmaterial" class="editwithdraw">
                     <i class="fa fa-pencil-square-o fa-lg"></i>   
                     Edit</a>

                     @include('material.modal_edit_withdraw_material')
                  </td>
                  <td>
                     <a href="/deletewithdrawmaterial/{{$withdrawmaterials->withdraw_material_detail_no}}/{{$withdrawmaterials->withdraw_material_no}}" class="dlt_user" style="color:red;">
                     <i class="fa fa-trash-o fa-lg"></i>
                     Delete</a>
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
      <script type="text/javascript" src="{{asset('scripts/editwithdrawmaterial.js')}}"></script>        
      <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
      <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>

   </div>

@endsection