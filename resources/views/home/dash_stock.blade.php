<style>
    .card-dash:hover{
        background-color:#00000020;
    }    
    a:hover{
        text-decoration: none;
    }
</style>

<!-- Get value -->
    <script>

    var chartStock = <?php echo json_encode($sumstock); ?>;

    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuffStock);

        function drawStuffStock() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Equipment Name'); 
            data.addColumn('number', 'Amount'); 

            for(let chartStocks of chartStock){
                data.addRow([chartStocks.com_name, chartStocks.sumstock]);
            }

            var options = {
                height:350,
                legend: { position: 'none' },
                chart: {
                    title: 'Summary stock equipment',},
                bar: {groupWidth: '80%'},
                colors: ['#e0440e']
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_stock'));
            // Convert the Classic options to Material options.
            chart.draw(data, google.charts.Bar.convertOptions(options));
        };

        $(window).resize(function(){
            drawStuffStock();
        });
    </script>

    <label><b>Stock</b></label>
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <div id="barchart_stock"></div>
        <!-- <div class="row" style="text-align:center;">
        @foreach($sumstock as $sumstocks)
            <div class="col-3">
                <div class="card-dash">
                    <a href="sourcestock/{{$sumstocks->com_name}} " style="color:#000;">
                        <p style="font-size:0.9em"><b>{{$sumstocks->com_name}}</b></p>
                        <p style="font-size:0.8em">{{$sumstocks->sumstock}}</p>
                    </a>
                </div>
            </div>
        @endforeach
        </div> -->
    </div>