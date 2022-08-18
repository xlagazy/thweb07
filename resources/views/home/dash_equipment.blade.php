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

    var chartEquip = <?php echo json_encode($sumequip); ?>;

    </script>

    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Equipment Name'); 
            data.addColumn('number', 'Amount'); 

            for(let chartEquips of chartEquip){
                data.addRow([chartEquips.com_name, chartEquips.sumequip]);
            }

            var options = {
                height:350,
                legend: { position: 'none' },
                chart: {
                    title: 'Summary amount equipment'},
                bar: {groupWidth: '80%'},
                hAxis: {
                    textPosition : 'in',
                    textStyle:{
                        fontSize:9,
                        fontName:'Arial',
                        bold:false,
                        italic:true
                    }
                },
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_equipment'));
            // Convert the Classic options to Material options.
            chart.draw(data, google.charts.Bar.convertOptions(options));
        };

        $(window).resize(function(){
            drawStuff();
        });
    </script>

    <label><b>Equipment</b></label>
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <div id="barchart_equipment"></div>

        <!-- @foreach($sumequip as $sumequips)
            <div class="col-3">
                <div class="card-dash">
                    <a href="sourceequipment/{{$sumequips->com_name}}" style="color:#000;">
                        <p style="font-size:0.9em"><b>{{$sumequips->com_name}}</b></p>
                        <p style="font-size:0.8em">{{$sumequips->sumequip}}</p>
                    </a>
                </div>
            </div>
        @endforeach -->
    </div>