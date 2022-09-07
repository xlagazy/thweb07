@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <form action="{{URL::to('filterchecklist')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <b style="margin:5px;">Choose date : </b>
                <select name="check_date" class="form-control" style="width:15%" required>
                    @foreach($checkdate as $checkdated)
                        @if($checked == $checkdated->check_date)
                            <option value="{{$checkdated->check_date}}" selected>{{date("d-M-Y", strtotime($checkdated->check_date))}}</option>
                        @else
                            <option value="{{$checkdated->check_date}}">{{date("d-M-Y", strtotime($checkdated->check_date))}}</option>
                        @endif
                    @endforeach
                </select>

                <input type="submit" class="btn btn-primary" value="ค้นหา" style="margin-bottom:1%;margin-left:1%"> 
            </div>
        </form>

        <form action="{{URL::to('editchecklist')}}" method="post" enctype="multipart/form-data" class="frm needs-validation">

             {{ csrf_field() }}

            <div class="row">

                <button type="button" class="btn btn-success add_checklist" data-toggle="modal" data-target="#addmodal" style="margin-bottom:1%;margin-left:1%;">
                    เช็คเวลาทำงาน       
                </button>

            </div>
            
            <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">Employees Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Sub</th>
                    <th scope="col">Status</th>
                    <th scope="col">Temperature</th>
                </tr>
            </thead>
            <tbody>
            @foreach($member as $members)

                @if(isset($members->check_id))
                    <input type = "hidden" name = "check_id[]" value = "<?php echo $members->check_id; ?>" >
                @endif
                <input type = "hidden" name = "user_id[]" value = "<?php echo $members->user_id; ?>" >
                
                <tr>
                    <th scope="row">{{$members->employees_no}}</th>
                    <td>{{$members->name}}</td>
                    <td>{{$members->sub_it_name}}</td>
                    <td>

                        <select name="status[]" class="form-control" required>
                        @foreach($status as $statused)
                            @if(isset($members->status))
                                @if($statused->status_id == $members->status)
                                    <option value="{{$statused->status_id}}" selected>{{$statused->status_name}}</option>
                                @else
                                    <option value="{{$statused->status_id}}">{{$statused->status_name}}</option>
                                @endif
                            @else
                                <option value="{{$statused->status_id}}">{{$statused->status_name}}</option>
                            @endif 
                        @endforeach

                        
                        <div class="invalid-feedback">Please choose data</div>
                    </td>
                    <td style="width:15%">
                        @if(isset($members->temperature))
                            <input type="text" name="tempe[]" class="form-control" value="{{$members->temperature}}" placeholder="Temperature" >
                        @else
                            <input type="text" name="tempe[]" class="form-control" placeholder="Temperature" >
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>

            </table>
        </form>

        <script type="text/javascript" src="{{asset('scripts/addchecklist.js')}}"></script>

    </div>
 @endsection