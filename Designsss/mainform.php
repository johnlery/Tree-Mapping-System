<!DOCTYPE html>
<html>
<head>
	<title>Mapping</title>
	   <!-- MAPPING JS -->
	   <style type="text/css">
	#map
 	{ height: 100%; margin: 0; padding: 0;}
	   </style>
   <script src="http://maps.google.com/maps/api/js?sensor=true&libraries=drawing,geometry&v=3.exp&signed_in=true">
   </script>
    <script>
		      function initialize(){
		         alert("ASDASD");
		        var mapOption = {
		          zoom: 10,
		          center: new google.maps.LatLng(9.796605699999999,124.2421597),
		          mapTypeId: google.maps.MapTypeId.ROADMAP,
		          disableDefaultUI: false,
		          zoomControl: true
		        };
		        var map = new google.maps.Map(document.getElementById('map'),
		      mapOption);

		    }

		      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>

<body>

	<div id="map"></div>
</body>
</html>