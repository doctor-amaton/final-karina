<<<<<<< HEAD
var map;
var markers = [];
var infoWindow;
var locationSelect;

function initMap() {
    var torreon = {
        lat: 25.527420,
        lng: -103.462730
    };
    map = new google.maps.Map(document.getElementById('map'), {
        center: torreon,
        zoom: 11,
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        }
    });
    infoWindow = new google.maps.InfoWindow();

    searchButton = document.getElementById("searchButton").onclick = searchLocations;

    locationSelect = document.getElementById("locationSelect");
=======
/**
 * Mostrar el select de ubicaciones encontradas
 */
function showLocationSelect() {
    locationSelect.style.visibility = "visible";
>>>>>>> 64698d0d434ea88699a89e61da19fd35eca2740c
    locationSelect.onchange = function () {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        google.maps.event.trigger(markers[markerNum], 'click');
    };
}

function clearLocations() {
    infoWindow.close();
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
    }
    markers.length = 0;

    locationSelect.innerHTML = "";
    var option = document.createElement("option");
    option.value = "none";
    option.innerHTML = "See all results:";
    locationSelect.appendChild(option);
}

function createMarker(latlng, name, address) {
    var html = "<b>" + name + "</b> <br/>" + address;
    var marker = new google.maps.Marker({
        map: map,
        position: latlng
    });
    google.maps.event.addListener(marker, 'click', function () {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
    });
    markers.push(marker);
}

function createOption(name, num) {
    var option = document.createElement("option");
    option.value = num;
    option.innerHTML = name;
    locationSelect.appendChild(option);
}
<<<<<<< HEAD

function downloadUrl(url, callback) {
    var request = window.ActiveXObject ?
        new ActiveXObject('Microsoft.XMLHTTP') :
        new XMLHttpRequest;

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request.responseText, request.status);
        }
    };

    request.open('GET', url, true);
    request.send(null);
}

function parseXml(str) {
    if (window.ActiveXObject) {
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
    } else if (window.DOMParser) {
        return (new DOMParser).parseFromString(str, 'text/xml');
    }
}

/*function distance(checkPoint, centerPoint) {
    var ky = 40000 / 360;
    var kx = Math.cos(Math.PI * centerPoint.lat / 180.0) * ky;
    var dx = Math.abs(centerPoint.lng - checkPoint.lng) * kx;
    var dy = Math.abs(centerPoint.lat - checkPoint.lat) * ky;
    return Math.sqrt(dx * dx + dy * dy);
}

function arePointsNear(checkPoint, centerPoint, km) {
    var ky = 40000 / 360;
    var kx = Math.cos(Math.PI * centerPoint.lat / 180.0) * ky;
    var dx = Math.abs(centerPoint.lng - checkPoint.lng) * kx;
    var dy = Math.abs(centerPoint.lat - checkPoint.lat) * ky;
    return Math.sqrt(dx * dx + dy * dy) <= km;
}*/



function doNothing() {}
=======
>>>>>>> 64698d0d434ea88699a89e61da19fd35eca2740c
