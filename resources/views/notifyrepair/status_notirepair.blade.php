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
    <script src="/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        .circle {
            background: lightblue;
            border-radius: 50%;
            max-width: 100%;
            height: 100px;
            margin-left:10%;
            padding:20% 0 0 0;
        }
        table{
            width:100%;
            margin:auto;
            text-align:center;
            overflow-x:auto;
        }
        td{
            width:20%;
        }
    </style>
</head>
<body style="background:#E0E0E0;">

    <!-- Get value to checktrack.js file -->
    <script>

    var noti_repair = <?php echo json_encode($noti_repair); ?>;

    </script>

    <div class="container h-100 d-flex justify-content-center">
        <div class="border border-light my-auto" style="width:60%;text-align:center;padding:2% 5% 10% 5%;background-color:white;border-radius: 15px;">
            <h2> ติดตามสถานะแจ้งซ่อม </h2>
            <hr style="margin:3% 0 10% 0">
            <table id="table1" style="text-align:center;">
                <tr>
                    <td>
                        <i class="fa fa-paper-plane-o fa-3x" style="color:orange;" aria-hidden="true" data-toggle="tooltip" data-html="true" data-title="ส่งคำขอเรียบร้อย" ></i>
                    </td>
                    <td>
                        @if($noti_repair[0]->status_noti_repair == 1 || $noti_repair[0]->status_noti_repair == 3 || $noti_repair[0]->status_noti_repair == 4)
                            <i class="fa  fa-file-text-o fa-3x" style="color:orange;" aria-hidden="true"data-toggle="tooltip" data-html="true" data-title="รับงานเรียบร้อย<br>ผู้รับงาน : {{$noti_repair[0]->name}}<br> โทร : {{$noti_repair[0]->tel}}"></i>
                        @else 
                            <i class="fa  fa-file-text-o fa-3x" style="color:#E0E5DF;" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        @if($noti_repair[0]->status_noti_repair == 3 || $noti_repair[0]->status_noti_repair == 4)
                            <i class="fa fa-wrench fa-3x" style="color:orange;" aria-hidden="true" data-toggle="tooltip" data-html="true" data-title="กำลังเข้าไปดำเนินการ"></i>
                        @else
                            <i class="fa fa-wrench fa-3x" style="color:#E0E5DF;" aria-hidden="true"></i>
                        @endif
                    </td>
                    <td>
                        @if($noti_repair[0]->status_noti_repair == 4)
                            <i class="fa fa-check fa-3x" style="color:green;" aria-hidden="true" data-toggle="tooltip" data-html="true" data-title="คำขอดำเนินการเสร็จสิ้น"></i>
                        @else
                            <i class="fa fa-check fa-3x" style="color:#E0E5DF;" aria-hidden="true"></i>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>ส่งคำขอแจ้งซ่อม</td>
                    <td>รับงาน</td>
                    <td>กำลังดำเนินการ</td>
                    <td>เสร็จสิ้น</td>
                </tr>
            </table>

            @if($noti_repair[0]->status_noti_repair == 2)
            <script>
                document.getElementById('table1').className = "d-none";
            </script>
            <div class="row">
                <div class="col">

                    <i class="fa fa-times-circle" style="color:red;font-size:10em" aria-hidden="true"></i>
                    <h5 style="margin-top:2%">ไม่สามารถดำเนินการได้ กรุณาส่งใบร้องขอให้แผนก IT</h5>
                </div>
            </div>
            @endif
            
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>

</body>
</html>