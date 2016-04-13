$(function() {
	$( 'form' ).submit
	(
		function()
		{
			var serializedData = $(this).serialize();
			$.ajax({
				type: 'GET',
				url: 'https://data.sparkfun.com/input/4JdvKDqR7mIqLW7ddqQ1',
				data: serializedData,
				processData: false,
				contentType: false,
				success: function(data) {
					$.ajax({
						type: 'GET',
						url: 'scripts/event.php',
						data: serializedData,
						processData: false,
						contentType: false,
						success: function(data) {
							console.log(serializedData);
							console.log(data);
							Materialize.toast(data);
						}
					});
					console.log(data);
				}
			});
			
			return false;
		}
	);
	
	
});