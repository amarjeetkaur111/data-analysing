@Include('Common.Header')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main style="margin-left:0%;margin-right:0%;padding-left:0rem;">
    <div class="container-fluid">

      <!-- Section: Main panel -->
      <section class="mb-5">

        <!-- Card -->
        <div class="card card-cascade narrower">

          <!-- Section: Chart -->
          <section>
			@php
				  $StartDate=date('Y-m-d');	
				  $EndDate=date('Y-m-d');	
			@endphp	
			<form action="{{ route('DataEntryReport') }}" method="POST">
			@csrf			
			<div class="row" style="margin-top:25px;margin-left:20px;">
				<div class="col-md-12">
					<div class="row">	
						<div class="col-md-3">
							<input name="dates" id="dates" type="text" value="" style="width:250px; height:35px; font-size:18px;" />
							<input name="startdate" id="startdate" type="hidden" value="{{ $StartDate }}"/>
							<input name="enddate" id="enddate" type="hidden"  value="{{ $EndDate }}"/>						
						</div>				
						<div class="col-md-3" style="margin-left: -50px">
							<select name="pharmacy[]" class="form-control multiselectopt" multiple="multiple" required="required">
								@foreach($pharmacy as $row)
									<option value="{{ $row->PharmacyID }}">{{ $row->PharmacyName }}</option>
								@endforeach
							</select>
							 @if($errors->PharmacyValidation->has('pharmacy'))	
								<span class="text-danger">{{$errors->PharmacyValidation->first('pharmacy')}}</span>
							 @endif								
						</div>	
						<div class="col-md-2">
							<button type="button" class="btn btn-outline-primary waves-effect" style="margin-top: -4px" data-toggle="modal" data-target="#filters_modal"><i class="fas fa-filter"></i> Filters</button>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-outline-primary waves-effect" style="margin-top: -4px">View Results</button>
						</div>						
					</div>		
				</div>				
			</div>
            <!-- Grid row -->
            <div class="row">

              <!-- Grid column -->
              <div class="col-xl-12 col-lg-12 mr-0">

                <!-- Card content -->
                <div class="card-body card-body-cascade pb-0">
					<div class="card-body card-body-cascade text-center">

						<canvas id="barChart" height="200px"></canvas>

					</div>
                </div>
                <!-- Card content -->

              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->
			<!----------Filters Modal------------------>
			<div class="modal fade" id="filters_modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="ModalLabel">Sort Data Entry Report Filter Wise <i class="fas fa-filter"></i></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<!-- Accordion wrapper -->
							<div class="card">
							<div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
								<!-- Accordion card -->
								<div class="row" style="margin-left:10px;margin-top:15px;">
									<div class="col-md-3">
										<a class="accordion-expand-all" href="#" style="font-weight:500;">Expand all</a>
										<a class="accordion-collapse-all" href="#" style="font-weight:500;">Collapse all</a>
									</div>
								</div>
								<div class="card">
									<!-- Card header -->
									<div class="card-header" role="tab" id="headingOne1">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="false"
										aria-controls="collapseOne1">
											<h5 class="mb-0">
												Prescription <i class="fas fa-angle-down rotate-icon"></i>
											</h5>
										</a>
									</div>

									<!-- Card body -->
									<div id="collapseOne1" class="collapse" role="tabpanel" aria-labelledby="headingOne1" data-parent="#accordionEx">
										<div class="card-body">
											<a class="check_prescription_filter" href="#" style="font-weight:500;"> Check All</a> <a class="uncheck_prescription_filter" href="#" style="font-weight:500;"> Uncheck All</a>
											<div class="row">
											@foreach($PrescriptionFields as $Pfields)
											@php
												$PrescriptionFieldName=str_replace(' ','_',$Pfields->FieldTitle);
											@endphp
											<div class="col-md-4">
												<input type="checkbox" name="Prescription[]" id="{{ $PrescriptionFieldName }}"  class="prescription_filter form-check-input filled-in" value="{{ encval($Pfields->FieldID) }}" checked="checked">
												<label class="form-check-label" for="{{ $PrescriptionFieldName }}">{{ $Pfields->FieldTitle }}</label>
											</div>
											@endforeach
											</div>
										</div>
									</div>
								</div>
								<!-- Accordion card -->
								<!-- Accordion card -->
								<div class="card">
									<!-- Card header -->
									<div class="card-header" role="tab" id="headingTwo2">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
										aria-expanded="false" aria-controls="collapseTwo2">
											<h5 class="mb-0">
												Compound <i class="fas fa-angle-down rotate-icon"></i>
											</h5>
										</a>
									</div>

									<!-- Card body -->
									<div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2" data-parent="#accordionEx">
										<div class="card-body">
											<a class="check_compound_filter" href="#" style="font-weight:500;"> Check All</a> <a class="uncheck_compound_filter" href="#" style="font-weight:500;"> Uncheck All</a>
												<div class="row">
												@foreach($CompoundFields as $Cfields)
												@php
													$CompoundFieldName=str_replace(' ','_',$Cfields->FieldTitle);
												@endphp												
													<div class="col-md-4">
														<input type="checkbox" name="Compound[]" id="{{ $CompoundFieldName }}" class="compound_filter form-check-input filled-in" value="{{ encval($Cfields->FieldID) }}" checked="checked">
														<label class="form-check-label" for="{{ $CompoundFieldName }}">{{ $Cfields->FieldTitle }}</label>
													</div>
												@endforeach	
												</div>			
										</div>
									</div>
								</div>
								<!-- Accordion card -->

								<!-- Accordion card -->
								<div class="card">

									<!-- Card header -->
									<div class="card-header" role="tab" id="headingThree3">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
										aria-expanded="false" aria-controls="collapseThree3">
											<h5 class="mb-0">
												Clinicals <i class="fas fa-angle-down rotate-icon"></i>
											</h5>
										</a>
									</div>

									<!-- Card body -->
									<div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3" data-parent="#accordionEx">
										<div class="card-body">
											 <a class="check_clinicals_filter" href="#" style="font-weight:500;"> Check All</a> <a class="uncheck_clinicals_filter" href="#" style="font-weight:500;"> Uncheck All</a>
												<div class="row">	
												@foreach($ClinicalFields as $Clinicals)
												@php
													$ClinicalsFieldName=str_replace(' ','_',$Clinicals->FieldTitle);
												@endphp												
													<div class="col-md-4">
														<input type="checkbox" name="Clinicals[]" id="{{ $ClinicalsFieldName }}"  class="clinicals_filter form-check-input filled-in" value="{{ encval($Clinicals->FieldID) }}" checked="checked">
														<label class="form-check-label" for="{{ $ClinicalsFieldName }}">{{ $Clinicals->FieldTitle }}</label>
													</div>	
												@endforeach	
												</div>			
										</div>
									</div>
								</div>
								<!-- Accordion card -->
								<!-- Accordion card -->
								<div class="card">

									<!-- Card header -->
									<div class="card-header" role="tab" id="headingfour4">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapsefour4"
										aria-expanded="false" aria-controls="collapseThree3">
											<h5 class="mb-0">
												Sales Ledger <i class="fas fa-angle-down rotate-icon"></i>
											</h5>
										</a>
									</div>

									<!-- Card body -->
									<div id="collapsefour4" class="collapse" role="tabpanel" aria-labelledby="headingfour4" data-parent="#accordionEx">
										<div class="card-body">
											<a class="check_salesledger_filter" href="#" style="font-weight:500;"> Check All</a> <a class="uncheck_salesledger_filter" href="#" style="font-weight:500;"> Uncheck All</a>
												<div class="row">	
												@foreach($SalesLedgerFields as $sf)
												@php
													$SalesLedgerFieldName=str_replace(' ','_',$sf->FieldTitle);
												@endphp													
													<div class="col-md-4">
														<input type="checkbox" name="Sales[]" id="{{ $SalesLedgerFieldName }}" class="salesledger_filter form-check-input filled-in" value="{{ encval($sf->FieldID) }}" checked="checked">
														<label class="form-check-label" for="{{ $SalesLedgerFieldName }}">{{ $sf->FieldTitle }}</label>
													</div>	
												@endforeach		
												</div>									
										</div>
									</div>
								</div>
								<div class="col-md-12 text-center">
									<button type="button" class="btn btn-outline-primary waves-effect" id="closemodal">Apply Filters</button>
								</div>
								<!-- Accordion card -->								
							</div>
							</div>
							<!-- Accordion wrapper -->
						</div>   
					</div>              
				</div>
			</div>
			<!-------------Filters Modal End----------------->
			</form>
          </section>
          <!-- Section: Chart -->

        </div>
        <!-- Card -->

      </section>
      <!-- Section: Main panel -->
    </div>
  </main>
  <!-- Main layout -->


@Include('Common.Footer');
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{asset('assets/js/Reports/reports.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/multiselect/bootstrap-multiselect.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/multiselect/bootstrap-multiselect.min.css') }}" type="text/css"/>
<script>
  $('.multiselectopt').multiselect({
        includeSelectAllOption: true,
        selectAllValue: 'select-all-value',
        maxHeight: 400,
  });
</script>

  <!-- Custom scripts -->
  <script>
    // SideNav Initialization
    $(".button-collapse").sideNav();

    var container = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(container, {
      wheelSpeed: 2,
      wheelPropagation: true,
      minScrollbarLength: 20
    });

    // Data Picker Initialization
    $('.datepicker').pickadate();

    // Tooltips Initialization
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

  </script>

  <!-- Charts 2 -->
  <script>

    //bar
    var ctxB = document.getElementById("barChart").getContext('2d');
    var myBarChart = new Chart(ctxB, {
      type: 'bar',
      data: {
        labels: [],
        datasets: [{
          label: ' ',
          data: [],
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)'
          ],
          borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        },
		legend: {
			display: false,
			labels: {
				display: false
			}
		}		
      }
    });

  </script>

