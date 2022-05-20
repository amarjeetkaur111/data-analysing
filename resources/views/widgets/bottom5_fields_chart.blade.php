<style>
    .bottom5ieldsdivWithOverlay {
           position: relative;
           width: 700px;
    }
    .bottom5ieldsdivoverlay {
           width: 200px;
           height: 200px;
           position: absolute;
           top: 70px;   /* chartArea top  */
           left: 80px; /* chartArea left */
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
            echo "['" . $key . "'," . $value . ",'color: #de3248'],";
        } 
        ?>
        ]);


        var options = {
            title: 'Bottom 5 Items ',
            legend: { position: 'top'},
            chartArea: {
                width: "90%",
                height:"50%",
            },
            colors: ['#de3248'],
            hAxis: {slantedText:'true'},
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('bottom5ieldsdiv'));

        chart.draw(data, options);
      }
    </script>

<!-- Grid column -->
<div class="col-xl-4 col-md-12 mb-xl-0 bottom5ieldsdivWithOverlay">
<div id="bottom5ieldsdiv"></div>
    @if(empty($topfields))
      <div class="bottom5ieldsdivoverlay">
        <div style="font-family:'Arial Black'; font-size: 18px;">No Data For Chart</div>
    </div>
    @endif
</div>