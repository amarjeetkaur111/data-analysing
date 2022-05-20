@include('Common.Header')
  <!-- Main Navigation -->
  <style>
    .threedchart{box-shadow: 0 14px 28px rgb(0 0 0 / 15%), 0 10px 10px rgb(0 0 0 / 22%);
    border-radius: 5px;background:white;}
    .google-visualization-controls-label{font-weight:bold;}
    .dashboardlabel{color: black; font-size: 15px; font-weight:500}
  </style>
  <!-- Main layout -->
  <main>

    <div class="container-fluid">

      <!-- Section: Intro -->
      <section class="mt-md-4 pt-md-2">

        <!-- Grid row -->
        <div class="row">
          @widget('todaySale')
          @widget('weeklySales')
          @widget('monthlySales')
          @widget('totalSales')
       
        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: Intro -->

      <!-- Section: 3D Charts -->
      <section class="mt-md-4 threedchart" >

        <!-- Grid row -->
        <div class="row">
          <div class="col-12 text-right">
            <label class="dashboardlabel text-uppercase pr-4 pt-2">Last 5 Years Sales</label>
          </div>
        </div>
        <div class="row">
          @widget('interactivePieChart')    
          @widget('interactiveScatterChart')       
        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: 3D Charts -->

        <!-- Section: Charts -->
      <section class="mt-md-4 threedchart pb-5 pt-3" >

        <!-- Grid row -->
        <div class="row">
          <div class="col-12 text-right">
            <label class="dashboardlabel text-uppercase pr-4 pt-2">Last 12 Months Sales</label>
          </div>
        </div>
        <div class="row">
          @widget('lastYearPharmacySales')    
          @widget('top5Fields')    
        </div>
        <!-- Grid row -->

        <!-- Grid row -->
        <div class="row">
          <div class="col-12 text-right">
            <label class="dashboardlabel text-uppercase pr-4 pt-2">Last Week Sales</label>
          </div>
        </div>
        <div class="row">
          @widget('lastWeekSaleDonutChart')    
          @widget('lastWeekTotalOrderChart')    
          @widget('bottom5FieldsChart')    
        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: Charts -->

      <!-- Section: Main panel -->
      <section class="mb-5">

        <!-- Card -->
        <div class="card card-cascade narrower">
          @widget('pharmacyTable')
        </div>
        <!-- Card -->

      </section>
      <!-- Section: Main panel -->

      <!-- Section: Cascading panels -->
      <section class="mb-5" style="display:none;">

        <!-- Grid row -->
        <div class="row">

          <!-- Grid column -->
          <div class="col-lg-4 col-md-12 mb-lg-0 mb-4">

            <!-- Panel -->
            <div class="card">

              <div class="card-header white-text primary-color">
                Things to improve
              </div>

              <div class="card-body text-center px-4 mb-0">
                <div class="list-group list-panel">
                  <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Cras justo odio
                    <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top"
                      title="Click to fix"></i>
                  </a>
                  <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Dapibus ac facilisi
                    <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top"
                      title="Click to fix"></i>
                  </a>
                  <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Morbi leo risus
                    <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top"
                      title="Click to fix"></i>
                  </a>
                  <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Porta ac consectet
                    <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top"
                      title="Click to fix"></i>
                  </a>
                  <a href="#" class="list-group-item d-flex justify-content-between dark-grey-text">Vestibulum at eros
                    <i class="fas fa-wrench ml-auto" data-toggle="tooltip" data-placement="top"
                      title="Click to fix"></i>
                  </a>
                </div>
              </div>

            </div>
            <!-- Panel -->

          </div>
          <!-- Grid column -->

          <!-- @widget('salesComparisonTable') -->
        </div>
        <!-- Grid row -->

      </section>
      <!--Section: Cascading panels-->

      <!-- Section: Classic admin cards -->
      <section class="pb-3">

        <!-- Grid row -->
        <div class="row">
          @widget('highEntity')
          @widget('lowEntity')
          @widget('highPharmacy')
          @widget('lowPharmacy')
      

        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: Classic admin cards -->

    </div>

  </main>
  <!-- Main layout -->
@include('Common.Footer')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>