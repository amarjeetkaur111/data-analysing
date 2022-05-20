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
</style>

@Include('Common.Header')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <!-- Main Navigation -->

  <!-- Main layout -->
  <main style="margin-left:0%;margin-right:0%;padding-left:0rem;">
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
							$StartDate=$data['StartDate'];
							$EndDate=$data['EndDate'];
							$Prescription=$data['Prescription'];
							$Compound=$data['Compound'];
							$Clinicals=$data['Clinical'];
							$Sales=$data['Sales'];
							$pharmacy=$data['pharmacy'];
							$PharmacyID=$data['PharmacyID'];
							$PrescriptionFields=$data['PrescriptionFields'];
							$CompoundFields=$data['CompoundFields'];
							$ClinicalFields=$data['ClinicalFields'];
							$SalesLedgerFields=$data['SalesLedgerFields'];
							$ChartData = $data['ChartData'];
							$displaydate=date('m/d/Y',strtotime($StartDate)).' - '.date('m/d/Y',strtotime($EndDate));
						}else
						{
						$StartDate=date('Y-m-d');	
				  	$EndDate=date('Y-m-d');	
						$displaydate=date('m/d/Y',strtotime($StartDate)).' - '.date('m/d/Y',strtotime($EndDate));

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
				          <button class="btn btn-primary add_recurrence p-2"><i class="fas fa-plus"></i></button>	
								</div>							
							</div>		
						</div>
						<div class="col-md-12">
							<div class="row">	
								<div class="col-md-2">
								</div>
								<div class="col-md-2">
									<input type="checkbox" id="compare" name="compareto" value="1" style="pointer-events: fill;opacity: 1;margin-top: 5px; width: 30px;">
									<label for="compare" style="margin-left:30px"> Compare To</label><br>
								</div>
							</div>
						</div>
						<div class="col-md-12 comparediv" style="display:none">
							<div class="row">	
								<div class="col-md-1">
								</div>
								<div class="col-md-4">
									<select name="pharmacy2[]" class="form-control multiselectopt" multiple="multiple" required="required">
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
									<p id="differentdate">With Different Date</p>
									<div class="dateinput" style="display: none;">
										<input name="dates2" id="dates" data-id="2" type="text" value="" style="width:250px; height:35px; font-size:18px;" />
										<input name="startdate2" id="startdate2" type="hidden" value=""/>
										<input name="enddate2" id="enddate2" type="hidden"  value=""/>		
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
      <div class="row">
        <!-- Grid column -->
        <div class="col-xl-12 col-lg-12 mr-0">
          <!-- Card content -->
          <div class="card-body card-body-cascade pb-0">
						<div class="card-body card-body-cascade text-center">
							<canvas id="barChart" height="130px"></canvas>
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
			<!------------------------Data Listing---------------------->
			<!--Accordion wrapper-->
			<div class="row">
				<div class="col-xl-11 col-lg-11 mx-auto">
					<div class="accordion md-accordion accordion-1" id="accordion" role="tablist">
						@php
		          /*-------------Chart Data-------------*/
		          if(isset($ChartData) && $ChartData != null)
		          {
		            $datachart=array();
		            $title=array();
		            $p = 0;
		            $googleChartData = $ChartData;
		            foreach($ChartData as $row)
		            {
		              foreach($row as $row)
		              {
		               $datachart[$p][] = array(
		                  'name' => $row['Description'],
		                  'value' => $row['TotalRxs']
		                );    
		              } 
		              $p++;   
		            }
		            
		            $mergechart = call_user_func_array("array_merge", $datachart);
		            foreach($mergechart as $list)
		            {

		              $title[] = $list['name'];;
		            }
		            
		            $title = array_unique($title,SORT_REGULAR);		            
		            $titlejson = json_encode($title);
		            $datachartjson = json_encode($datachart);
		            $pharmacylistjson = json_encode($PharmacyID); 
		            $x = 0;
		            foreach($ChartData as $ChartData){
		       $x++;

		        @endphp
					  <div class="card">
					    <div class="card-header gradient-card-header blue-gradient" role="tab" id="heading_{{$x}}">
					        <a class="collapsed font-weight-bold white-text" data-toggle="collapse" href="#collapse_{{$x}}"
					          aria-expanded="false" aria-controls="collapse_{{$x}}">
					      		<h5 class="text-uppercase mb-0 py-1">					          
					          	{{$PharmacyID[$x-1]['PharmacyName']}}
					      			<i class="fas fa-angle-down rotate-icon"></i>
					      		</h5>
					        </a>
					    </div>
					    <div id="collapse_{{$x}}" class="collapse" role="tabpanel" aria-labelledby="heading_{{$x}}"
					      data-parent="#accordion">
					      <div class="card-body">
					        <div class="col-md-11 mx-auto data-section" style="margin-top:40px;margin-bottom:50px;">  
						        <div class="row">
						        <!-- @php
						          if(!empty($DataEntryReport['PrescriptionReport'])){
						        @endphp
						          <div class="col-md-3" style="border:1px solid black;">
						            <div class="row catgory-title">  
						              <div class="col-md-10 view view-cascade gradient-card-header blue-gradient">
						                <label style="font-weight:500;color: #fff;">Prescription</label>
						              </div>
						            </div>
						            @foreach($DataEntryReport['PrescriptionReport'] as $PrescripFields)
						            @php
						              $PrescriptionFieldName=$PrescripFields['Title'];
						            @endphp
						            <hr>
						            <div class="row">
						              <div class="col-md-8">
						                <p class="fields_names">{{ $PrescriptionFieldName }}</p>
						              </div>  
						              <div class="col-md-4">
						                <p>{{ $PrescripFields['TotalSum'] }}</p>
						              </div>  
						            </div>
						            @endforeach 
						          </div>
						        @php  
						          }
						        @endphp  -->
						        <!-- @php
						          if(!empty($DataEntryReport['CompoundReport'])){
						        @endphp       
						          <div class="col-md-3" style="border:1px solid black;">
						            <div class="row catgory-title">  
						              <div class="col-md-10 view view-cascade gradient-card-header blue-gradient">
						                <label style="font-weight:500;color: #fff;">Compound</label>
						              </div>
						            </div>
						            @foreach($DataEntryReport['CompoundReport'] as $ComFields)
						            @php
						              $CompoundFieldName=$ComFields['Title'];
						            @endphp 
						            <hr>  
						            <div class="row">
						              <div class="col-md-8">
						                <p class="fields_names">{{ $CompoundFieldName }}</p>
						              </div>  
						              <div class="col-md-4">
						                <p>{{ $ComFields['TotalSum'] }}</p>
						              </div>              
						            </div>
						            @endforeach
						          </div>
						        @php  
						          }
						        @endphp  -->
						       <!--  @php
						          if(!empty($DataEntryReport['ClinicalReport'])){
						        @endphp         
						          <div class="col-md-3" style="border:1px solid black;">
						            <div class="row catgory-title">  
						              <div class="col-md-10 view view-cascade gradient-card-header blue-gradient">
						                <label style="font-weight:500;color: #fff;">Clinicals</label>
						              </div>
						            </div>  
						            @foreach($DataEntryReport['ClinicalReport'] as $ClinicFields)
						            @php
						              $ClinicalsFieldName=$ClinicFields['Title'];
						            @endphp
						            <hr>  
						            <div class="row">
						              <div class="col-md-8">
						                <p class="fields_names">{{ $ClinicalsFieldName }}</p>
						              </div>  
						              <div class="col-md-4">
						                <p>{{ $ClinicFields['TotalSum'] }}</p>
						              </div>              
						            </div>
						            @endforeach 
						          </div>
						        @php  
						          }
						        @endphp -->
						        <!-- @php
						          if(!empty($DataEntryReport['SalesReport'])){
						        @endphp       
						          <div class="col-md-3" style="border:1px solid black;">
						            <div class="row catgory-title">  
						              <div class="col-md-10 view view-cascade gradient-card-header blue-gradient">
						                <label style="font-weight:500;color: #fff;">Sales Ledger</label>
						              </div>
						            </div>
						            @foreach($DataEntryReport['SalesReport'] as $SalesledFields)
						            @php
						              $SalesFieldName=$SalesledFields['Title'];
						            @endphp 
						            <hr>  
						            <div class="row">
						              <div class="col-md-8">
						                <p class="fields_names">{{ $SalesFieldName }}</p>
						              </div>  
						              <div class="col-md-4">
						                <p>{{ $SalesledFields['TotalSum'] }}</p>
						              </div>              
						            </div>  
						            @endforeach 
						          </div>
						        @php  
						          }
						        @endphp --> 				        
						        @php    
						          foreach($ChartData as $key => $value){
						        @endphp 				        
						          <div class="col-md-3 category-section" style="border:1px solid black;margin-top:15px;">
						            <div class="row catgory-title">  
						              <div class="col-md-10 view view-cascade gradient-card-header blue-gradient py-1">
						                <label class="mb-0" style="font-weight:500;color: #fff;">{{ $value['Description'] }}</label>
						              </div>
						            </div>
						            <hr>  
						            <div class="row">
						              <div class="col-md-8">
						                <p class="fields_names">TotalRxs</p>
						              </div>  
						              <div class="col-md-4">
						                <p>{{ $value['TotalRxs'] }}</p>
						              </div>              
						            </div>
						            <hr>
						            <div class="row">
						              <div class="col-md-8">
						                <p class="fields_names">TotalDollars</p>
						              </div>  
						              <div class="col-md-4">
						                <p>{{ $value['TotalDollars'] }}</p>
						              </div>              
						            </div>  
						            <hr>
						            <div class="row">
						              <div class="col-md-8">
						                <p class="fields_names">DistinctPatients</p>
						              </div>  
						              <div class="col-md-4">
						                <p>{{ $value['DistinctPatients'] }}</p>
						              </div>              
						            </div>              
						          </div>
						        @php
						          }
						        @endphp         
						        </div>
						      </div>
					      </div>
					    </div>
					  </div>
					  @php
		        }
		       }
		        @endphp 
					</div>
				</div>
			</div>
			<!--Accordion wrapper-->
			<!------------------------Data Listing---------------------->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{asset('assets/js/Reports/reports.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/multiselect/bootstrap-multiselect.min.js')}}"></script>
