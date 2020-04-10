<!DOCTYPE html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <title>Busqueda de ubicaciones de Karina Delgado</title>

    <link rel="stylesheet" href="css/index/index.css">
    <script src="js/vendor/jquery-3.4.1.js"></script>
</head>

<body style="margin:0px; padding:0px;" onload="initMap()">
    <div>
        <label for="raddressInput">Search location:</label>
        <input type="text" id="addressInput" size="15" />
        <label for="radiusSelect">Radius:</label>
        <select id="radiusSelect" label="Radius">
            <option value="50" selected>50 kms</option>
            <option value="30">30 kms</option>
            <option value="20">20 kms</option>
            <option value="10">10 kms</option>
        </select>

        <input type="button" id="searchButton" value="Search" />
    </div>
    <div><select id="locationSelect" style="width: 10%; visibility: hidden"></select></div>
    <div id="map" style="width: 100%; height: 90%"></div>

    {{-- Cargar el mapa --}}
    <script src="js/helpers.js"></script>

    {{-- Metodos AJAX para guardar --}}
    <script src="js/main.js"></script>

    {{-- TODO: agregar el  --}}
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=initMap">
    </script>
</body>

</html>
