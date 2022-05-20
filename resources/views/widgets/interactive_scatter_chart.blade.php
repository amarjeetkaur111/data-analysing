
<style>
    .google-visualization-controls-categoryfilter{display:flex;}
    .filterdiv{margin-bottom: 20px;
    padding-left: 3rem;
    padding-top: 1rem;}
</style>
    <!--Load the AJAX API-->
    <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
    <script type="text/javascript">
    // Load the Visualization API and the controls package.
    google.charts.load('current', {'packages':['corechart', 'controls']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawDashboard2);

    // Callback that creates and populates a data table,
    // instantiates a dashboard, a range slider and a pie chart,
    // passes in the data and draws it.
    function drawDashboard2() {
    
    
    // Create our data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Year');
    <?php for($c = 0; $c < count($pharmacy); $c++) {?>
        data.addColumn('number', '<?php echo $pharmacy[$c]['PharmacyName']; ?>');
    <?php } ?>
    data.addRows([ 
    <?php
    for($i=0;$i < count($sales);$i++){
        echo "['" . $sales[$i]['year'] . "'";
        for($c = 0; $c < count($pharmacy); $c++){
         echo ",".$sales[$i][$pharmacy[$c]['PharmacyName']]; 
        }
        echo "],";
    } 
    ?>
    ]);

    // Create a dashboard.
    var dashboard2 = new google.visualization.Dashboard(
        document.getElementById('dashboard_div2'));

    // Create a range slider, passing some options
    var yearfilter2 = new google.visualization.ControlWrapper({
        'controlType': 'CategoryFilter',
        'containerId': 'filter_div2',
        'options':  {
            filterColumnIndex: 0,
            ui: {
                allowTyping: false,
                allowMultiple: true,
                label: 'Year:',
                labelStacking: 'vertical'
            },
            useFormattedValue: true
        }
    });

    // Create a pie chart, passing some options
    var scatterChart = new google.visualization.ChartWrapper({
        'chartType': 'ScatterChart',
        'containerId': 'chart_div2',
        'options': {
            pointSize: 15,
			animation: {
			duration: 2000,
			easing: 'Out',
			},
			legend: { position: 'top'},
			chartArea: {
				width: "90%",
			},
        }
    });

    // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    dashboard2.bind(yearfilter2, scatterChart);

    // Draw the dashboard.
    dashboard2.draw(data);
    }
</script>


<!-- Grid column -->
<div class="col-xl-8 col-md-12 mb-xl-0">
 <!--Div that will hold the dashboard-->
    <div id="dashboard_div2">
      <!--Divs that will hold each control and chart-->
      <div id="filter_div2" class="filterdiv"></div>
      <div id="chart_div2"></div>
    </div>
</div>
