<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Report Request User</title>

    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    @LaravelDompdfThaiFont

    <style>
        table, td, th {
            font-size:12px;
        }

        table {
            border-collapse: collapse;
        }
        .fontth{
            font-family:'THSarabunNEW';
        }
        .rectangle {
            height: 50px;
            width: 100px;
            background-color: #555;
        }
    </style>
</head>
<body>
    @foreach($request_admin as $data)
        
        <div style="float:right">
            <table style="border:1px solid black;">
                <tr>
                    <td style="text-align:center;width:80px;">
                        IT Control No.
                    </td>
                    <td style="text-align:center;width:80px;border:1px solid black;">
                        {{$data->request_admin_no}}
                    </td>
                </tr>
            </table>
        </div>

        <div>
            <h2 style="margin:3% 0 0 25%;">IT Section Request Sheet (Admim)</h2>
        </div>

        <table style="width:100%;border:1px solid black;border-bottom:0px;">
            <tr>
                <td style="width:50%;text-align:center;font-size:20px;" > <b>IT Section<b></td>
                <td class="fontth" style="width:25%;font-size:16px;text-align:center;border:1px solid black;border-bottom:0px;">
                    Requested Section (แผนกที่ร้องขอ)
                </td>
                <td style="text-align:center;width:25%;border:1px solid black;border-bottom:0px;">
                    {{$data->sect_name}}
                </td>
            </tr>
        </table>
        <table style="width:100%;border:1px solid black;border-bottom:0px;">
            <tr>
                <td style="width:25%;text-align:center;font-size:15px;" >Receive Date</td>
                <td style="text-align:center;width:25%;border:1px solid black;border-bottom:0px;">
                    {{date("d-M-Y", strtotime($data->start_date))}}
                </td>
                <td class="fontth" style="width:10%;text-align:center;">Issued Date (วันที่ส่งใบร้องขอ)</td>
                <td style="text-align:center;width:15%;border:1px solid black;border-bottom:0px;">
                    {{date("d-M-Y", strtotime($data->timestamp))}}
                </td>
                <td class="fontth" style="width:10%;text-align:center;border:1px solid black;border-bottom:0px;">Need Date (วันที่ต้องการ)</td>
                <td style="text-align:center;width:15%;">
                    {{date("d-M-Y", strtotime($data->need_date))}}
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:16.67%;text-align:center;border:1px solid black;border-bottom:0px;"><b>Manager</b></td>
                <td style="width:16.67%;text-align:center;border:1px solid black;border-bottom:0px;"><b>Chief</b></td>
                <td style="width:16.67%;text-align:center;border:1px solid black;border-bottom:0px;"><b>Charge</b></td>
                <td style="width:16.67%;text-align:center;border:1px solid black;border-bottom:0px;"><b>Manager</b></td>
                <td style="width:16.67%;text-align:center;border:1px solid black;border-bottom:0px;"><b>Chief</b></td>
                <td style="width:16.67%;text-align:center;border:1px solid black;border-bottom:0px;"><b>Charge</b></td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:16.67%;height:5%;text-align:center;border:1px solid black;border-bottom:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignaturemember($data->manager).'')}}"
                        style="width:60px;height:25px;"></img>
                </td>
                <td style="width:16.67%;height:5%;text-align:center;border:1px solid black;border-bottom:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignaturemember($data->chief).'')}}"
                        style="width:60px;height:25px;"></img>
                </td>
                <td style="width:16.67%;height:5%;text-align:center;border:1px solid black;border-bottom:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignaturemember($data->charge).'')}}"
                         style="width:60px;height:25px;"></img>
                </td>
                <td style="width:16.67%;height:5%;text-align:center;border:1px solid black;border-bottom:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignature($data->user_manager).'')}}"
                        style="width:60px;height:25px;"></img>
                </td>
                <td style="width:16.67%;height:5%;text-align:center;border:1px solid black;border-bottom:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignature($data->user_chief).'')}}"
                        style="width:60px;height:25px;"></img>
                </td>
                <td style="width:16.67%;height:5%;text-align:center;border:1px solid black;border-bottom:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignature($data->user_charge).'')}}"
                        style="width:60px;height:25px;"></img>
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="width:25%;font-size:16px;border:1px solid black;">Subject (โปรดระบุชื่องานที่ร้องขอ)</td>
                <td class="fontth" style="width:75%;font-size:16px;border:1px solid black;"> &nbsp;
                     {{$data->subject}}
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="width:50%;font-size:16px;text-align:center;border:1px solid black;border-top:0px;">Reason or Problem (เหตุผล หรือ งานปัจจุบันที่มีผลกระทบ)</td>
                <td class="fontth" style="width:50%;font-size:16px;text-align:center;border-right:1px solid black;">*** Only an outline, please attach details. (โปรดแนบรายละเอียด)</td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="vertical-align:top;font-size:16px;height:10%;border:1px solid black;border-top:0px;">
                    {{$data->reason}}
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="width:55%;font-size:16px;border:1px solid black;border-top:0px;">Reference document no.
                        <a style="font-size:11px;">(Ex. Notice No., Control No., User Claim, Audit, Project Name, 5S, KPI etc)=></a></td>
                <td class="fontth" style="width:45%;font-size:16px;border:1px solid black;border-top:0px;">  &nbsp;
                     {{$data->reference}}
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="width:50%;font-size:16px;text-align:center;border:1px solid black;border-top:0px;">Request Detail (รายละเอียดของงานที่ร้องขอ)</td>
                <td class="fontth" style="width:50%;font-size:16px;text-align:center;border-right:1px solid black;">*** Only an outline, please attach details. (โปรดแนบรายละเอียด)</td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="vertical-align:top;font-size:16px;height:10%;border:1px solid black;border-top:0px;">
                    {{$data->detail}}
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="width:45%;font-size:16px;text-align:center;border:1px solid black;border-top:0px;border-bottom:0px;">
                    *** Need Owner system confirm / related to Other section</td>
                <td class="fontth" style="width:15%;font-size:16px;">&nbsp;Section : 
                    @php
                        if($data->relate_sect != "null"){
                            $relate_sect = json_decode($data->relate_sect);
                            for($i=0; $i < count($relate_sect); $i++){
                                echo App\Http\Controllers\Controller::getSection($relate_sect[$i]);
                            }
                        }
                        else{
                            echo '-';
                        }
                    @endphp
                </td>
                <td class="fontth" style="width:40%;font-size:16px;border-right:1px solid black;">Sign : 
            
                @php
                    $sign = json_decode($data->relate_sect_approve);
                    $count = count($sign);
                @endphp
                @for($i=0; $i < $count; $i++)
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignature($sign [$i]).'')}}"
                    style="width:60px;height:25px;"></img>
                @endfor
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="width:50%;font-size:16px;text-align:center;border:1px solid black;">Request section Final Confirm (การยืนยันของแผนกที่ร้องขอหลังจากเสร็จงาน)</td>
                <td class="fontth" style="width:25%;font-size:16px;border:1px solid black;border-right:0px;">&nbsp;Name : 
                <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignature($data->user_confirm).'')}}"
                    style="width:60px;height:25px;"></img>
               </td>
                <td class="fontth" style="width:25%;font-size:16px;border:1px solid black;border-left:0px;">Date : {{date("d-M-Y", strtotime($data->date_user_confirm))}}</td>
            </tr>
        </table>

        <table style="width:100%;margin-top:1%;">
            <tr>
                <td class="fontth" style="font-size:20px;text-align:center;border:1px solid black;border-bottom:0px;">
                    <b>For "IT Section" ONLY (ส่วนนี้สำหรับแผนกควบคุมระบบคอมพิวเตอร์เท่านั้น)</b>
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:25%;font-size:16px;text-align:center;border:1px solid black;">Finished Date</td>
                <td style="text-align:center;width:25%;font-size:16px;border:1px solid black;">
                    {{date("d-M-Y", strtotime($data->end_date))}}
                </td>
                <td style="width:16.67%;font-size:16px;text-align:center;border:1px solid black;border-left:0px;">Manager </td>
                <td style="width:16.67%;font-size:16px;text-align:center;border:1px solid black;border-left:0px;">Chief </td>
                <td style="width:16.67%;font-size:16px;text-align:center;border:1px solid black;border-left:0px;">Charge </td>
            </tr>
            <tr>
                <td style="width:25%;font-size:16px;text-align:center;border:1px solid black;">Program install Date</td>
                <td style="width:25%;font-size:16px;text-align:center;border:1px solid black;">{{date("d-M-Y", strtotime($data->program_install_date))}}</td>
                <td rowspan="2" style="width:16.67%;font-size:12px;text-align:center;border:1px solid black;border-left:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignaturemember($data->end_manager).'')}}"
                        style="width:60px;height:25px;"></img>
                        <br>{{date("d-M-Y", strtotime($data->date_manger_confirm))}}
                </td>
                <td rowspan="2" style="width:16.67%;font-size:12px;text-align:center;border:1px solid black;border-left:0px;"> 
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignaturemember($data->end_chief).'')}}"
                        style="width:60px;height:25px;"></img>
                        <br>{{date("d-M-Y", strtotime($data->date_chief_confirm))}}
                </td>
                <td rowspan="2" style="width:16.67%;font-size:12px;text-align:center;border:1px solid black;border-left:0px;">
                    <img src="{{public_path('/images/signature_request/'.App\Http\Controllers\Controller::getSignaturemember($data->end_charge).'')}}"
                         style="width:60px;height:25px;"></img>
                         <br>{{date("d-M-Y", strtotime($data->date_charge_confirm))}}
                </td>
            </tr>
            <tr>
                <td style="width:25%;font-size:16px;text-align:center;border:1px solid black;">Yearly No.</td>
                <td style="width:25%;font-size:16px;text-align:center;border:1px solid black;">{{$data->yearly_no}}</td>
            </tr>
        </table>
        <table style="width:100%;margin-top:1%;">
            <tr>
                <td class="fontth" style="font-size:18px;text-align:center;border:1px solid black;border-bottom:0px;">
                    Kind of Request (ลักษณะ งานที่ร้องขอ)
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:20%;font-size:16px;border:1px solid black;border-bottom:0px;">
                    &nbsp;Users Control
                </td>
                <td style="width:15%;font-size:16px;border:1px solid black;border-bottom:0px;">
                    &nbsp;U: <img src="{{public_path('icons/unchecked.png')}}" 
                                style="width:20px;height:20px;margin-bottom:2%;margin-left:20%;vertical-align:bottom;"></img>
                </td>
                <td style="width:70%;font-size:16px;text-align:left;border:1px solid black;border-bottom:0px;">
                </td>
            </tr>
            <tr>
                <td style="width:20%;font-size:16px;border:1px solid black;border-bottom:0px;">
                    &nbsp;Web/App Control
                </td>
                <td style="width:15%;font-size:16px;border:1px solid black;border-bottom:0px;">
                    &nbsp;W: 
                        @if(strpos($data->request_admin_no, 'AW') !== false)
                            <img src="{{public_path('icons/checked.png')}}" 
                                style="width:20px;height:20px;margin-bottom:2%;margin-left:18%;vertical-align:bottom;"></img>
                        @else
                            <img src="{{public_path('icons/unchecked.png')}}" 
                                style="width:20px;height:20px;margin-bottom:2%;margin-left:16%;vertical-align:bottom;"></img>
                        @endif
                    
                </td>
                <td style="width:70%;font-size:16px;text-lift:center;border:1px solid black;border-bottom:0px;">
                        @if(strpos($data->request_admin_no, 'AW') !== false)
                            {{$data->kind_request}}
                        @endif
                </td>
            </tr>
            <tr>
                <td style="width:20%;font-size:16px;border:1px solid black;border-bottom:0px;">
                    &nbsp;Other...
                </td>
                <td style="width:15%;font-size:16px;border:1px solid black;border-bottom:0px;">
                    &nbsp;O: 
                        @if(strpos($data->request_admin_no, 'AO') !== false)
                            <img src="{{public_path('icons/checked.png')}}" 
                                  style="width:20px;height:20px;margin-bottom:2%;margin-left:20%;vertical-align:bottom;"></img>
                        @else
                            <img src="{{public_path('icons/unchecked.png')}}" 
                                  style="width:20px;height:20px;margin-bottom:2%;margin-left:20%;vertical-align:bottom;"></img>
                        @endif
                </td>
                <td style="width:70%;font-size:16px;text-lift:center;border:1px solid black;border-bottom:0px;">
                        @if(strpos($data->request_admin_no, 'AO') !== false)
                            {{$data->kind_request}}
                        @endif
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="height:12%;font-size:16px;border:1px solid black;border-bottom:0px;vertical-align:top;">
                    &nbsp;Job Details: 
                    <br> {{$data->end_detail}}
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td class="fontth" style="font-size:16px;text-align:right;border:1px solid black;border-top:0px;">
                    Time () Mins / Hrs / Days
                </td>
            </tr>
        </table>
        <table style="width:100%;">
            <tr>
                <td style="width:77%;border:0px;">
                    Rev.00: 1 Jan 2023
                </td>
                <td style="border:1px solid black;border-top:0px;">
                    Sheet no :   IT-NET-01 (F02-00)
                </td>
            </tr>
        </table>


    @endforeach

</body>
</html>