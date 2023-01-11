<html>
<head>

</head>
<body>
    <p id="view">0</p>

    <script>
        function startLiveUpdate(){
            const textViewCount = document.getElementById('view');

            setInterval(function(){
                fetch('http://thweb07/test').then(function (response) {
                    return response.json();
                }).then(function (data){
                    textViewCount.textContent = data.ELAPSED_CPU_USED;
                    if(data.ELAPSED_CPU_USED >= 10){
                        textViewCount.style.color = "red";
                    }
                    else{
                        textViewCount.style.color = "black";
                    }
                }).catch(function (error){
                    console.log(error);
                });
            }, 2000);
        }

        document.addEventListener('DOMContentLoaded', function(){
            startLiveUpdate();
        });
    </script>
</body>