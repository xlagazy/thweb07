@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')
   <div class="dash">

   <div class="row">
      <div class="col-6">
         @include('home.dash_equipment')
      </div>

      <div class="col-6">
         @include('home.dash_stock')
      </div>
   </div>

   @include('home.dash_borrow')

@endsection