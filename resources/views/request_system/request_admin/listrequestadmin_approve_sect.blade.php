@extends('request_system.master_request')
@section('contents')
    <div class="table-responsive">
        <div style="margin-bottom:2%">
            <a href="/listrequestadmin">Request Admin</a> / Approve Section
        </div>
        <h2>Approve Section</h2>
        <table class="table table-bordered table-sm">

            @if(count($request_admin) == 0)
                <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
            <thead>
                <form action="{{URL::to('/listrequestuser/approve/section/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                    <tr>
                        <th scope="col" class="align-top text-center" width="5%">No</th>
                        <th scope="col" class="align-top" width="15%">Track Number</th>
                        <th class="align-top text-center" scope="col" width="15%">Name / Surname</th>
                        <th class="align-top text-center" scope="col" width="5%">Section</th>
                        <th class="align-top text-center" scope="col" width="10%">Subject</th>
                        <th class="align-top text-center" scope="col" width="10%">Detail</th>
                        <th class="align-top text-center" scope="col" width="10%">Relate Section</th>
                        <th class="align-top text-center" scope="col" width="10%">Manager</th>
                        <th class="align-top text-center" scope="col" width="10%">Chief</th>
                        <th class="align-top text-center" scope="col" width="10%">Charge</th>
                    </tr>
                    <tr style="border-top: hidden;">
                        <th></th>
                        <th class="text-center">
                        </th>
                        <th></th>
                        <th></th>
                        <th class="text-center">
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </form>
            </thead>

            <tbody id="myTable">
                @foreach($request_admin as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_admin->firstItem() + $key}}</td>
                        <td>{{$data->track}}</td>
                        <td>
                            {{$data->name}} {{$data->surname}}
                        </td>
                        <td class="text-center">
                            {{$data->sect_name}}
                        </td>
                        <td class="text-center">
                            {{$data->subject}}
                        </td>
                        <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#requestadmindt{{$data->no}}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Detail
                            </a>
                            @include('request_system.request_admin.modal_detail_requestadmin')
                        </td>
                        <td class="text-center">
                            @php
                                $relate_sect = json_decode($data->relate_sect);
                                $relate_sect_approve = json_decode($data->relate_sect_approve);
                                if(isset($relate_sect)){
                                    $count = count($relate_sect);
                                }
                                else{
                                    $count = 0;
                                }

                                if($count == 0){
                                    echo "None";
                                }
                                else{
                                    for($i=0;$i<$count;$i++){
                                        echo $i+1;
                                        echo '. ';
                                        echo App\Http\Controllers\Controller::getSection($relate_sect[$i]);
                                        echo ' : ';
                                        if(isset($relate_sect_approve[$i])){
                                            if($relate_sect_approve[$i] == 0){
                                                echo '<label class="text-danger">Wait approve</label><br>';
                                            }
                                            else{
                                                echo '<label class="text-success">Approved</label><br>';
                                            }
                                        }
                                    }
                                }
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestAdminController::approveRequestAdminSectManager($data->no, Cookie::get('employee_no'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestAdminController::approveRequestAdminSectChief($data->no, strval(Cookie::get('employee_no')));
                            @endphp
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\Controller::getNameAD($data->user_charge)}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        Total Result {{ $request_admin->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_admin->withQueryString()->links('pagination') }}
        </div>
    </div>
@endsection