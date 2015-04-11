$(function() {
	$( 'form' ).submit
	(
		function()
		{
			$.ajax({
				type: 'GET',
				url: 'https://data.sparkfun.com/input/4JdvKDqR7mIqLW7ddqQ1',
				data: $(this).serialize(),
				processData: false,
				contentType: false,
				success: function(data) {
					console.log(data);
					$( '#response' ).empty();
					$( '#response' ).text( 'Thank you for signing up!' ).css( 'color', 'blue' ).show().fadeOut( 20000 );
				}
			});
			return false;
		}
	);
});