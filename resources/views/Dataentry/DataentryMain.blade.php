@include('Common.Header') 
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main>
    <div class="container-fluid">

      <!-- Section: Team v.1 -->
      <section class="section team-section">

        <!-- Grid row -->
        <div class="row text-center">

          <!-- Grid column -->
          <div class="col-md-12 mb-4">
			<form method="post" action="{{ route('DataEntryFormView') }}">
			@csrf
            <!-- Card -->
				<div class="card card-cascade cascading-admin-card" style="min-height: 450px;">
				<!-- Card Data -->
					<div class="admin-up d-flex justify-content-start">
						<i class="fas fa-table info-color py-4 mr-3 z-depth-2"></i>
						<div class="data">
							<h5 class="font-weight-bold dark-grey-text">Dataentry - <span class="text-muted">Select Pharmacy
							and Date</span></h5>
						</div>
					</div>
					<!-- Card Data -->
					<!-- Card content -->
					<div class="card-body card-body-cascade" style="margin-top:35px;">
						<!-- Grid row -->
						<div class="row">
							<!-- Grid column -->
							<div class="col-lg-3">
								<select name="pharmacy" class="form-control">
									<option value="">Select Pharmacy</option>
									@foreach($pharmacy as $row)
										<option value="{{ $row->PharmacyID }}">{{ $row->PharmacyName }}</option>
									@endforeach
								</select>
								@if($errors->DataentryMain->has('pharmacy'))
									<span class="text-danger">{{$errors->DataentryMain->first('pharmacy')}}</span>
								@endif								
							</div>
							<!-- Grid column -->

							<!-- Grid column -->
							<div class="col-lg-3">
								<input type="date" name="SubmitDate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
								@if($errors->DataentryMain->has('SubmitDate'))
									<span class="text-danger">{{$errors->DataentryMain->first('SubmitDate')}}</span>
								@endif
							</div>
							<!-- Grid column -->

						</div>
						<!-- Grid row -->

						<!-- Grid row -->
						<div class="row">
							<!-- Grid column -->
							<div class="col-md-6 text-left">
								<div class="md-form form-sm mb-0">
									<button type="submit" class="btn btn-outline-primary waves-effect">Next</button>
								</div>
							</div>
							<!-- Grid column -->
						</div>
						<!-- Grid row -->
					</div>
				<!-- Card content -->

				</div>
			</form>	
			<!-- Card -->
			
          </div>
          <!-- Grid column -->

        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: Team v.1 -->

    </div>
  </main>
  <!-- Main layout -->
@include('Common.Footer')
