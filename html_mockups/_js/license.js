$(document).ready(function() {
	_map = initializeMap();

	//keep track of the currently open infowindow so we don't open more than once
	_openWindow = null;

	createMarker(37.5218, -122.1618)
});

function initializeMap() {
	var berkeley = new google.maps.LatLng(37.5218, -122.1618);
	var mapOptions = {
	    center: berkeley,
	    zoom: 8,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	return new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}


function createMarker(lat,lon) {
	var location = new google.maps.LatLng(lat, lon);

	var markerOptions = {
		position: location,
		map: _map
	};

	var marker = new google.maps.Marker(markerOptions);
    google.maps.event.addListener(marker);
}
