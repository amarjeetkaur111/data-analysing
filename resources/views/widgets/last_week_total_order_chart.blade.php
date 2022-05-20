
<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Pharmacy');
        data.addColumn('number', 'Number Of Orders');
        data.addRows([ 
        <?php
        foreach($sales as $key => $value){
            echo "['" . $key . "'," . $value . "],";
        } 
        ?>
        ]);

        var options = {
          title: '',
          pointSize: 20,
          legend: { position: 'top'},
		  hAxis: {slantedText:'true'},
			chartArea: {
				width: "90%",
                height:"50%",
			},
        };

        var chart = new google.visualization.LineChart(document.getElementById('lastweektotalorderchartdiv'));
        chart.draw(data, options);
    }
    </script>
<!-- Grid column -->
<div class="col-xl-4 col-md-12 mb-xl-0">
    <div id="lastweektotalorderchartdiv"></div>
</div>