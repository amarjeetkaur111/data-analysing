<style>
	hr{
		margin: 	0 !important	;
	}
	.category-section .row{
		margin-bottom: -5px !important;
	}
	.data-section{
		font-size: 14px;
	}
	#differentdate{
		text-decoration: underline;cursor: pointer; font-size: 13px;color: #4285f4;font-style: italic;
	}
	.compareto{
		font-weight:bolder;float: right;
	}
	.multiselect{width: 20rem !important;}
	.reportform label{margin-bottom:0;}
	.report-tabs .row .col-11{box-shadow: 0 14px 28px rgb(0 0 0 / 25%), 0 10px 10px rgb(0 0 0 / 22%);
    border-radius: 5px;}
	.report-tabs .nav a{background:#c8a8a8; color:white !important;} 
	.table-dark{background:#778390 !important;}
	.report-tabs table .table-dark .top-left{border-top-left-radius:10px;border-bottom-left-radius:10px}
	.report-tabs table .table-dark .top-right{border-top-right-radius:10px;border-bottom-right-radius:10px}
	.report-tabs tbody tr th{font-weight:500;font-size:1rem;}
	.report-tabs tbody tr:hover { background: #4285f4 !important; color:white!important; box-shadow: 0px 9px 4px -6px grey; height: 55px; }
	.report-tabs tbody tr:hover td { background: transparent; color:white!important;font-size:1rem;}
	.report-chips .chip.chip-md .topvalue {background: #2c5d7e; padding: 9px 10px; border-radius: 17px; margin-left: -9px; color:white;margin-right:5px}
	.report-chips .chip{padding: 4px 12px !important ;border-radius: 20px !important;height: 40px !important;}
</style>

@Include('Common.Header')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  <!-- Main Navigation -->
-
  <!-- Main layout -->
  <main style="margin-left:0%;margin-right:0%;padding-left:0rem;padding-top:3.5rem">
    <div class="container-fluid">
      <!-- Section: Main panel -->
      <section class="mb-5">

        <!-- Card -->
        <div class="card card-cascade">

          <!-- Section: Chart -->
          <section>
      <?php 
	
      			if(isset($data['StartDate']))
						{
							if(isset($data['StartDate2'])){
								$StartDate2=$data['StartDate2'];
								$EndDate2=$data['EndDate2'];
								$displaydate2=date('m/d/Y',strtotime($StartDate2)).' - '.date('m/d/Y',strtotime($EndDate2));
							}
							$StartDate=$data['StartDate'];
							$EndDate=$data['EndDate'];
							$Prescription=$data['Prescription'];
							$Compound=$data['Compound'];
							$Clinicals=$data['Clinical'];
							$Sales=$data['Sales'];
							$pharmacy=$data['pharmacy'];
							$PharmacyID=$data['Pharmacy']['SetA'];
							$PharmacyID2=($data['Pharmacy']['SetB']) ?? null;
							$PrescriptionFields=$data['PrescriptionFields'];
							$CompoundFields=$data['CompoundFields'];
							$ClinicalFields=$data['ClinicalFields'];
							$SalesLedgerFields=$data['SalesLedgerFields'];
							$ChartData = $data['ChartData'];
							$displaydate=date('m/d/Y',strtotime($StartDate)).' - '.date('m/d/Y',strtotime($EndDate));
							// echo $data['end'];
						}else
						{
						$StartDate=date('Y-m-d');	
				  		$EndDate=date('Y-m-d');	
						$displaydate=date('m/d/Y',strtotime($StartDate)).' - '.date('m/d/Y',strtotime($EndDate));
						$PharmacyID2 = null;
				  	}

      ?>
			<form action="{{ route('DataEntryReport') }}" method="POST">
			@csrf	
			<div class="row reportform mt-n3">
				<div class="col-md-10">		
					<div class="row" style="margin-top:25px;margin-left:20px;">
						<div class="col-md-12">
							<div class="row">	
								<div class="col-md-1">
									<input type="hidden" id="compare_count" name="compare_count" value="2">
								</div>
								<div class="col-md-4">
									<label>Pharmacy</label><br>
									<select name="pharmacy1[]" class="form-control multiselectopt" multiple="multiple" required="required">
										@foreach($pharmacy as $row)
											@if(isset($PharmacyID))										
												<option value="{{ $row->PharmacyID }}" @foreach($PharmacyID as $pid){{ $pid['PharmacyID'] == $row->PharmacyID ? 'selected':'' }} @endforeach>{{ $row->PharmacyName }}</option>										
											@else
												<option value="{{ $row->PharmacyID }}">{{ $row->PharmacyName }}</option>
											@endif
										@endforeach
									</select>				
								</div>
								<div class="col-md-3">
									<label>Date</label><br>
									<input name="dates1" id="dates" data-id="1" type="text" value="{{ $displaydate }}" style="width:250px; height:35px; font-size:18px;" />
									<input name="startdate1" id="startdate1" type="hidden" value="{{ $StartDate }}"/>
									<input name="enddate1" id="enddate1" type="hidden"  value="{{ $EndDate }}"/>						
								</div>	
								<div class="col-md-3">
									<button type="button" class="btn waves-effect"  style="margin-top: 15px;"  data-toggle="modal" data-target="#filters_modal"><i class="fas fa-filter"></i> Filters</button>
				          			<!-- <button class="btn btn-primary add_recurrence p-2"><i class="fas fa-plus"></i></button>	 -->
								</div>							
							</div>		
						</div>
						<div class="col-md-12">
							<div class="row">	
								<div class="col-md-2">
								</div>
								<div class="col-md-2">
									<input type="checkbox" id="compare" name="compareto" value="1" style="pointer-events: fill;opacity: 1;margin-top: 5px; width: 30px;" @if($PharmacyID2 != '') checked @endif>
									<label for="compare" style="margin-left:30px"> Compare To</label><br>
								</div>
							</div>
						</div>
						<div class="col-md-12 comparediv" @if($PharmacyID2 != '')style="display:block" @else style="display:none" @endif>
							<div class="row">	
								<div class="col-md-1">
								</div>
								<div class="col-md-4">
									<select name="pharmacy2[]" id="pharmacy2" class="form-control multiselectopt2" multiple="multiple">
										@foreach($pharmacy as $row)
											@if(isset($PharmacyID2))										
												<option value="{{ $row->PharmacyID }}" @foreach($PharmacyID2 as $pid){{ $pid['PharmacyID'] == $row->PharmacyID ? 'selected':'' }} @endforeach>{{ $row->PharmacyName }}</option>										
											@else
												<option value="{{ $row->PharmacyID }}">{{ $row->PharmacyName }}</option>
											@endif
										@endforeach
									</select>				
								</div>
								<div class="col-md-3">
									<p id="differentdate" @if(isset($StartDate2))style="display:none" @else style="display:block" @endif >With Different Date</p>
									<div class="dateinput" @if(isset($StartDate2))style="display:block" @else style="display:none" @endif>
										<input name="dates2" id="dates" data-id="2" type="text" value="@if(isset($StartDate2)){{ $displaydate2 }}@endif" style="width:250px; height:35px; font-size:18px;" />
										<input name="startdate2" id="startdate2" type="hidden" value="@if(isset($StartDate2)){{ $StartDate2 }}@endif"/>
										<input name="enddate2" id="enddate2" type="hidden"  value="@if(isset($StartDate2)){{ $EndDate2 }}@endif"/>		
									</div>				
								</div>
								<div class="col-md-3">
									<button type="button" class="btn waves-effect" style="margin-top: 0px" data-toggle="modal" data-target="#filters_modal"><i class="fas fa-filter"></i> Filters</button>
								</div>									
							</div>		
						</div>		
					</div>
				</div>
				<div class="col-md-2">	
					<button type="submit" class="btn btn-outline-primary waves-effect float-left" style="margin-top: 40px">View Results</button>
				</div>
			</div>
		</form>
      <!-- Grid row -->
	  @if(isset($ChartData) && empty($ChartData))
		<h3 class="text-center">No Records Found</h3>	
		@endif
      <div class="row">
        <!-- Grid column -->
        <div class="col-xl-12 col-lg-12 mr-0">
          <!-- Card content -->
          <div class="card-body card-body-cascade pb-0">
				<div class="card-body card-body-cascade text-center">
					<div id="barChart" style="height: 500px;width: 100%;"></div>
				</div>
          </div>
          <!-- Card content -->
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
      <div class="row">
        <!-- Grid column -->
        <div class="col-xl-12 col-lg-12 mr-0">
          <!-- Card content -->
          <div class="card-body card-body-cascade pb-0">
						<div class="card-body card-body-cascade text-center">
							<div id="googleLineChart" style="height: 500px;width: 100%;"></div>
						</div>
          </div>
          <!-- Card content -->
        </div>
        <!-- Grid column -->
      </div>
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
											@php
												$ShowPrescheck="";
												$ShowPresuncheck="";
												if(empty($Prescription)){
													$ShowPrescheck="display:block;";
													$ShowPresuncheck="display:none;";
													$Prescription=array();
												}
												else{
													$ShowPrescheck="display:none;";
													$ShowPresuncheck="display:block;";
												}
														
											@endphp										
											<a class="check_prescription_filter" href="#" style="font-weight:500;{{ $ShowPrescheck }}"> Check All</a> <a class="uncheck_prescription_filter" href="#" style="font-weight:500;{{ $ShowPresuncheck }}"> Uncheck All</a>
											<div class="row">
											@foreach($PrescriptionFields as $Pfields)
											@php
												$PrescriptionFieldName=str_replace(' ','_',$Pfields->FieldTitle);
												$ischecked="";
												if(in_array($Pfields->FieldID,$Prescription))
												{
													$ischecked="checked=checked";
												}												
											@endphp
											<div class="col-md-4">
												<input type="checkbox" name="Prescription[]" id="{{ $PrescriptionFieldName }}"  class="prescription_filter form-check-input filled-in" value="{{ encval($Pfields->FieldID) }}" {{ $ischecked }}>
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
												@php
													$ShowCompchk="";
													$ShowCompunchk="";
													if(empty($Compound))
													{
														$ShowCompchk="display:block;";
														$ShowCompunchk="display:none;";														
														$Compound=array();
													}
													else{
														$ShowCompchk="display:none;";
														$ShowCompunchk="display:block;";
													}
												@endphp										
											<a class="check_compound_filter" href="#" style="font-weight:500;{{ $ShowCompchk }}"> Check All</a> <a class="uncheck_compound_filter" href="#" style="font-weight:500;{{ $ShowCompunchk }}"> Uncheck All</a>
												<div class="row">
												@foreach($CompoundFields as $Cfields)
												@php	
												
													$CompoundFieldName=str_replace(' ','_',$Cfields->FieldTitle);
												$compoundischecked="";
												if(in_array($Cfields->FieldID,$Compound))
												{
													$compoundischecked="checked=checked";
												}													
												@endphp												
													<div class="col-md-4">
														<input type="checkbox" name="Compound[]" id="{{ $CompoundFieldName }}" class="compound_filter form-check-input filled-in" value="{{ encval($Cfields->FieldID) }}" {{ $compoundischecked }}>
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
												@php
													$ShowClinichk="";
													$ShowCliniunchk="";
													if(empty($Clinical))
													{
														$ShowClinichk="display:block;";
														$ShowCliniunchk="display:none;";
														$Clinical=array();
													}
													else{
														$ShowClinichk="display:none;";
														$ShowCliniunchk="display:block;";
													}
												@endphp											
											 <a class="check_clinicals_filter" href="#" style="font-weight:500;{{ $ShowClinichk }}"> Check All</a> <a class="uncheck_clinicals_filter" href="#" style="font-weight:500;{{ $ShowCliniunchk }}"> Uncheck All</a>
												<div class="row">

												@foreach($ClinicalFields as $Clinicals)
												@php
												
													$ClinicalsFieldName=str_replace(' ','_',$Clinicals->FieldTitle);
												$clinicalischecked="";
												if(in_array($Clinicals->FieldID,$Clinical))
												{
													$clinicalischecked="checked=checked";
												}													
												@endphp												
													<div class="col-md-4">
														<input type="checkbox" name="Clinicals[]" id="{{ $ClinicalsFieldName }}"  class="clinicals_filter form-check-input filled-in" value="{{ encval($Clinicals->FieldID) }}" {{ $clinicalischecked }}>
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
												@php
												$ShowSaleschk="";
												$ShowSalesunchk="";
													if(empty($Sales))
													{
														$ShowSaleschk="display:block;";
														$ShowSalesunchk="display:none;";
														$Sales=array();
													}
													else{
														$ShowSaleschk="display:none;";
														$ShowSalesunchk="display:block;";
													}
												@endphp										
											<a class="check_salesledger_filter" href="#" style="font-weight:500;{{ $ShowSaleschk }}"> Check All</a> <a class="uncheck_salesledger_filter" href="#" style="font-weight:500;{{ $ShowSalesunchk }}"> Uncheck All</a>
												<div class="row">
												@php
													if(empty($Sales))
													{
														$Sales=array();
													}
												@endphp	
												@foreach($SalesLedgerFields as $sf)
												@php
												
													$SalesLedgerFieldName=str_replace(' ','_',$sf->FieldTitle);
												$salesischecked="";
												if(in_array($sf->FieldID,$Sales))
												{
													$salesischecked="checked=checked";
												}													
												@endphp													
													<div class="col-md-4">
														<input type="checkbox" name="Sales[]" id="{{ $SalesLedgerFieldName }}" class="salesledger_filter form-check-input filled-in" value="{{ encval($sf->FieldID) }}" {{ $salesischecked }}>
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
			@php
			/*-------------Chart Data-------------*/
			if(isset($ChartData) && $ChartData != null){
			@endphp
			<!------------------------Chip Listing---------------------->
			<div class="row mt-5 report-chips">
				<div class="col-11 mx-auto">
					<h5 class="text-center mb-4 font-weight-500">Top Featured</h5>
					@foreach($data['title'] as $topvalue)
					<div class="chip chip-md">
						<span class="topvalue">
							@php $x = 0; @endphp
							@foreach($topvalue['Pharmacy'] as $p)
							@if($x > 0){{'/P'.$p+1}}
							@else {{'P'.$p+1}}
							@endif					
							@php $x++; @endphp
							@endforeach
						</span> 
							{{$topvalue['field']}} - {{$topvalue['topvalue']}}
					</div>	
					@endforeach				
				</div>
			</div>		
			<!------------------------Chip Listing---------------------->
			<!------------------------Pill Data Listing---------------------->
			<!--Tab wrapper-->			
			<div class="report-tabs mb-5 mt-5">
			<div class="row">
				<div class="col-11 mx-auto">
					<ul class="nav nav-pills nav-fill nav-justified mt-3">
						@php
						$x = 0;
						foreach($data['AvailablePharmacy'] as $PharmacyID){
							
						@endphp
					<li class="nav-item" style="transition: all 0.4s ease; padding: 0 13px;">
						<a class="nav-link" data-toggle="pill" href="#pharmacy_{{$x}}" role="tab" aria-controls="pills-flamingo" aria-selected="true" style="border-radius:20px;font-weight: 700;font-size: 15px;">{{$PharmacyID}} <span style="margin-left:20px">P{{$x+1}}</span></a>
					</li>
					@php $x++; } @endphp
					</ul>
					<div class="tab-content">
						@php
						$x = 0;
						foreach($ChartData as $key){
							if($key !== '') {
						@endphp
						<div class="tab-pane fade show" id="pharmacy_{{$x}}" role="tabpanel" aria-labelledby="flamingo-tab">
							<div class="">
								<table id="datatable{{$x}}" class="table table-hover table-striped" cellspacing="0" width="100%">
									<thead class="table-dark">
										<tr>
										<th scope="col" class="top-left">Field</th>
										<th scope="col">TotalRxs</th>
										<th scope="col">TotalDollars</th>
										<th scope="col" class="top-right">DistinctPatients</th>
										</tr>
									</thead>
									<tbody>
									@foreach($key as $value)
										<tr>
										<th scope="row">{{$value['Description']}}</th>
										<td>{{$value['TotalRxs']}}</td>
										<td>{{$value['TotalDollars']}}</td>
										<td>{{$value['DistinctPatients']}}</td>
										</tr>
									@endforeach 
									</tbody>
								</table>
							</div>
						</div>
						@php $x++; }} @endphp
						<input type="hidden" id="pharmacycount" value="{{$x}}"/>
					</div>        
				</div>
			</div>
			</div>
			@php } @endphp 
			<!--Accordion wrapper-->
			<!------------------------Pill Data Listing---------------------->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{asset('assets/js/Reports/reports.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/multiselect/bootstrap-multiselect.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/multiselect/bootstrap-multiselect.min.css') }}" type="text/css"/>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
	@if(!empty($dates))
 		 toastr.info("<?php echo $dates['start'].' to '.$dates['end'];?>","Records Available From");
	@else
		toastr.info("NO Data Available");
	@endif
  $('.multiselectopt').multiselect({
        includeSelectAllOption: true,
        selectAllValue: 'select-all-value',
        maxHeight: 400,
  });
  $('.multiselectopt2').multiselect({
        includeSelectAllOption: true,
        selectAllValue: 'select-all-value',
        maxHeight: 400,
  });

  $('#differentdate').click(function(){
  	$('#differentdate').css('display','none');
  	$('.dateinput').css('display','inline-block');
  });

  $('#compare').click(function(){
	  if (this.checked) {
	  }else{
		// $('#pharmacy2').prop('selected', false);
		$('#pharmacy2').multiselect('clearSelection');
		$('#pharmacy2 option:selected').removeAttr('selected');		  
	  }
      $('.comparediv').toggle();
  });

  
  	var comparecount=$("#compare_count").val(); 
  	for(i=1;i<=comparecount;i++)
   	{ 
		   $('input[name="dates'+i+'"]').each(function(){
		   $(this).daterangepicker({
			showDropdowns: true,
			minYear: 2001,
   		    maxYear: parseInt(moment().format('YYYY'),10),
			   linkedCalendars: false,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 3 Days': [moment().subtract(2, 'days'), moment()],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				},
				"alwaysShowCalendars": true,
			}, function(start, end, label) {
			  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
			}); });
		}
		
		$('input[name="dates1"]').on('apply.daterangepicker', function(ev, picker) {
				 $('#startdate1').val(picker.startDate.format('YYYY-MM-DD'));
				 $("#enddate1").val(picker.endDate.format('YYYY-MM-DD'));
			 });

		$(".dateinput #dates").click(function(event){
			var i = $(this).attr('data-id');
			$('input[name="dates'+i+'"]').on('apply.daterangepicker', function(ev, picker) {
				 $('.dateinput input[name="dates'+i+'"]').val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
				 $('#startdate'+i).val(picker.startDate.format('YYYY-MM-DD'));
				 $("#enddate"+i).val(picker.endDate.format('YYYY-MM-DD'));
			 });
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

    // Tooltips Initialization
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })


  </script>

  <!-- Charts 2 -->
<script>
<?php if(isset($ChartData) && $ChartData != null) { ?>
$(document).ready(function () {
	google.charts.load('current', {'packages':['bar,corechart,scatter']});
	google.charts.setOnLoadCallback(showChart);
	function showChart() {
		var data = google.visualization.arrayToDataTable(

		<?php 
		echo $data['rows'];
		// $firstrow = "['Fields'";
		// 	for($t = 0;$t < count($PharmacyID); $t++)
		// 	{
		// 		$firstrow .= ",'".$PharmacyID[$t]['PharmacyName']."'";
		// 	}
		// 	$firstrow = $firstrow."]";

		// 	echo $firstrow.",";

		// 	for($i = 0; $i < count($title); $i++)
		// 	{
		// 		$lst = "['".$title[$i]."'";
		// 		foreach($datachart as $row)
		// 		{
		// 			$rowvalue = null;
		// 			foreach($row as $row)
		// 			{ 
		// 				if($title[$i] == $row['name'])
		// 				$rowvalue = $row['value'];
		// 			}
		// 			if($rowvalue == '')$lst = $lst.",null";
		// 			else $lst = $lst.",".$rowvalue;
		// 		}
		// 		$lst = $lst."]";
		// 		echo $lst.",";
		// 	}

		?>
		);

		console.log(data);
		var options = {
			title: ' Line Chart Pharmacy Wise',
			is3D: true,
			hAxis: {showTextEvery: 0},
			hAxis: {slantedText:'true'},
			hAxis: {slantedTextAngle: '70'},
			legend: { position: 'top'},
		chartArea: {
			width: "90%",
		}
		};

	var chart = new google.visualization.AreaChart(document.getElementById('googleLineChart'));
	chart.draw(data, options); 

	console.log(data);
		var options = {
			title: ' Bar Chart Pharmacy Wise',
			is3D: true,
			hAxis: {showTextEvery: 0},
			hAxis: {slantedText:'true'},
			hAxis: {slantedTextAngle: '70'},
			legend: { position: 'top'},
		chartArea: {
			width: "90%",
		},
		seriesType: 'bars',
		};
	var chart = new google.visualization.ColumnChart(document.getElementById('barChart'));
	chart.draw(data, options);  

	}
});
<?php } ?>

$(document).ready(function() {
    $('.tab-content .tab-pane:first').addClass('active');
    $('.nav-pills .nav-item .nav-link:first').addClass('active');
	var pcount = $('#pharmacycount').val();
	for(var c = 0; c < pcount; c++)
	{
		$("#datatable"+c).DataTable();
	}
});

$(function() {
  var checkbox = $("#compare");
  checkbox.change(function() {
    if (checkbox.is(':checked')) {
      $('#pharmacy2').prop('required', true); //to add required
    } else {
      $('#pharmacy2').prop('required', false); //to remove required
    }
  });
});

</script>

	