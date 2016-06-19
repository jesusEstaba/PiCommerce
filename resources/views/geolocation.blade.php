<script   src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

{{ csrf_field() }}
<button onclick="getPosition();">how far?</button>

<script language="javascript">
	function getPosition () {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(getDistance);
		} else {
			alert("tu navegador no soporta la geolocalizaion");
		}
	}

	function getDistance(position) {
		position = position.coords;

		if (position.latitude && position.longitude) {
			$.ajax({
				url: '/calculate',
				type: 'POST',
				dataType: 'json',
				headers: { 'X-CSRF-TOKEN': $('[name=_token]').val() },
				data: {
					latitude:position.latitude,
					longitude:position.longitude.toFixed(7)
				},
			})
			.done(function(data) {
				var respuesta = data.rows[0].elements[0];
				if (respuesta.status == "OK") {
					console.log(respuesta.distance.text);
					alert('distance to the restaurant '+ respuesta.distance.text);
				} else {
					console.log("ZERO_RESULTS");
				}
			})
			.fail(function() {
				console.log("error");
			});
		} else {
			console.log("No se pudo localizar");
		}
	}
</script>