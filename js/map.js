function bf_map() {  

    var bf_location = new google.maps.LatLng(10.734171,122.5480874);

    var bf_map_options = {
        center: bf_location,
        zoom: 15,
    };

    var bf_map = new google.maps.Map(document.getElementById("bf_map"),
        bf_map_options);

    var bf_marker = new google.maps.Marker({
        position: bf_location,
        map: bf_map,
        title: "BF Online Service Provider",
        animation: google.maps.Animation.DROP,
    });
    bf_marker.setMap(vf_map);
}
// Initialize maps
google.maps.event.addDomListener(window, 'load', bf_map);