<html>
<head>
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

    <style>
        body{
            background-image:url('/images/icons/ibm.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        #head{
            font-size:60px;
            text-align:center;
            color:white;
        }
        #content{
            background-color:#00000070;
            width:80%;
            height:80%;
            margin:auto;
            padding:1%;
        }
        #c1{
            background-color:red;
            height:100%;
        }
        #c2{
            background-color:red;
            height:100%;
        }
        #c3{
            background-color:red;
            height:100%;
        }
    </style>
    
</head>
<body>
    <div id="head">
        IBM i Monitor (THAI)
    </div>

    <div class="row" id="content">
        <div class="col-sm-2" id="c1">
        </div>

        <div class="col-sm-2" id="c2">
        </div>

        <div class="col-sm-2 float-right" id="c3">
        </div>
    </div>

    <p id="view">0</p>

    <script>
        function startLiveUpdate(){
            const textViewCount = document.getElementById('view');

            setInterval(function(){
                fetch('http://thweb07/test').then(function (response) {
                    return response.json();
                }).then(function (data){
                    textViewCount.textContent = data.ELAPSED_CPU_USED;
                    if(data.ELAPSED_CPU_UNCAPPED_CAPACITY >= 10){
                        textViewCount.style.color = "red";
                    }
                    else{
                        textViewCount.style.color = "black";
                    }
                }).catch(function (error){
                    console.log(error);
                });
            }, 3000);
        }

        document.addEventListener('DOMContentLoaded', function(){
            startLiveUpdate();
        });
    </script>
</body>