<link rel="stylesheet" href="{{ asset('assets/css/multiselect/bootstrap-multiselect.min.css') }}" type="text/css"/>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script>
  $('.multiselectopt').multiselect({
        includeSelectAllOption: true,
        selectAllValue: 'select-all-value',
        maxHeight: 400,
  });

  $('#differentdate').click(function(){
  	$('#differentdate').css('display','none');
  	$('.dateinput').css('display','inline-block');
  });

  $('#compare').click(function(){
      $('.comparediv').toggle();
  });

  
  	var comparecount=$("#compare_count").val(); 
  	for(i=1;i<=comparecount;i++)
   	{ 
		   $('input[name="dates'+i+'"]').daterangepicker({
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
			});
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
	var ChartData="";	
	ChartData= <?=$datachartjson?>;
	PharmacyList = <?=$pharmacylistjson?>;
	console.log(ChartData);
	var pillars=[];
	var titles=<?=$titlejson?>;
	console.log(titles);
	for(var j in ChartData)
	{
		pillars[j] = [];
		for(var i in ChartData[j]){
			pillars[j].push(ChartData[j][i].value);
		}
	}
	console.log(PharmacyList);

	const colors = [
  '#0099ff',
  '#ff4d4d',
  '#33cc33',
  '#ff99cc',
  '#ffd633',
  '#db4dff',
  '#ff80bf'
]
    var myBarChartData = {
		  labels: titles,
		  datasets: []
		};

    for (var i = 0; i < pillars.length; i++) {
	  myBarChartData.datasets.push(
	  	{
	  		label: PharmacyList[i].PharmacyName,
	      backgroundColor: colors[i % colors.length],
	      data: Object.values(pillars[i])
	    	}
		  )
		}
 		var myBarChartOptions = {
      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }],
		  xAxes:[{
			  ticks:{
				   autoSkip: false
			  },
         gridLines: {
            display: true,
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
  }
  var ctxB = document.getElementById("barChart").getContext('2d');
  var myBarChart = new Chart(ctxB, {
    type: 'bar',
	  data: myBarChartData,
	  options: myBarChartOptions
  });

});

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(showBarChart);
			function showBarChart() {
				var data = google.visualization.arrayToDataTable([

				<?php 
				$firstrow = "['Fields'";
					for($t = 0;$t < count($PharmacyID); $t++)
					{
						$firstrow .= ",'".$PharmacyID[$t]['PharmacyName']."'";
					}
					$firstrow = $firstrow."]";

					echo $firstrow.",";

					for($i = 0; $i < count($title); $i++){
						$lst = "['".$title[$i]."'";
						foreach($datachart as $row)
				    {
							$rowvalue = '';
				      foreach($row as $row)
				      { 
				      	if($title[$i] == $row['name'])
				      		$rowvalue = $row['value'];
							}
							$lst = $lst.",".$rowvalue;
						}
						$lst = $lst."]";
						echo $lst.",";
					}

				?>
	]);

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

  var chart = new google.visualization.LineChart(document.getElementById('googleLineChart'));
  chart.draw(data, options);  
}
<?php } ?>
</script>

