@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Request Users</h1>
        </div>

        <div class="d-flex flex-row" style="margin-bottom:1%;">

            <div style="margin-bottom:2%;">
                <button class="btn btn-success mb-2" onclick="location.href='/listrequestuser/receieved'" >
                    <i class="fa fa-file-text-o" aria-hidden="true"></i> งานที่รับแล้ว
                </button>
                <button class="btn btn-primary mb-2" onclick="location.href='/listrequestuser/approve'" >
                    <i class="fa fa-calendar-check-o"></i> Approve
                </button>
            </div>


            <a href="" style="margin-left:auto" data-toggle="modal" data-target="#modalexportexcel"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></a>

        </div>

         <!-- Modal Export Excel -->

        <!-- table list request user -->
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                @if(count($request_user) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Request No.</th>
                        <th scope="col" class="text-center">Track Number</th>
                        <th scope="col" class="text-center">Name / Surname</th>
                        <th scope="col" class="text-center">Section</th>
                        <th scope="col" class="text-center">Subject</th>
                        <th scope="col" class="text-center">Detail</th>
                        <th scope="col" class="text-center">Charge</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Receive</th>
                        <th scope="col" class="text-center">PDF</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    
                    @foreach($request_user as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_user->firstItem() + $key}}</td>
                        <td class="text-center">{{$data->request_user_no}}</td>
                        <td>{{$data->track}}</td>
                        <td>{{$data->fullname}}</td>
                        <td class="text-center">{{$data->sect_name}}</td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::subjectRequestUser($data->subject)}}
                        </td>
                        <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#requestuserdt{{$data->no}}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Detail
                            </a>
                            @include('request_system.request_user.modal_detail_requestuser')
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\Controller::getName($data->charge)}}
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\RequestUserController::statusRequestUser($data->status_request_user)}}
                        </td>
                        <td class="text-center">
                            @if($data->status_request_user == 0)
                                <a href="/recieverequestuser/{{$data->no}}" class="recieve">
                                Receieve</a> 
                            @elseif($data->status_request_user >= 2)
                                <i class="fa fa-check-circle fa-lg text-success" aria-hidden="true"></i>
                            @endif  
                        </td>
                        <td class="text-center">
                            @if($data->status_request_user == 4)
                                <a href="/pdfrequestuser/{{$data->request_user_no}}"><i class="fa fa-file-pdf-o fa-lg text-danger" aria-hidden="true"></i></a>
                            @else
                                <i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i>
                            @endif
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $request_user->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_user->withQueryString()->links('pagination') }}
        </div>

        <script type="text/javascript" src="{{asset('scripts/receivenotifyrepair.js')}}"></script>
        
    </div>

@endsection