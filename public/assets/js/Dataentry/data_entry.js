
$('#prescription-button').click(function(){
	$("#compound-tab").tab('show');
	$('#compound_link').trigger('click');
});
$('#compound-button').click(function(){
	$("#clinicals-tab").tab('show');
	$('#clinical_link').trigger('click');
});
$('#clinicals-button').click(function(){
	$("#sales-ledger-tab").tab('show');
	$('#salesled_link').trigger('click');
});

