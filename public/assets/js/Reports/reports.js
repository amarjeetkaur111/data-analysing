
$(document).ready(function() {
	var GetPath=window.location.pathname.split('/');
/*----------------------Date Range Picker Initialization------------------*/               
	$('input[name="dates"]').daterangepicker({
		ranges: {
			'Today': [moment(), moment()],
			'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		"alwaysShowCalendars": true,
		}, function(start, end, label) {
			 console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
		});

/*---------------Reports Filters-------------------*/
	var expandLink = $('.accordion-expand-all');
		var collapseLink = $('.accordion-collapse-all');
		$(".accordion-collapse-all").hide();
		// hook up the expand/collapse all
		expandLink.click(function(){
			$(".collapse").show();
			$(".accordion-expand-all").hide();
			$(".accordion-collapse-all").show();
		});
		collapseLink.click(function(){
			$(".collapse").hide();
			$(".accordion-collapse-all").hide();
			$(".accordion-expand-all").show();
		});	
/*-----------------------------------------------*/
             //Prescription
			if(GetPath.includes("dataentry_report")){			 

			}
			else{
				$(".check_prescription_filter").hide();
				$(".check_compound_filter").hide();
				$(".check_clinicals_filter").hide();
				$(".check_salesledger_filter").hide();
			}
			 // Check All
             $('.check_prescription_filter').click(function() {
                 $(".prescription_filter").prop("checked", true);
				 $(".check_prescription_filter").hide();
				 $(".uncheck_prescription_filter").show();
             });
             // Uncheck All
             $('.uncheck_prescription_filter').click(function() {
                 $(".prescription_filter").prop("checked", false);
				 $(".check_prescription_filter").show();
				 $(".uncheck_prescription_filter").hide();
             });
			 
			 //Compound

			 // Check All
             $('.check_compound_filter').click(function() {
                 $(".compound_filter").prop("checked", true);
				 $(".check_compound_filter").hide();
				 $(".uncheck_compound_filter").show();
             });
             // Uncheck All
             $('.uncheck_compound_filter').click(function() {
                 $(".compound_filter").prop("checked", false);
				 $(".check_compound_filter").show();
				 $(".uncheck_compound_filter").hide();
             });
			 
			 //Clinicals

			 // Check All
             $('.check_clinicals_filter').click(function() {
                 $(".clinicals_filter").prop("checked", true);
				 $(".check_clinicals_filter").hide();
				 $(".uncheck_clinicals_filter").show();
             });
             // Uncheck All
             $('.uncheck_clinicals_filter').click(function() {
                 $(".clinicals_filter").prop("checked", false);
				 $(".check_clinicals_filter").show();
				 $(".uncheck_clinicals_filter").hide();
             });
			 
			 //Sales Ledger

			 // Check All
             $('.check_salesledger_filter').click(function() {
                 $(".salesledger_filter").prop("checked", true);
				 $(".check_salesledger_filter").hide();
				 $(".uncheck_salesledger_filter").show();
             });
             // Uncheck All
             $('.uncheck_salesledger_filter').click(function() {
                 $(".salesledger_filter").prop("checked", false);
				 $(".check_salesledger_filter").show();
				 $(".uncheck_salesledger_filter").hide();
             });
/*-----------------------------------------------*/
$('#closemodal').click(function() {
    $('#filters_modal').modal('hide');
});
});
			
$('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
	$('#startdate').val(picker.startDate.format('YYYY-MM-DD'));
	$('#enddate').val(picker.endDate.format('YYYY-MM-DD'));
});
			
