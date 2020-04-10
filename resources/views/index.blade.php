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
        <label for="addressInput">Nombre de la ubicacion:</label>
        <input type="text" id="addressInput" size="15" />

        <label for="radiusSelect">Radio:</label>
        <select id="radiusSelect" label="Radio">
            <option value="50" selected>50 KM</option>
            <option value="30">30 KM</option>
            <option value="20">20 KM</option>
            <option value="10">10 KM</option>
        </select>

        {{-- Consultar tambien el tipo de ubicacion --}}
        <label for="typeInput">Tipo de ubicacion:</label>
        <select id="typeInput">
            @foreach ($types as $type)
                <option value="{{ $type }}">{{ $type }}</option>
            @endforeach
        </select>
        <input type="button" id="searchButton" value="Search" />
    </div>
    <div>
        <select id="locationSelect" style="width: 10%; visibility: hidden"></select>
    </div>

    {{-- Visualizacion del Mapa --}}
    <div id="map" style="width: 100%; height: 90%"></div>

    {{-- Cargar el mapa --}}
    <script src="js/helpers.js"></script>

    {{-- Metodos AJAX para guardar --}}
    <script src="js/main.js"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ $api_key }}&callback=initMap">
    </script>
</body>

</html>
