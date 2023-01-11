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
    <link type="text/css" rel="stylesheet" href="/styles_request.css">
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="/bootstrap-select/dist/css/bootstrap-select.css">
    
    <!-- Scripts -->
    <script src="/scripts/jquery-3.5.1.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="/bootstrap-select/dist/js/bootstrap-select.js"></script>

</head>
<body style="background-color:#E8E7E7;">


    <div id="mySidenav" class="sidenav" style="background-color:#fff;">

        <button class="clsnav" onclick="closeNav()"><i class="fa fa-times"></i></button>

        <p class="head-text">Request</p>

        <a href="/listrequestuser" >Request User</a>

    </div>

    @include('request_system.profile_request')

    <div id="contents">
        <div class="navbar navbar-light" style="color:#fff; margin-bottom:20px; background-color: rgb(0, 0, 0);position:top;">
            <span  style="font-size:25px;"><button id="togglebuttonrequest" class="btnmenu">&#9776;</button> Request IT</span>
        </div>

        <div class="contents">
            @yield('contents')
        </div>
    </div>

    <!-- script dropdown menu -->
    <script type="text/javascript" src="{{ URL::asset('/scripts/dropdown.js') }}"></script>

    <!-- script open nav -->
    <script type="text/javascript" src="{{ URL::asset('/scripts/onclicksidenavrequest.js') }}"></script>

    <!-- script check login -->
    <script type="text/javascript" src="{{ URL::asset('/scripts/checklogin.js') }}"></script>

    <!-- script check login -->
    <script type="text/javascript" src="{{ URL::asset('/scripts/approve.js') }}"></script>

    <!-- script signature pad -->
    <link href="/css/jquery.signaturepad.css" rel="stylesheet">
    <script src="/js/numeric-1.2.6.min.js"></script> 
    <script src="/js/bezier.js"></script>
    <script src="/js/jquery.signaturepad.js"></script> 
    
    <script type='text/javascript' src="/js/html2canvas.js"></script>
    <script src="/js/json2.min.js"></script>
    
    <script>
        //refresh page if back
        window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload() 
            }
        };

        //on load page open side nav
        window.addEventListener('load', (event) => {
            openNav();
        });
    </script>

</body>
</html>