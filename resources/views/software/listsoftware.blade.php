@if(session()->get('user_id') == "")
   <script>window.location = "/login";</script>
@endif
@extends('index')
@section('contents')

    <div class="ct_listuser">

        <div>
            <h1 style="margin-bottom:2%">Software</h1>
        </div>

        <div class="d-flex flex-row" style="margin-bottom:1%;">
        
            <form form action="{{URL::to('')}}" method="get" class="form-inline" style="margin-right:auto;">
                <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
                <table>
                    <tr>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addmodal" style="margin-left:5%;width:100%;">
                            เพิ่ม Software
                        </button>

                    </td>
                    </tr>
                </table> 
            </form>

            <button type="button" style="padding: 0;border: none;background: none;" class="export"><img src="/images/icons/excel.png" style="width:40px;height:40px;"></button>

        </div>

        <!-- table list eqmuipment -->
        <div class="table-responsive">
            <table id="datatable" class="table table-hover table-dark table-sm" style="width:100%;">
                @if(count($software) == 0)
                    <caption style="text-align:center;border:1px solid;"><h4>Not found data</h4></caption>
                @endif
                <thead>
                    <tr>
                        <th scope="col" style="text-align:center;">No</th>
                        <th scope="col">Software Nmae</th>
                        <th scope="col">Softeware Version</th>
                        <th scope="col">Key License</th>
                        <th scope="col">Software Type</th>
                        <th scope="col">Platform</th>
                        <th scope="col">Used License</th>
                        <th scope="col">Max License</th>
                        <th scope="col">Expire</th>
                        <th scope="col">Charge</th>
                        <th scope="col" >Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="myTable">

                @foreach($software as $key => $softwares)
                    <tr>
                        <td style="text-align:center;">{{$key+1}}</td>
                        <td>{{$softwares->software_name}}</td>
                        <td>{{$softwares->software_version}}</td>
                        <td>{{$softwares->key_license}}</td>
                        <td>{{$softwares->software_type_name}}</td>
                        <td>{{$softwares->platform_name}}</td>
                        <td>{{$softwares->used_license}}</td>
                        <td>{{$softwares->max_license}}</td>
                        <td>
                            @php
                                $start_date = strtotime(date('d-M-Y'));
                                $end_date = strtotime($softwares->end_date);
                                $days = (int) (($end_date - $start_date)/86400);
                                if($days < 0){
                                    echo "<p style='background-color:red;text-align:center;'>expire</p>";
                                }
                                else{
                                    echo $days.' day';
                                }

                            @endphp
                        </td>
                        <td>{{$softwares->name}}</td>
                        <td>
                            <a href="" data-toggle="modal" data-target="#edtmodal{{$softwares->software_no}}">
                            <i class="fa fa-pencil-square-o fa-lg"></i>
                            Edit</a>

                            @include('software.modal_edit_software');
                        </td>
                        <td>
                            <a href="deletesoftware/{{$softwares->software_no}}" class="dlt_user" style="color:red;">
                            <i class="fa fa-trash-o fa-lg"></i>
                            Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        Total Result {{ $software->total() }}

        <div class="d-flex justify-content-center">
            {{ $software->withQueryString()->links('pagination') }}
        </div>

        <!-- Modal add -->
        @include('software.modal_add_software')

        <script type="text/javascript" src="{{asset('scripts/adduser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/edituser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/deleteuser.js')}}"></script>
        <script type="text/javascript" src="{{asset('scripts/exportsoftware.js')}}"></script>
        
    </div>

@endsection