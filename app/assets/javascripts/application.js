// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// or vendor/assets/javascripts of plugins, if any, can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear at the bottom of the
// compiled file.
//
// Read Sprockets README (https://github.com/sstephenson/sprockets#sprockets-directives) for details
// about supported directives.
//
//= require jquery
//= require jquery.dd.min
//= require jquery_ujs
//= require jquery.dataTables
//= require turbolinks
//= require_tree .


$(document).ready(function() {
    $('.datatable').dataTable();

     $('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
 
        // Show/Hide Tabs
        $('.tabs ' + currentAttrValue).show().siblings().hide();
		// $('.tabs ' + currentAttrValue).fadeIn(400).siblings().hide();

        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });

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
