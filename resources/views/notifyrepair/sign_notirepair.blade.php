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
<body>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="ct_listuser">
        <form action="{{URL::to('updatesignature')}}" method="post" enctype="multipart/form-data" class="frmedt needs-validation">
            <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>" >
            <input type = "hidden" name = "noti_repair_no" id="noti_repair_no" value = "{{$notirepair[0]->noti_repair_no}}" >

            <div class="row">
                <div class="col" style="text-align:center;position:fixed;">
                    <label><b>Signature</b></label>
                    <br/>
                    <div class="panel-body center-text">
                        <div id="signArea" >
                            <h2 class="tag-ingo">Put signature below,</h2>
                            <div class="sig sigWrapper" style="height:auto;width:305px;">
                                <div class="typed"></div>
                                <canvas class="sign-pad noti-sign-size" id="sign-pad" ></canvas>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" onclick="window.history.go(-1); return false;" data-dismiss="modal">Close</button>
                            <button id="clear" class="btn btn-danger">Clear Signature</button>
                            <button class="btn btn-success edt" style="width:10%;">Save</button>        
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript" src="{{asset('scripts/signnotirepair.js')}}"></script>

    <!-- script dropdown menu -->

    <script type="text/javascript" src="{{ URL::asset('scripts/dropdown.js') }}"></script>

    <!-- script open nav -->

    <script type="text/javascript" src="{{ URL::asset('scripts/onclicksidenav.js') }}"></script>

    <!-- script signature pad -->
    <link href="/css/jquery.signaturepad.css" rel="stylesheet">
    <script src="/js/numeric-1.2.6.min.js"></script> 
    <script src="/js/bezier.js"></script>
    <script src="/js/jquery.signaturepad.js"></script> 
    
    <script type='text/javascript' src="/js/html2canvas.js"></script>
    <script src="/js/json2.min.js"></script>

</body>
<html>