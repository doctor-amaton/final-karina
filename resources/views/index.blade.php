<!DOCTYPE html>
<html>
<head>
	<title>Place Selector</title>
</head>
<body>
	<div>
         <label for="raddressInput">Search location</label>
         <br>
         <label for="typeInput">Type:</label>
         <input type="text" id="addressInput" size="15"/>

        <label for="radiusSelect">Radius:</label>
        <select id="radiusSelect" label="Radius">
          <option value="50" selected>50 kms</option>
          <option value="30">30 kms</option>
          <option value="20">20 kms</option>
          <option value="10">10 kms</option>
        </select>

        <input type="button" id="searchButton" value="Search"/>
    </div>

    <!--<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap">
    </script>-->

    <!--<script async defer
    src="https://maps.googleapis.com/maps/api/place/nearbysearch/json?key=API&location=25.527420,-103.462730&radius=radiusSelect&type=addressInput&keyword=sushi">	
    </script>-->

</body>
</html>