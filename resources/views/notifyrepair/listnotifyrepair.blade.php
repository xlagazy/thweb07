@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">รายการแจ้งซ่อม</h1>
        </div>
        
        <div class="d-flex flex-row" style="margin-bottom:1%;">
        
            <form action="{{URL::to('searchnotirepair')}}" method="get" class="form-inline" style="margin-right:auto;">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <table>
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

        <!-- table list notify repair -->
        <div class="table-responsive">
            <table class="table table-hover table-dark">
                @if(count($notirepair) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center;">No</th>
                        <th scope="col">Track</th>
                        <th scope="col">Detail</th>
                        <th scope="col">Notify Subject</th>
                        <th scope="col">Name</th>
                        <th scope="col">Section</th>
                        <th scope="col">Location</th>
                        <th scope="col">Tel</th>
                        <th scope="col">Date</th>
                        <th scope="col">Charge</th>
                        <th scope="col" style="text-align:center;">Status</th>
                        <th scope="col" style="text-align:center;">Recieve</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    
                    @foreach($notirepair as $key => $notirepairs)
                    <tr>
                        <td style="text-align:center;">{{$notirepair->firstItem() + $key}}</td>
                        <td>{{$notirepairs->track}}</td>
                        <td style="color:#0B7DF7;max-width: 200px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                            <a href="" data-toggle="modal" data-target="#dtmodal{{$notirepairs->noti_repair_no}}" style="color:lightblue;">
                                {{$notirepairs->detail}} >>
                            </a> 

                            @include('notifyrepair.modal_detail_notifyrepair')
                        </td>
                        <td>{{$notirepairs->noti_subject_name}}</td>
                        <td>{{$notirepairs->name_user}}</td>
                        <td>{{$notirepairs->sect_name}}</td>
                        <td>{{$notirepairs->location}}</td>
                        <td>{{$notirepairs->tel}}</td>
                        <td>{{date("d-M-Y", strtotime($notirepairs->date))}}</td>
                        <td>{{$notirepairs->name}}</td>
                        <td>
                            @if($notirepairs->status_noti_repair == 1)
                                <p class="bg-primary" style="text-align:center;"><b>รับงาน</b></p>
                            @elseif($notirepairs->status_noti_repair == 2)
                                <p class="bg-secondary" style="text-align:center;"><b>ขอใบ Request</b></p>
                            @elseif($notirepairs->status_noti_repair == 3)
                                <p class="bg-warning " style="text-align:center;color:black;"><b>กำลังดำเนินการ</b></p>
                            @elseif($notirepairs->status_noti_repair == 4)
                                <p class="bg-success" style="text-align:center;"><b>เสร็จสิ้น</b></p>
                            @else
                                <p class="bg-danger" style="text-align:center;"><b>ยังไม่ได้รับงาน</b></p>
                            @endif
                        </td>
                        <td style="text-align:center;">
                            @if($notirepairs->status_noti_repair == 0)
                                <a href="/addrecievenotifyrepair/1/{{$notirepairs->noti_repair_no}}" style="color:#00FF0F;" class="recieve">
                                Receieve</a> /
                                <a href="/addrecievenotifyrepair/2/{{$notirepairs->noti_repair_no}}" style="color:#FA3630;" class="no_recieve">
                                No Receieve</a>
                            @elseif($notirepairs->status_noti_repair == 1)
                                <p>Receieved</p>
                            @elseif($notirepairs->status_noti_repair == 2)
                                <p>No Receieved</p>
                            @endif  
                            <!-- <a href="" style="color:#ffc107" data-toggle="modal" data-target="#upmodal{{$notirepairs->noti_repair_no}}">
                            <i class="fa fa-pencil fa-lg"></i>
                            Update</a>

                            @include('notifyrepair.modal_update_notifyrepair');-->
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $notirepair->total() }}

        <div class="d-flex justify-content-center">
            {{ $notirepair->withQueryString()->links('pagination') }}
        </div>

        <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/exportdata.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/receivenotifyrepair.js')}}"></script>
        
    </div>

@endsection