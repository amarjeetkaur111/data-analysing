<style>
    .top5ieldsdivWithOverlay {
           position: relative;
           width: 700px;
    }
    .top5ieldsdivoverlay {
           width: 200px;
           height: 200px;
           position: absolute;
           top: 70px;   /* chartArea top  */
           left: 180px; /* chartArea left */
    }
   </style>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Field');
        data.addColumn('number', 'Sales');
        data.addColumn({type: 'string', role: 'style'});
        data.addRows([ 
        <?php
        foreach($topfields as $key => $value){
            echo "['" . $key . "'," . $value . ",'color: #ac6598'],";
        } 
        ?>
        ]);


        var options = {
          title: 'Top 5 Items ',
          isStacked: true,
          pointSize: 15,
            animation: {
            duration: 2000,
            easing: 'Out',
            },
            legend: { position: 'top'},
            chartArea: {
              width: "70%",
            },
            colors: ['#ac6598']
        };

        var chart = new google.visualization.BarChart(document.getElementById('top5fieldsdiv'));

        chart.draw(data, options);
      }
    </script>

<!-- Grid column -->
<div class="col-xl-5 col-md-12 mb-xl-0 ml-n4 top5ieldsdivWithOverlay">
    <div id="top5fieldsdiv"></div>
    @if(empty($topfields))
      <div class="top5ieldsdivoverlay">
        <div style="font-family:'Arial Black'; font-size: 18px;">No Data For Chart</div>
    </div>
    @endif
</div>