<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Months');
        <?php for($c = 0; $c < count($pharmacy); $c++) {?>
            data.addColumn('number', '<?php echo $pharmacy[$c]['PharmacyName']; ?>');
        <?php } ?>
        data.addRows([ 
        <?php
        for($i=0;$i < count($sales);$i++){
            echo "['" . $sales[$i]['month'] . "'";
            for($c = 0; $c < count($pharmacy); $c++){
            echo ",".$sales[$i][$pharmacy[$c]['PharmacyName']]; 
            }
            echo "],";
        } 
        ?>
        ]);


        var options = {
          title: 'Last 12 Months Sales',
          isStacked: true,
          pointSize: 15,
			animation: {
			duration: 2000,
			easing: 'Out',
			},
			legend: { position: 'top'},
			chartArea: {
				width: "90%",
			},
        };

        var chart = new google.visualization.SteppedAreaChart(document.getElementById('lastyearsalesdiv'));

        chart.draw(data, options);
      }
    </script>

<!-- Grid column -->
<div class="col-xl-7 col-md-12 mb-xl-0 ml-4">
    <div id="lastyearsalesdiv"></div>
</div>