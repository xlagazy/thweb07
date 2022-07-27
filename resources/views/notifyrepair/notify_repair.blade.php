<?php 
  function get_browser_name($user_agent){
      $t = strtolower($user_agent);
      $t = " " . $t;
      if (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) {
        header( "location: /errorie" );
        exit(0);
      }
  }
  get_browser_name($_SERVER['HTTP_USER_AGENT']);
?>
<html>
<head>
    <title>IT Sect</title>
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
<body style="background:white;">

    <nav class="navbar navbar-dark" style="background-color:#1e72d2;color:#fff;height:10%;">
        <p class="h3 mx-auto"> แจ้งซ่อมแผนก IT</p>
    </nav>

    <!-- Get value to checktrack.js file -->
    <script>

    var noti_repair = <?php echo json_encode($noti_repair); ?>;

    </script>

    <div style="padding:1% 1% 0 1%;" style="background-color:#c0ffd0;">

        <div class="row">

            <div class="col-3 border" style="padding-top:0.7%;">
                <button type="button" class="btn btn-success btn-lg btn-block add" data-toggle="modal" data-target="#addmodal">แจ้งซ่อม</button>
                <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#track" >ติดตามสถานะ</button>
            </div>

            <div class="col-9">
                <!-- table list notify repair -->
                <div class="table-responsive">
                    <table class="table border" style="font-size:1em;">
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
                                <td style="color:white;">
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
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('notifyrepair.modal_track')
    @include('notifyrepair.modal_add_notirepair')

    <script type="text/javascript" src="{{asset('/scripts/addnotirepair.js')}}"></script>
    <script type="text/javascript" src="{{asset('/scripts/checktrack.js')}}"></script>
</body>
</html>