 <!-- Grid column -->
 <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">

<!-- Card -->
<div class="card card-cascade cascading-admin-card">

  <!-- Card Data -->
  <div class="admin-up">
    <i class="far fa-money-bill-alt light-blue lighten-1 mr-3 z-depth-2"></i>
    <div class="data">
      <p class="text-uppercase">Last Month Sales</p>
      <h4 class="font-weight-bold dark-grey-text">{{$data['lastmonthtotaldollars']}}</h4>
    </div>
  </div>

  <!-- Card content -->
  <div class="card-body card-body-cascade">
    <div class="progress mb-3">
      @if($data['precentage'] > 0)
        <div class="progress-bar bg-primary" role="progressbar" style="width: {{$data['precentage']}}%" aria-valuenow="25"
          aria-valuemin="0" aria-valuemax="100"></div>
      @else
        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$data['precentage']*-1}}%" aria-valuenow="25"
          aria-valuemin="0" aria-valuemax="100"></div>
      @endif
    </div>
    @if($data['precentage'] > 0)
      <p class="card-text">Better than previous month {{round($data['precentage'])}}%</p>
    @else
      <p class="card-text">Worse than previous month {{round($data['precentage']*-1)}}%</p>
    @endif
  </div>

</div>
<!-- Card -->

</div>