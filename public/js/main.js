/**
 * main.js
 *
 * Archivo principal para todas las funciones globales de JavaScript
 */
let map;
let markers = [];
let infoWindow;
let locationSelect;

/**
 * Centrar el mapa en el Tec Laguna, definir el uso del boton de buscar
 */
function initMap() {
    var itl = {
        lat: 25.535365,
        lng: -103.435297
    };
    map = new google.maps.Map(document.getElementById('map'), {
        center: itl,
        zoom: 11,
        mapTypeId: 'roadmap',
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        }
    });
    infoWindow = new google.maps.InfoWindow();

    searchButton = document.getElementById("searchButton").onclick = searchLocations;

    locationSelect = document.getElementById("locationSelect");
    locationSelect.onchange = function () {
        var markerNum = locationSelect.options[locationSelect.selectedIndex].value;
        if (markerNum != "none") {
            google.maps.event.trigger(markers[markerNum], 'click');
        }
    };
}

/**
 * Validar los parametros e iniciar la consulta
 */
function searchLocations() {
    const keyword = document.getElementById("addressInput").value;
    const radius = document.getElementById("radiusSelect").value;
    const type = document.getElementById("typeInput").value;

    if (radius > 50 || radius < 10) {
        alert("El radio especificado es demasiado grande o demasiado pequeño");
        return;
    }

    if (!keyword) {
        alert("No especifico ninguna palabra clave a consultar");
        return;
    }

    /* Realizar la consulta remota */
    findLocationsNear({ keyword, radius, type });
}

/**
 * Llamar a nuestro servidor de PHP para generar la consulta
 * usando la latitud y longitud del centro del mapa actual
 *
 * @param parameters Lista de parametros para la URL, keyword, tipo etc
 */
function findLocationsNear(parameters) {
    /* Borrar los resultados que ya tengamos */
    clearLocations();

    $.ajax({
        type: "GET",
        url: "api/places/locations",
        data: { ...parameters }, /* Enviar los parametros completos, se asume que ya estan validados */

        /**
         * Meter los marcadores en el mapa
         */
		success: (response) => {
			const bounds = new google.maps.LatLngBounds();

            response.results.forEach((result, index) => {
                const latlng = new google.maps.LatLng(result.lat, result.lng);

                createOption(result.name, index);
                createMarker(latlng, result.name, result.formatted_address);

                bounds.extend(latlng);
            });

            /* Ampliar las puntas del mapa */
            map.fitBounds(bounds);
            showLocationSelect();
        },

        /**
         * Ocurrio algun problema, mostramos el mensaje de error
         */
        error: (response) => {
            alert(response.message);
        }
    });
}
