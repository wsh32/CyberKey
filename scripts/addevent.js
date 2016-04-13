$(function() {
	$( 'form' ).submit
	(
		function()
		{
			$.ajax({
				type: 'GET',
				url: 'scripts/addevent.php',
				data: $(this).serialize(),
				processData: false,
				contentType: false,
				success: function(data) {
					Materialize.toast(data);
				},
				error: function(data)	{
					Materialize.toast(this);
				}
			});
			return false;
		}
	);
});