
          <!-- Grid column -->
          <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

            <!-- Card Primary -->
            <div class="card classic-admin-card light-blue lighten-1">
              <div class="card-body">
                <div class="pull-right">
                  <i class="far fa-money-bill-alt"></i>
                </div>
                <p class="white-text">Week's Highest Selling Pharmacy</p>
                @if($field)                  
                  <h4 class="check">{{$field}}</h4>
                  <p>{{$value}} $</p>
                @else
                  <h3>No Data Available</h3>
                @endif               
              </div>
              <!-- <div class="progress">
                <div class="progress-bar bg grey darken-3" role="progressbar" style="width: 25%" aria-valuenow="25"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div> -->
              <!-- <div class="card-body">
                <h5>{{$value}}</h5>
              </div> -->
            </div>
            <!-- Card Primary -->

          </div>
          <!-- Grid column -->
