$(document).ready(function() {
    $('#lookuploc').click(function() {
        setHTML5Location();
    });
});

function setHTML5Location() {
    if (navigator.geolocation) {

        var html5TimeStamp = null;
        var html5Accuracy = null;

        navigator.geolocation.getCurrentPosition(function (position, html5Error) {
            processGeolocationResult(position);
        },error,
        {
         timeout: 5000,
         enableHighAccuracy: true,
         maximumAge: Infinity
         });
    }
    else {
        alert("Sorry, your browser does not support geolocation");
    }
}

function processGeolocationResult(position) {
    html5Lat = position.coords.latitude; //Get latitude
    html5Lon = position.coords.longitude; //Get longitude
    html5TimeStamp = position.timestamp; //Get timestamp
    html5Accuracy = position.coords.accuracy;   //Get accuracy in meters

    console.log("success " + html5Lat + ", " + html5Lon);
    $('#latlong').text(html5Lat.toString().substr(0,7) + ", " + html5Lon.toString().substr(0,7)).css('display','inline')
}
function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
};
