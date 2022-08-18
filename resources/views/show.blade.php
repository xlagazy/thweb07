<html>
<head>
</head>
<body >

<div class="my-iframe">
        <iframe id="ifr" width="100%" height="100%" frameborder="0" scrolling="auto" marginheight="0" marginwidth="0"
           src="" allow="fullscreen">
        </iframe>
</div>

<script>
        var URLs = ["http://thweb07/organization", "https://corp.csloxinfo.com/graph_zoom.php?CustomerID=09635&CustomerName=Nisshinbo%20Micro%20Devices%20(Thailand)%20Co.,Ltd.&type=Daily&Speed=100000.0&iframe=true&width=100%&height=100%"];
        var currURL = 0;

        function cycle() {
            currURL = (currURL + 1) % 2;
            document.getElementById("ifr").src = URLs[currURL];
            setTimeout(cycle, 30000);
        }

        cycle();
</script>


</body>
</html>