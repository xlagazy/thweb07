<!DOCTYPE html>
<html>
<head>
    <title>IT Sect</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="/styles.css">
    <link type="text/css" rel="stylesheet" href="/stylesipad.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/bootstrap-select/dist/css/bootstrap-select.min.css">
    
    <!-- Scripts -->
    <script src="/scripts/jquery-3.5.1.min.js"></script>
    <script src="/sweetalert2/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="/charts/loader.js"></script>
    <script src="/popper/popper.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    
</head>
<body style="margin:0;background-color:#B5B5B530;">
    
    <div>
    
      <div id="mySidenav" class="sidenav" style="background-color: rgb(0, 173, 241);">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

          <div class="user row" style="margin-top:10px;">
              <a href="" style="margin:0 10px 0 20px;">
                  {{session()->get('name')}}  
              </a>
              <img src="<?php echo '/images/'.session()->get('image'); ?>" class="rounded-circle z-depth-2" style="width:40px;height:40px; object-fit: cover;" onerror="this.src='https://www.lopburicancer.in.th/img/user.png'
              data-holder-rendered='true' ">
              <br>
              <div class="out">
                <a href="{{URL::to('/logout')}}" style="margin-left:50px; " >ออกจากระบบ </a>
              </div>
          </div>

          <hr style="height:1px;border-width:0;color:gray;background-color:white;margin: 10px 10px 0 10px;">

          <a href="/">หน้าแรก</a>
          
          <div class="dropdown-btn">Organize
            <i class="fa fa-caret-down"></i>
          </div>
          <div class="dropdown-container">
            <a href="{{URL::to('/organization')}}" target="_blank">ตาราง Organize</a>
            @if(session()->get('user_id') == "15")
              <a href="{{URL::to('/checklist')}}">เช็คเวลาทำงาน</a>
            @endif
            <a href="{{URL::to('showeditchecklist')}}">แก้ไขเช็คเวลาทำงาน</a>
          </div>
      
          <div class="dropdown-btn">Request
            <i class="fa fa-caret-down"></i>
          </div>
          <div class="dropdown-container">
           <!-- <a href="{{URL::to('/listnotifyrepair')}}">รายการแจ้งซ่อม </a>
            <a href="{{URL::to('/recievenotifyrepair')}}">งานที่รับ</a> -->
            <a href="{{URL::to('/listrequestuser/it')}}">Request User</a>
            <a href="{{URL::to('/listrequestadmin/it')}}">Request Admin</a>
          </div>

          <div class="dropdown-btn">Planet Press
              <i class="fa fa-caret-down"></i>
          </div>
          <div class="dropdown-container">
            <a href="{{URL::to('/listplanetpressthai')}}">Printer Planet Press <label class="text-danger">(THAI)</label></a>
            <a href="{{URL::to('/listplanetpress')}}">Printer Planet Press (DEV)</a>
          </div>

          @if(session()->get('type_user') == 1 || session()->get('sub') == 3 || session()->get('sub') == 4)
            <div class="dropdown-btn">Equipment
              <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container">
              <a href="{{URL::to('/listequipment')}}">Main Equipment</a>
              <a href="{{URL::to('/listotherequipment')}}">Others Equipment</a>
            </div>
          @endif

          @if(session()->get('type_user') == 1 || session()->get('sub') == 3 || session()->get('sub') == 4)
            <div class="dropdown-btn">Software
              <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container">
              <a href="{{URL::to('/listsoftware')}}">จัดการ Software</a>
            </div>
          @endif

          @if(session()->get('type_user') == 1 || session()->get('sub') == 3 || session()->get('sub') == 4)
            <div class="dropdown-btn">Stock
              <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container">
              <a href="{{URL::to('/liststock')}}">จัดการ Stock</a>
            </div>
          @endif

          @if(session()->get('type_user') == 1 || session()->get('sub') == 3 || session()->get('sub') == 4)
            <div class="dropdown-btn">Material
              <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container">
              <a href="{{URL::to('/listmaterial')}}">จัดการ Material</a>
              <a href="{{URL::to('/liststockmaterial')}}">Stock Material</a>
              <a href="{{URL::to('/listwithdrawmaterial')}}">Withdraw Material</a>
            </div>
          @endif

          @if(session()->get('type_user') == 1 || session()->get('sub') == 3 || session()->get('sub') == 4)
            <div class="dropdown-btn">Borrow
              <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container">
              <a href="{{URL::to('/listborrow')}}">จัดการ Borrow</a>
            </div>
          @endif


          @if(session()->get('type_user') == 1 || session()->get('sub') == 3 || session()->get('sub') == 4)
            <div class="dropdown-btn">Master
              <i class="fa fa-caret-down"></i>
            </div>
            <div class="dropdown-container">
              <a href="{{URL::to('/listuser')}}">จัดการผู้ใช้</a>
              <a href="{{URL::to('/listvendor')}}">จัดการ Vendor</a>
              <a href="{{URL::to('/listsection')}}">จัดการ Section</a>
              <a href="{{URL::to('/listdepartment')}}">จัดการ Department</a>
              <a href="{{URL::to('/listos')}}">จัดการ O/S</a>
              <a href="{{URL::to('/listequiptype')}}">จัดการ Equipmet Type</a>
              <a href="{{URL::to('/listcomtype')}}">จัดการ Com Type</a>
            </div>
          @endif

      </div>

      <div class="navbar navbar-light fixed-top" style="color:#fff; margin-bottom:20px; background-color: rgb(0, 173, 241);">

      <span id="togglebutton" style="font-size:30px;cursor:pointer" clsdd="shadow p-3 mb-5 bg-white rounded">&#9776; IT Web</span>

      </div>

    <div class="contents">
    
        @yield('contents')

    </div>

    <!-- <script>
        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
        } else {
            document.getElementById("navbar").style.top = "50px";
        }
        prevScrollpos = currentScrollPos;
        }
    </script> -->

    <!-- scropt loaded -->
    <!-- <script>
        var myVar;

        function myFunction() {
          myVar = setTimeout(showPage, 1500);
        }

        function showPage() {
          document.getElementById("loader").style.display = "none";
          document.getElementById("myDiv").style.display = "block";
        }
    </script> -->

    <!-- script dropdown menu -->
    <script type="text/javascript" src="{{ URL::asset('/scripts/dropdown.js') }}"></script>

    <!-- script open nav -->
    <script type="text/javascript" src="{{ URL::asset('/scripts/onclicksidenav.js') }}"></script>

    <!-- script signature pad -->
    <link href="/css/jquery.signaturepad.css" rel="stylesheet">
    <script src="/js/numeric-1.2.6.min.js"></script> 
    <script src="/js/bezier.js"></script>
    <script src="/js/jquery.signaturepad.js"></script> 
    
    <script type='text/javascript' src="/js/html2canvas.js"></script>
    <script src="/js/json2.min.js"></script>
    
    <!-- refresh page if back -->
    <script>
      window.onpageshow = function(event) {
      if (event.persisted) {
          window.location.reload() 
          }
      };
    </script>

</body>
</html>