var long = document.getElementById("long");
var lat = document.getElementById("lat");
var errors = document.getElementById("errors");

if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(showPosition);
} else {
	errors.innerhtml = "Geolocation is not supported by this browser.";
}

function showPosition(position) {
	lat.value = position.coords.latitude;
	long.value = position.coords.longitude; 
		
}

if (navigator.geolocation) {
    var location_timeout = setTimeout("geolocFail()", 10000);

    navigator.geolocation.getCurrentPosition(function(position) {
        clearTimeout(location_timeout);

        var lat1 = position.coords.latitude;
        var lng1 = position.coords.longitude;
		lat.value = lat1;
		long.value = lng1; 

        geocodeLatLng(lat, lng);
    }, function(error) {
        clearTimeout(location_timeout);
        geolocFail();
    });
} else {
    // Fallback for no geolocation
    geolocFail();
}

// var lat = position.coords.latitude;
// var long = position.coords.longitude;

// alert(lat);

// var htmlLong = document.getElementById('long');
// var htmlLat = document.getElementById('lat');

// htmlLong.value = "sdfsd";
// htmlLat.value = lat;