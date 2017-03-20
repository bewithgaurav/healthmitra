var map;
var infoWindow;
var service;

//function to add infowindow to marker on click
function addInfoWindow(marker, message,myLatLng,i) {
var infoWindow = new google.maps.InfoWindow({
    content: ""
});
       var geocoder = new google.maps.Geocoder;
        google.maps.event.addListener(marker, 'click', function () {
			geocodeLatLng(geocoder, map,marker, infoWindow,myLatLng,i);
			//infoWindow.open(map, marker);
        });
}

//function to reverse geocode
function geocodeLatLng(geocoder, map,marker, infoWindow,myLatLng,i) {
	      infoWindow.setContent(a[i][2]+'\n'+a[i][3]+'\n');
	      infoWindow.open(map, marker);
	    
}


//initialize and set markers on map
function initialize() {
	map = new google.maps.Map(document.getElementById('map-canvas'), {
	  zoom: 5,
	  center: new google.maps.LatLng(28.459497,77.026638),
	  mapTypeId: google.maps.MapTypeId.TERRAIN
	});

	var l=a.length;
	console.log(a);
	
	var bounds = new google.maps.LatLngBounds();
	for(var k=0;k<l;k++)
	{
		var lat=a[k][0];
		var lng=a[k][1];
		//alert(lat);
		//alert(lng);
		var myLatLng =new google.maps.LatLng(lat,lng);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map
		});
		bounds.extend(myLatLng);
		addInfoWindow(marker,'j',myLatLng,k);
		
	}
	map.fitBounds(bounds);

}
google.maps.event.addDomListener(window, 'load', initialize);