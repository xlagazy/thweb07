@extends('request_system.master_request')
@section('contents')
    <div class="table-responsive">
        <div style="margin-bottom:2%">
            <a href="/listrequestadmin">Request Admin</a> / Relate Section
        </div>
        <h2>Approve Relate Section</h2>
        <table class="table table-bordered table-sm">

            @if(count($request_admin) == 0)
                <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
            @endif
            <thead>
                <form action="{{URL::to('/listrequestadmin/approve/relatesect/search')}}" method="get" class="form-inline" id="form" style="margin-right:auto;">
                    <tr>
                        <th scope="col" class="align-top text-center" width="5%">No</th>
                        <th scope="col" class="align-top" width="15%">Track Number</th>
                        <th class="align-top text-center" scope="col" width="15%">Name / Surname</th>
                        <th class="align-top text-center" scope="col" width="5%">Section</th>
                        <th class="align-top text-center" scope="col" width="10%">Subject</th>
                        <th class="align-top text-center" scope="col" width="10%">Detail</th>
                        <th class="align-top text-center" scope="col" width="10%">Approve</th>
                    </tr>
                    <tr style="border-top: hidden;">
                        <th></th>
                        <th>
                        </th>
                        <th></th>
                        <th></th>
                        <th class="text-center">
                            
                        </th>
                        <th></th>
                        <th></th>
                    </tr>
                </form>
            </thead>

            <tbody id="myTable">
                
                @foreach($request_admin as $key => $data)
                    @if($data->user_manager != "")
                        @php 
                            $arr_relate_sect = json_decode($data->relate_sect);
                            if(isset($arr_relate_sect)){
                                $countsect = count($arr_relate_sect);
                            }else{
                                $countsect = 0;
                            }
                        @endphp

                        @for($i=0;$i<$countsect;$i++)
                            @if($arr_relate_sect[$i] == Cookie::get('section'))
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
                                            App\Http\Controllers\RequestAdminController::approveRequestAdminRelateSect($data->no, Cookie::get('employee_no'), $i);
                                        @endphp
                                    </td>
                                </tr>
                            @endif
                        @endfor
                    @endif
                @endforeach

            </tbody>
        </table>

        Total Result {{ $request_admin->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_admin->withQueryString()->links('pagination') }}
        </div>
    </div>
@endsection