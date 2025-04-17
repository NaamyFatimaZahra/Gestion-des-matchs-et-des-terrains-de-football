
function showMap(lat, lng) {
    let latitude = Number(lat);
    let longitude = Number(lng);
    console.log(typeof longitude);

    var mylatlng = {
        lat: latitude,
        lng: longitude,
    };
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: mylatlng,
    });
    new google.maps.Marker({
        position: mylatlng,
        map,
    });
}
