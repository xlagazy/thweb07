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

    var chartStockMaterial = <?php echo json_encode($sumstockmaterial); ?>;

    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuffStockMaterial);

        function drawStuffStockMaterial() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Material Name'); 
            data.addColumn('number', 'Amount'); 

            for(let chartStockMaterials of chartStockMaterial){
                data.addRow([chartStockMaterials.material_name, parseInt(chartStockMaterials.sumstockqty)]);
            }

            var options = {
                height:350,
                legend: { position: 'none' },
                chart: {
                    title: 'Summary stock material',},
                bars: 'horizontal',
                bar: {groupWidth: '80%'},
                colors: ['#59CE8F'],
                hAxis: {
                    textStyle:{
                        fontSize:9,
                        fontName:'Arial',
                        bold:false,
                        italic:true,
                    }
                },
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_stock_material'));
            // Convert the Classic options to Material options.
            chart.draw(data, google.charts.Bar.convertOptions(options));
        };

        $(window).resize(function(){
            drawStuffStockMaterial();
        });
    </script>

    <label><b>Stock Material</b></label>
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <div id="barchart_stock_material"></div>
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