$(function() {
	$( 'form' ).submit
	(
		function()
		{
			var fd = new FormData();
			fd.append('firstname', $('[name="firstname"]').prop('value'));
			fd.append('lastname', $('[name="lastname"]').prop('value'));
			fd.append('pic', $('[name="pic"]'));
			$.ajax({
				type: 'POST',
				url: 'photochallenge/submit.php',
				data: fd,
				dataType: 'JSON',
				processData: false,
				contentType: false,
				success: function(data) {
					Materialize.toast(data, 4000);
					console.log(data);
				},
				error: function(data)	{
					console.log(data);
				}
			});
			return false;
		}
	);
});
