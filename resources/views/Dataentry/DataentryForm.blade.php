@include('Common.Header') 
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main>
    <div class="container-fluid">

      <!-- Section: Team v.1 -->
      <section class="section team-section">

        <!-- Grid row -->
        <div class="row text-center">
			<div class="col-12 my-3">
			  <form method="post" action="{{ route('SubmitDataEntry') }}">
			  @csrf
				<div class="classic-tabs">

					<!-- Nav tabs -->
					<div class="tabs-wrapper">
						<ul class="nav tabs-blue" role="tablist">
							<li class="nav-item">
								<a class="nav-link waves-light active waves-effect waves-light" data-toggle="tab" href="#prescription-tab" role="tab">Prescription</a>
							</li>
							<li class="nav-item">
								<a class="nav-link waves-light waves-effect waves-light" id="compound_link" data-toggle="tab" href="#compound-tab" role="tab">Compounds</a>
							</li>
							<li class="nav-item">
								<a class="nav-link waves-light waves-effect waves-light" id="clinical_link" data-toggle="tab" href="#clinicals-tab" role="tab">Clinicals</a>
							</li>
							<li class="nav-item">
								<a class="nav-link waves-light waves-effect waves-light" id="salesled_link" data-toggle="tab" href="#sales-ledger-tab" role="tab">Sales Ledger</a>
							</li>
						</ul>
					</div>

					<!-- Tab panels -->
					<div class="tab-content card">
						<!-- Prescription -->
						<div class="tab-pane fade in show active" id="prescription-tab" role="tabpanel">
							<!-- Grid row -->
							<div class="row">
								<!-- Grid column -->
								<div class="col-lg-3">
									<select name="pharmacy" class="form-control" disabled="disabled">
										<option value="">Select Pharmacy</option>
										@foreach($pharmacy as $row)
											<option value="{{ $row->PharmacyID }}" {{ $PostedData['PharmacyID']==$row->PharmacyID ? 'selected':'' }} > {{ $row->PharmacyName }}</option>
										@endforeach
									</select>
									<input type="hidden" name="PharmacyID" value="{{ encval($PostedData['PharmacyID']) }}">
								</div>
								<!-- Grid column -->

								<!-- Grid column -->
								<div class="col-lg-3">
									<input type="date" class="form-control" name="SubmittedDate" value="{{ $PostedData['SubmitDate'] }}" disabled>
									<input type="hidden" name="CurrentDate" value="{{ $PostedData['SubmitDate'] }}">
								</div>
								<!-- Grid column -->
								<div class="row">
									<div class="col-md-10">
										<h5 class="category-title">Prescription</h5>
										<div class="row">
										@foreach($Prescription as $PrescriptionFields)
										@php
											$PrescriptionInputName=$PrescriptionFields->CategoryID.'_'.$PrescriptionFields->FieldID;	
										@endphp
											<div class="col-md-3">
												<label class="fields">* {{ $PrescriptionFields->FieldTitle }}</label>
											</div>
											<div class="col-md-3 input-fields">
												<input type="number" class="form-control" min="0" name="{{ $PrescriptionInputName }}">
											</div>										
										@endforeach	
										</div>
									</div>
								</div>
							</div>
							<div class="row">	
								<div class="col-md-12">
									<button type="button" class="btn btn-outline-primary waves-effect" role="button" id="prescription-button"><i class="fas fa-save" style="padding-right: .1em"></i> Save And Next</button>
								</div>
							</div>
							<!-- Grid row -->		
						</div>
						<!-- Prescription End-->

						<!-- Compound -->
						<div class="tab-pane fade" id="compound-tab" role="tabpanel">
							<div class="row">
								<div class="col-md-10">	
									<h5 class="category-title">Compound</h5>
									<div class="row">
										@foreach($Compound as $CompoundFields)
										@php
											$CompoundInputName=$CompoundFields->CategoryID.'_'.$CompoundFields->FieldID;	
										@endphp
									
											<div class="col-md-3">
												<label class="fields">* {{ $CompoundFields->FieldTitle }}</label>
											</div>
											<div class="col-md-3 input-fields">
												<input type="number" class="form-control" min="0" name="{{ $CompoundInputName }}">
											</div>										
										@endforeach	
									</div>
								</div>
							</div>
							<div class="row">	
								<div class="col-md-12">
									<button type="button" class="btn btn-outline-primary waves-effect" role="button" id="compound-button"><i class="fas fa-save" style="padding-right: .1em"></i> Save And Next</button>
								</div>
							</div>								
						</div>
						<!-- Compound End -->

						<!-- Clinicals -->
						<div class="tab-pane fade" id="clinicals-tab" role="tabpanel">
							<div class="row">
								<div class="col-md-10">
									<h5 class="category-title">Clinicals</h5>
									<div class="row">
										
										@foreach($Clinicals as $ClinicalsFields)
										@php
											$ClinicalsInputName=$ClinicalsFields->CategoryID.'_'.$ClinicalsFields->FieldID;	
										@endphp
										
											<div class="col-md-3">
												<label class="fields">* {{ $ClinicalsFields->FieldTitle }}</label>
											</div>
											<div class="col-md-3 input-fields">
												<input type="number" class="form-control" min="0" name="{{ $ClinicalsInputName }}">
											</div>										
										@endforeach	
									</div>	
								</div>		
							</div>
							<div class="row">	
								<div class="col-md-12">
									<button type="button" class="btn btn-outline-primary waves-effect" role="button" id="clinicals-button"><i class="fas fa-save" style="padding-right: .1em"></i> Save And Next</button>
								</div>
							</div>
						</div>
						<!-- Clinicals End -->

						<!-- Sales Ledger -->
						<div class="tab-pane fade" id="sales-ledger-tab" role="tabpanel">
							<div class="row">
								<div class="col-md-12">
									<div class="row">							
										@foreach($SalesLedger as $Sales)
										@php 
											$SalesInputName=$Sales->CategoryID.'_'.$Sales->FieldID;
										@endphp
											<div class="col-md-2">
												<label class="fields">* {{ $Sales->FieldTitle }}</label>
											</div>							
											<div class="col-md-2 input-fields">
												<input type="number" class="form-control" min="0" name="{{ $SalesInputName }}">
											</div>	
										@endforeach
									</div>	
								</div>									
							</div>
							<div class="row">	
								<div class="col-md-12">
									<button type="submit" class="btn btn-outline-primary waves-effect" role="button"><i class="fas fa-save" style="padding-right: .1em"></i> Save And Next</button>
								</div>
							</div>							
						</div>
						<!-- Sales Ledger End -->
					</div>

				</div>
				<!-- Grid column -->
			  </form>
			</div>

        </div>
        <!-- Grid row -->

      </section>
      <!-- Section: Team v.1 -->

    </div>
  </main>
  <!-- Main layout -->
@include('Common.Footer')
<script src="{{asset('assets/js/Dataentry/data_entry.js')}}"></script>
