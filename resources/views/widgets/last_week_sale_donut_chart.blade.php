<style>
  .DonutChartdivWithOverlay {
           position: relative;
           width: 700px;
    }
    .DonutChartoverlay {
           width: 200px;
           height: 200px;
           position: absolute;
           top: 70px;   /* chartArea top  */
           left: 80px; /* chartArea left */
    }
</style>

<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Pharmacy');
        data.addColumn('number', 'Sales');
        data.addRows([ 
        <?php
        foreach($sales as $key => $value){
            echo "['" . $key . "'," . $value . "],";
        } 
        ?>
        ]);

        var options = {
          title: 'Last Week Sales',
          pieHole: 0.4,
          'chartArea': {left: "10%",
                top: "3%",
                height: "94%",
                width: "94%"},
            
            'width':'100%',
            'height':'100%',
        };

        var chart = new google.visualization.PieChart(document.getElementById('lastweeksaleschartdiv'));
        chart.draw(data, options);
      }
    </script>

<!-- Grid column -->
<div class="col-xl-4 col-md-12 mb-xl-0 DonutChartdivWithOverlay">
    <div id="lastweeksaleschartdiv"></div>
    @if(min($sales)==0 && max($sales)==0)
      <div class="DonutChartoverlay">
        <div style="font-family:'Arial Black'; font-size: 18px;">No Data For Chart</div>
    </div>
    @endif
</div>