@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Request Admin</h1>
        </div>

        <div class="d-flex flex-row" style="margin-bottom:1%;">

            <div style="margin-bottom:2%;">
                <button class="btn btn-success mb-2" onclick="location.href='/listrequestadmin/receieved'" >
                    <i class="fa fa-file-text-o" aria-hidden="true"></i> งานที่รับแล้ว
                </button>
                <button class="btn btn-primary mb-2" onclick="location.href='/listrequestadmin/approve'" >
                    <i class="fa fa-calendar-check-o"></i> Approve
                </button>
            </div>


            <!-- <a href="" style="margin-left:auto" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>-->

        </div>

         <!-- Modal Export Excel -->

        <!-- table list request user -->
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                @if(count($request_admin) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <form action="{{URL::to('/listrequestuser/it/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Request No.</th>
                            <th scope="col" class="text-center">Track Number</th>
                            <th scope="col" class="text-center">Name / Surname</th>
                            <th scope="col" class="text-center">Section</th>
                            <th scope="col" class="text-center">Subject</th>
                            <th scope="col" class="text-center">Need date</th>
                            <th scope="col" class="text-center">Detail</th>
                            <th scope="col" class="text-center">Charge</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Receive</th>
                            <th scope="col" class="text-center">PDF</th>
                        </tr>
                        <tr style="border-top: hidden;">
                            <th></th>
                            <th>
                            </th>
                            <th>
                            </th>
                            <th></th>
                            <th>
                            </th>
                            <th>
                            </th>
                            <th>
                            </th>
                            <th></th>
                            <th>
                            </th>
                            <th>
                            </th>
                            <th></th>
                            <th></th>
                        </tr>
                    </form>
                </thead>
                <tbody id="myTable">
                    
                @foreach($request_admin as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_admin->firstItem() + $key}}</td>
                        <td class="text-center">{{$data->request_admin_no}}</td>
                        <td>{{$data->track}}</td>
                        <td>
                            {{$data->name}} {{$data->surname}}
                        </td>
                        <td class="text-center">{{$data->sect_name}}</td>
                        <td class="text-center">
                            {{$data->subject}}
                        </td>
                        <td>
                            {{date('d-M-Y', strtotime($data->need_date))}}
                        </td>
                        <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#requestadmindt{{$data->no}}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Detail
                            </a>
                            @include('request_system.request_admin.modal_detail_requestadmin')
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\Controller::getName($data->charge)}}
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::statusRequestUser($data->status_request_admin)}}
                        </td>
                        <td class="text-center">
                            @if(session()->get('position') == 1 || session()->get('position') == 2)
                                @if($data->charge == "" && $data->status_request_admin == 2)
                                    <div>
                                        <a href="" data-toggle="modal" data-target="#receiverequest{{$data->no}}">Receive</a>
                                        @include('request_system.request_admin.modal_receive_requestadmin')
                                    </div>
                                    <div>
                                        <a href="" data-toggle="modal" data-target="#refuserequest{{$data->no}}" class="text-danger">Refuse</a>
                                        @include('request_system.request_admin.modal_refuse_requestadmin')
                                    </div>             
                                @elseif($data->charge != "" && $data->status_request_admin == 2)
                                    <i class="fa fa-pencil-square fa-lg text-info" aria-hidden="true"></i>   
                                @elseif($data->status_request_admin >= 8)
                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>          
                                @elseif($data->status_request_admin >= 3)
                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>
                                @endif
                            @else
                                @if($data->charge == "" && $data->status_request_admin == 2)
                                    <i class="fa fa-pencil-square fa-lg text-info" aria-hidden="true"></i>
                                @elseif($data->charge != "" && $data->status_request_admin == 2)
                                    <i class="fa fa-pencil-square fa-lg text-info" aria-hidden="true"></i>
                                @elseif($data->status_request_admin >= 8)
                                    <i class="fa fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                @elseif($data->status_request_admin >= 3)
                                    <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>
                                @endif  
                            @endif
                            
                        </td>
                        <td class="text-center">
                            @if($data->status_request_admin == 7)
                                <a href="/pdfrequestadmin/{{$data->request_admin_no}}"><i class="fa fa-file-pdf-o fa-lg text-danger" aria-hidden="true"></i></a>
                            @else
                                <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $request_admin->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_admin->withQueryString()->links('pagination') }}
        </div>

        <script type="text/javascript" src="{{asset('scripts/receivenotifyrepair.js')}}"></script>
        
    </div>

@endsection