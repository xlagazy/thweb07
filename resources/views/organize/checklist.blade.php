@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <form action="{{URL::to('addchecklist')}}" method="post" id="frm" name="frm" enctype="multipart/form-data" class="frm needs-validation">

             {{ csrf_field() }}

            <div class="row">

                    <b style="margin:5px;">Choose date : </b>
                    <input type="date" name="checkdate"  class="form-control" value="<?php echo date('Y-m-d'); ?>" style="width:15%; margin-right:1%" required />
                    <div class="invalid-feedback">Please choose date</div>

                    <button type="button" class="btn btn-success add_checklist" data-toggle="modal" data-target="#addmodal" style="margin-bottom:1%">
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
                <input type = "hidden" name = "user_id[]" value = "<?php echo $members->user_id; ?>" >
                <tr>
                    <th scope="row">{{$members->employees_no}}</th>
                    <td>{{$members->name}}</td>
                    <td>{{$members->sub_it_name}}</td>
                    <td>
                        <select name="status[]" class="form-control" required>
                            @foreach($status as $statused)
                                <option value="{{$statused->status_id}}">{{$statused->status_name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please choose data</div>
                    </td>
                    <td style="width:15%">
                        <input type="text" name="tempe[]" class="form-control" placeholder="Temperature" >
                    </td>
                </tr>
            @endforeach
            </tbody>

            </table>
        </form>

        <script type="text/javascript" src="{{asset('scripts/addchecklist.js')}}"></script>

    </div>
 @endsection