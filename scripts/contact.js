$(function() {
	$( 'form' ).submit
	(
		function()
		{
			$.ajax({
				type: 'GET',
				url: 'https://data.sparkfun.com/input/o85GgGEzV6S9XvWXQoZD',
				data: $(this).serialize(),
				processData: false,
				contentType: false,
				success: function(data) {
					console.log(data);
					Materialize.toast("Thank you for your submission. ☺");
				}
			});
			return false;
		}
	);
});
