
<style>
    .google-visualization-controls-categoryfilter{display:flex;}
    .filterdiv{margin-bottom: 20px;
    padding-left: 3rem;
    padding-top: 1rem;}
    .PiedivWithOverlay {
           position: relative;
           width: 700px;
    }
    .Piedivoverlay {
           width: 200px;
           height: 200px;
           position: absolute;
           top: 70px;   /* chartArea top  */
           left: 80px; /* chartArea left */
    }
</style>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    // Load the Visualization API and the controls package.
    google.charts.load('current', {'packages':['corechart', 'controls']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.charts.setOnLoadCallback(drawDashboard);

    // Callback that creates and populates a data table,
    // instantiates a dashboard, a range slider and a pie chart,
    // passes in the data and draws it.
    function drawDashboard() {
    
    
    // Create our data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Year');
    data.addColumn('number', 'Sales');
    data.addRows([ 
    <?php
    for($i=0;$i < count($sales);$i++){
        echo "['" . $sales[$i]['year'] . "'," . $sales[$i]['Sales'] . "],";
    } 
    ?>
    ]);

    // Create a dashboard.
    var dashboard = new google.visualization.Dashboard(
        document.getElementById('dashboard_div'));

    // Create a range slider, passing some options
    var yearfilter = new google.visualization.ControlWrapper({
        'controlType': 'CategoryFilter',
        'containerId': 'filter_div',
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
    var pieChart = new google.visualization.ChartWrapper({
        'chartType': 'PieChart',
        'containerId': 'chart_div',
        'options': {
        'chartArea': {left: "10%",
            top: "3%",
            height: "94%",
            width: "94%"},
        
        'width':'100%',
        'height':'100%',
        'pieSliceText': 'value',
        'is3D': true,
        animation:{
            duration: 1000,
            easing: 'out',
        },
        }
    });

    // Establish dependencies, declaring that 'filter' drives 'pieChart',
    // so that the pie chart will only display entries that are let through
    // given the chosen slider range.
    dashboard.bind(yearfilter, pieChart);

    // Draw the dashboard.
    dashboard.draw(data);
    }
</script>


<!-- Grid column -->
<div class="col-xl-4 col-md-12 mb-xl-0 PiedivWithOverlay">
 <!--Div that will hold the dashboard-->
    <div id="dashboard_div">
      <!--Divs that will hold each control and chart-->
      <div id="filter_div" class="filterdiv"></div>
      <div id="chart_div"></div>
    </div>
    @if(empty($sales))
      <div class="Piedivoverlay">
        <div style="font-family:'Arial Black'; font-size: 18px;">No Data For Chart</div>
    </div>
    @endif
</div>
