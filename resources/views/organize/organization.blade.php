<!DOCTYPE html>
<html>
<head>
    <title>IT Sect</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="/styles.css">
    <link type="text/css" rel="stylesheet" href="/stylesipad.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">
    
    <!-- Scripts -->
    <script src="/scripts/jquery-3.5.1.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/sweetalert2/dist/sweetalert2.min.js"></script>
        
</head>
<body>
<div style="padding:15px 15px 0; background-color: #fff;">
<div class="ct_organize">
        <div class="row">
            <div class="col">
                <img src="images/icons/itorganize.png" style="width:60%">
                <h3 style="margin-top:2%;">วันที่ {{date('d-M-Y')}}</h3>
            </div>
            <div class="col">
            </div>
            <div class="col" style="text-align:right;margin-right:5%;">
                <img src="images/icons/5s.png" style="width:40%">
            </div>
        </div>

        @if(!empty($member))
            <div class="row justify-content-center" style="margin-bottom:1%">
                <div class="col-1.5">
                    <h2 style="text-shadow: 2px 2px 5px red;">Manager</h2>
                </div>
            </div>
        @endif
        
        <!-- Manager -->

        <div class="row justify-content-center">
            <div class="col-1.5">
                @foreach($member as $members)
                    @if($members->position_name == "Manager")
                    <div class="carduser">

                        @if($members->status != 1 && $members->status != 4 && $members->status != 5 && $members->status != 6)
                            <img src="images/{{$members->image}}" class="rounded" style="width:80px;height:100px; box-shadow: 0 0 4px 4px red;" >
                        @else
                            <img src="images/{{$members->image}}" class="rounded" style="width:80px;height:100px; box-shadow: 0 0 4px 4px #1FFA09;" >
                        @endif

                        <table style="font-size:0.6vw;">
                            <tr>
                                <td style="text-align:right;">Name : </td>
                                <td style="text-align:left;">{{$members->name}}</td>
                            <tr>
                            <tr>
                                <td style="text-align:right;">Position : </td>
                                <td style="text-align:left;">{{$members->position_name}}</td>
                            <tr>
                            <tr>
                                <td style="text-align:right;">Ext : </td>
                                <td style="text-align:left;">{{$members->tel}}</td>
                            <tr>
                            <tr>
                                <td style="text-align:right;">Status : </td>
                                @if($members->status != 1)
                                    <td style="text-align:left; color:red;">{{$members->status_name}}</td>
                                @else
                                    <td style="text-align:left;">{{$members->status_name}}</td>
                                @endif
                            <tr>
                        </table>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

         @if(empty($member))
             <div style="color:#D1D3D1; margin-top:5%;">
                 <img src="images/icons/no data.png"style="width:5%; height:8%;">
                 <h1>ไม่มีข้อมูลการทำงาน</h1>
            </div>
        @endif

        @if(!empty($member))
            <div class="row" style="margin-bottom:2%">
                <div class="col-6 col-md-4">
                    <h2 style="text-shadow: 2px 2px 5px red;">Developer 1</h2>
                </div>
                <div class="col-6 col-md-4">
                    <h2 style="text-shadow: 2px 2px 5px red;">Developer 2</h2>
                </div>
                <div class="col-6 col-md-4">
                    <h2 style="text-shadow: 2px 2px 5px red;">Application</h2>
                </div>
            </div>
        @endif    

        <!-- Developer 1 -->

        <div class="row" style="padding-left:2%;">
            <div class="col" style="padding-left:2%;">
                <div class="row">

                    <!-- Chief -->

                    @foreach($member as $members)
                        @if($members->sub_it_name == "Developer 1" && $members->position_name == "Chief")
                        <div class="carduser">

                            @if($members->status != 1 && $members->status != 4 && $members->status != 5 && $members->status != 6)
                                <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px red;" >
                            @else
                                <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px #1FFA09;" >
                            @endif

                            <table style="font-size:0.6vw;">
                                <tr>
                                    <td style="text-align:right;">Name : </td>
                                    <td style="text-align:left;">{{$members->name}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Position : </td>
                                    <td style="text-align:left;">{{$members->position_name}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Ext : </td>
                                    <td style="text-align:left;">{{$members->tel}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Status : </td>
                                    @if($members->status != 1)
                                        <td style="text-align:left; color:red;">{{$members->status_name}}</td>
                                    @else
                                        <td style="text-align:left;">{{$members->status_name}}</td>
                                    @endif
                                <tr>
                            </table>
                        </div>
                        @endif
                    @endforeach

                    <!-- Member -->

                    @foreach($member as $members)
                        @if($members->sub_it_name == "Developer 1" && $members->position_name != "Manager" && $members->position_name != "Chief")
                        <div class="carduser">

                            @if($members->status != 1 && $members->status != 4 && $members->status != 5 && $members->status != 6)
                                <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px red;" >
                            @else
                                <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px #1FFA09;" >
                            @endif
                            
                            <table style="font-size:0.6vw;">
                                <tr>
                                    <td style="text-align:right;">Name : </td>
                                    <td style="text-align:left;">{{$members->name}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Position : </td>
                                    <td style="text-align:left;">{{$members->position_name}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Ext : </td>
                                    <td style="text-align:left;">{{$members->tel}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Status : </td>
                                    @if($members->status != 1)
                                        <td style="text-align:left; color:red;">{{$members->status_name}}</td>
                                    @else
                                        <td style="text-align:left;">{{$members->status_name}}</td>
                                    @endif
                                <tr>
                            </table>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Developer 2 -->

            <div class="col" style="padding-left:2%;">  
                <div class="row">

                    <!-- Chief -->
 
                    @foreach($member as $members)
                        @if($members->sub_it_name == "Developer 2" && $members->position_name == "Chief")
                            <div class="carduser">

                                @if($members->status != 1 && $members->status != 4 && $members->status != 5 && $members->status != 6)
                                    <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px red;" >
                                @else
                                    <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px #1FFA09;" >
                                @endif

                                <table style="font-size:0.6vw;">
                                    <tr>
                                        <td style="text-align:right;">Name : </td>
                                        <td style="text-align:left;">{{$members->name}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Position : </td>
                                        <td style="text-align:left;">{{$members->position_name}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Ext : </td>
                                        <td style="text-align:left;">{{$members->tel}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Status : </td>
                                        @if($members->status != 1)
                                            <td style="text-align:left; color:red;">{{$members->status_name}}</td>
                                        @else
                                            <td style="text-align:left;">{{$members->status_name}}</td>
                                        @endif
                                    <tr>
                                </table>
                            </div>
                        @endif
                    @endforeach
                    
                    <!-- Member -->

                    @foreach($member as $members)
                        @if($members->sub_it_name == "Developer 2" && $members->position_name != "Manager" && $members->position_name != "Chief")
                        <div class="carduser">

                            @if($members->status != 1 && $members->status != 4 && $members->status != 5 && $members->status != 6)
                                <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px red;" >
                            @else
                                <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px #1FFA09;" >
                            @endif

                            <table style="font-size:0.6vw;">
                                <tr>
                                    <td style="text-align:right;">Name : </td>
                                    <td style="text-align:left;">{{$members->name}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Position : </td>
                                    <td style="text-align:left;">{{$members->position_name}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Ext : </td>
                                    <td style="text-align:left;">{{$members->tel}}</td>
                                <tr>
                                <tr>
                                    <td style="text-align:right;">Status : </td>
                                    @if($members->status != 1)
                                        <td style="text-align:left; color:red;">{{$members->status_name}}</td>
                                    @else
                                        <td style="text-align:left;">{{$members->status_name}}</td>
                                    @endif
                                <tr>
                            </table>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Application -->

            <div class="col" style="padding-left:2%;">
                <div class="row"> 
                    
                    <!-- Chief -->

                    @foreach($member as $members)
                        @if($members->sub_it_name == "Application" && $members->position_name == "Chief")
                            <div class="carduser">

                                @if($members->status != 1 && $members->status != 4 && $members->status != 5 && $members->status != 6)
                                    <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px red;" >
                                @else
                                    <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px #1FFA09;" >
                                @endif

                                <table style="font-size:0.6vw;">
                                    <tr>
                                        <td style="text-align:right;">Name : </td>
                                        <td style="text-align:left;">{{$members->name}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Position : </td>
                                        <td style="text-align:left;">{{$members->position_name}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Ext : </td>
                                        <td style="text-align:left;">{{$members->tel}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Status : </td>
                                        @if($members->status != 1)
                                            <td style="text-align:left; color:red;">{{$members->status_name}}</td>
                                        @else
                                            <td style="text-align:left;">{{$members->status_name}}</td>
                                        @endif
                                    <tr>
                                </table>
                            </div>
                            @endif
                        @endforeach

                        <!-- Member -->

                        @foreach($member as $members)
                            @if($members->sub_it_name == "Application" && $members->position_name != "Manager" && $members->position_name != "Chief")
                            <div class="carduser">

                                @if($members->status != 1 && $members->status != 4 && $members->status != 5 && $members->status != 6)
                                    <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px red;" >
                                @else
                                    <img src="images/{{$members->image}}" class="rounded" style="width:70px;height:100px; box-shadow: 0 0 4px 4px #1FFA09;" >
                                @endif

                                <table style="font-size:0.6vw;">
                                    <tr>
                                        <td style="text-align:right;">Name : </td>
                                        <td style="text-align:left;">{{$members->name}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Position : </td>
                                        <td style="text-align:left;">{{$members->position_name}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Ext : </td>
                                        <td style="text-align:left;">{{$members->tel}}</td>
                                    <tr>
                                    <tr>
                                        <td style="text-align:right;">Status : </td>
                                        @if($members->status != 1)
                                            <td style="text-align:left; color:red;">{{$members->status_name}}</td>
                                        @else
                                            <td style="text-align:left;">{{$members->status_name}}</td>
                                        @endif
                                    <tr>
                                </table>
                            </div>
                            @endif
                        @endforeach
                </div>
            </div>
        </div>

        <div class="row" style="margin-left:2%">
            <label><b>ผู้ดูแล : Ms.C.Naphattha</b></label>
        </div>
    </div>
</div>

</body>
</html>