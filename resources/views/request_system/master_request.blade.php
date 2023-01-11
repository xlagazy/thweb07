<!DOCTYPE html>
<html>
<head>
    <title>IT Sect</title>
    <meta charset="UTF-8">
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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>
<body style="background-color:#E8E7E7;">


    <div id="mySidenav" class="sidenav" style="background-color:#fff;">

        <button class="clsnav" onclick="closeNav()"><i class="fa fa-times"></i></button>

        <p class="head-text">Request</p>

        <div class="dropdown-btn">Request Application
            <i class="fa fa-caret-down"></i>
        </div>

        <div class="dropdown-container">
            <a href="/listrequestapp/user" >List request application</a>
            <a href="/testcont" >test 1</a>
            <a href="/testcont" >test 1</a>
        </div>

        <div class="dropdown-btn">Request Developer
            <i class="fa fa-caret-down"></i>
        </div>

        <div class="dropdown-container">
            <a href="/testcont" >test 1</a>
            <a href="/testcont" >test 1</a>
            <a href="/testcont" >test 1</a>
        </div>

    </div>

    @include('request_system.profile_request')

    <div id="contents">
        <div class="navbar navbar-light" style="color:#fff; margin-bottom:20px; background-color: rgb(0, 0, 0);position:top;">
            <span  style="font-size:25px;"><button id="togglebuttonrequest" class="btnmenu">&#9776;</button> Request IT</span>
            <div>
                @if(empty(Cookie::get('name')))
                    <button id="loginbtn" class="loginbtn" data-toggle="modal" data-target="#loginmodal">Login</button>

                    @include('request_system.login_request')
                @else
                    <span>Welcome, {{Cookie::get('name')}}</span>
                    <span>
                        <div class="dropdown">
                            <i class="fa fa-user fa-2x dropbtn"></i>
                            <div class="dropdown-content">
                                <a href="#" data-toggle="modal" data-target="#settingmodal"><i class="fa fa-cog" aria-hidden="true" style="margin-right:3%"></i>Setting</a>
                                <a href="/logoutrequest"><i class="fa fa-sign-out" aria-hidden="true" style="margin-right:3%"></i>Log out</a>
                            </div>
                        </div>
                    </span>
                @endif
            </div>
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