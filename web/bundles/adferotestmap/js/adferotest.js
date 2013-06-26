function initialize() {
    var mapOptions = {
        zoom: 2,
        center: new google.maps.LatLng(0, 0),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

    var mapData = getMapDataFromDB();
    setUpMapMarkers(map, mapData);
}

function setUpMapMarkers(map, mapData){
    mapData.forEach(function(location) {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(location.xcoordinate, location.ycoordinate),
            map: map,
            title: location.name + ": Click marker for more info."
        });

        infoWindowContent = generateInfoWindowContent(location);

        var infowindow = new google.maps.InfoWindow({
            content: infoWindowContent
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
    });
}

function generateInfoWindowContent(locationData){
    var contentString = '<div class="pop-up">'+
        '<h2>Name</h2>'+
        '<p>'+locationData.name+'</p>'+
        '<h2>X Coordinate</h2>'+
        '<p>'+locationData.xcoordinate+'</p>'+
        '<h2>Y Coordinate</h2>'+
        '<p>'+locationData.ycoordinate+'</p>'+
        '<h2>Description</h2>'+
        '<p>'+locationData.description+'</p>'+
        '</div>';

    return contentString;
}

function getMapDataFromDB(){
    var locationData = null;
    var mapDataUrl = window.location.href + 'data.php';
    mapData = $.ajax({
        type: "POST",
        url: mapDataUrl,
        data: { xCoordinate: "xcoordinate", yCoordinate: "ycoordinate", name: "name", description: "description"},
        async: false
    }).done(function (data){
            data = $.parseJSON(data);
            locationData = data;
        });
    return locationData;
}


function loadScript() {
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src =     'https://maps.googleapis.com/maps/api/js?key=AIzaSyCVOxVUl96RadHOahPNh028x_e1L1vTgok&sensor=false&' +
        'callback=initialize';
    document.body.appendChild(script);
}

window.onload = loadScript;