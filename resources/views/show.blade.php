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
        var URLs = ["http://thweb07/network-monitor", "http://thweb07/organization"];
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