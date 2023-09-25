@extends('request_system.master_request')
@section('contents')
    <div class="table-responsive">
        <div style="margin-bottom:2%">
            <a href="/listrequestuser">Request User</a> / Approve Section
        </div>
        <h2>Approve Section</h2>
        <table class="table table-bordered table-sm">

            @if(count($request_user) == 0)
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
                            <input type="text" name="search_track_no" id="search_track_no" value="{{$search_track_no}}" size="12" placeholder="Search">
                        </th>
                        <th></th>
                        <th></th>
                        <th class="text-center">
                            <select name="search_subject" style="height:30px;" onchange="this.form.submit()">
                                    <option  selected value="">Subject...</option>
                                    @if($search_subject == 0)
                                        <option value="0" selected>Add</option>
                                    @else
                                        <option value="0">Add</option>
                                    @endif
                                    @if($search_subject == 1)
                                        <option value="1" selected>Delete</option>
                                    @else
                                        <option value="1">Delete</option>
                                    @endif
                                    @if($search_subject == 2)
                                        <option value="2" selected>Change</option>
                                    @else
                                        <option value="2">Change</option>
                                    @endif
                            </select>
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
                @foreach($request_user as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_user->firstItem() + $key}}</td>
                        <td>{{$data->track}}</td>
                        <td>
                            @php
                                $arrPrefix = json_decode($data->prefix);
                                $arrName = json_decode($data->name_user);
                                $arrSurName = json_decode($data->surname_user);
                                $count = count($arrName);
                            @endphp

                            @for($i=0;$i<$count;$i++)
                                {{App\Http\Controllers\RequestUserController::getPrefix($arrPrefix[$i])}}{{$arrName[$i]}} {{$arrSurName[$i]}}
                            @endfor
                        </td>
                        <td class="text-center">
                            {{$data->sect_name}}
                        </td>
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
                                App\Http\Controllers\RequestUserController::approveRequestUserSectManager($data->no, Cookie::get('employee_no'));
                            @endphp
                        </td>
                        <td class="text-center">
                            @php
                                App\Http\Controllers\RequestUserController::approveRequestUserSectChief($data->no, strval(Cookie::get('employee_no')));
                            @endphp
                        </td>
                        <td class="text-center">
                            {{App\Http\Controllers\Controller::getNameAD($data->user_charge)}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        Total Result {{ $request_user->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_user->withQueryString()->links('pagination') }}
        </div>
    </div>
@endsection