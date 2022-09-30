@extends('request_system.master_request')
@section('contents')

    <div>
        <h1 style="margin-bottom:2%">รายการคำร้องขอ Request Application</h1>
    </div>

    <div class="table-responsive">
            <table class="table table-bordered table-sm">
                @if(count($request_app) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <tr>
                        <th scope="col" class="align-top text-center">No</th>
                        <th scope="col" class="align-top">Subject</th>
                        <th class="align-top text-center" scope="col">Issued Date</th>
                        <th class="align-top text-center" scope="col">Manager Approve</th>
                        <th class="align-top text-center" scope="col">Chief Approve</th>
                        <th class="align-top text-center" scope="col">Charge</th>
                        <th class="align-top" scope="col">Edit</th>
                        <th class="align-top" scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    
                    @foreach($request_app as $key => $data)
                    <tr>
                        <td class="text-center">{{$request_app->firstItem() + $key}}</td>
                        <td>{{$data->req_app_subject}}</td>
                        <td class="text-center">
                            {{date("d-M-Y", strtotime($data->issued_date))}}
                        </td>
                        <td class="text-center" style="width:5%">

                        </td>
                        <td class="text-center" style="width:5%">
                            @php
                                $profile = App\Http\Controllers\RequestAppController::approveChiefUser($data->req_app_id, Cookie::get('employee_no'));
                            @endphp
                        </td>
                        <td class="text-center" style="width:5%">
                            @php
                                $profile = App\Http\Controllers\RequestAppController::approveUser($data->user_approve);
                            @endphp
                        </td>
                        <td>edit</td>
                        <td>delete</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $request_app->total() }}

        <div class="d-flex justify-content-center">
            {{ $request_app->withQueryString()->links('pagination') }}
        </div>
@endsection