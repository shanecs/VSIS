$('#patient').change(function() {
	$('#instruction').empty();
	$('#instruction').load('scripts/get_instructions.php?CaseID=' + $('#patient').val());
	$('#instruction').prop("disabled", false);
});

$('#instruction').change(function() {
	if($('#instruction').val() != null) {
		$('#value').prop("disabled", false);
	}
});

$('#reset').click(function() {
	$('#instruction').empty();
	$('#value').val(null)
	$('#instruction').prop("disabled", true);
	$('#value').prop("disabled", true);
});
