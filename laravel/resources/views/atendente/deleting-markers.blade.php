<!DOCTYPE html>
<html>
  <head>
    <title>Remove Markers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel2 {
        position: absolute;
        height: 80px;
        width: 500px;
        top: 50px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
    </style>
  </head>
  <body>
    <div id="floating-panel">
      <!-- <input onclick="clearMarkers();" type=button value="Hide Markers">
      <input onclick="showMarkers();" type=button value="Show All Markers"> -->
      <input onclick="deleteMarkers();" type=button value="Remover">
    </div>

    <div id="floating-panel2">
      <form id = "formBuscarEndereco" action = "">
        <input id="address" type="textbox" value="" style = "height: 20px; width: 400px" autofocus>
        <input id="submit" type="button" value="Buscar Endereço">
      </form>
      <button type = "button" onclick="mostrarEndereco()">Imprimir endereço</button>
    </div>

    <div id="map"></div>
    <p>Click on the map to add markers.</p>

    <script type="text/javascript" src = "/js/jquery-2.2.0.min.js">
      
    </script>

    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZlhUSjqeKmEXWMqpOV1sNKIs18dKfPgc&callback=initMap">
    </script>

    <script>

      // In the following example, markers appear when the user clicks on the map.
      // The markers are stored in an array.
      // The user can then click an option to hide, show or delete the markers.
      var map;
      var markers = [];

      function mostrarEndereco() {
        var lat = markers[0].getPosition().lat();
        var long = markers[0].getPosition().lng();

        var latlng = lat + ',' + long;

        $.get('https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latlng +'&key=AIzaSyCZlhUSjqeKmEXWMqpOV1sNKIs18dKfPgc', {}, function(data) {
          console.log(data);
        }); 
        //utiliza o geocode inverso pra obter o endereço
      }

      function initMap() {
        var haightAshbury = {lat: -16.686882, lng: -49.264789};

        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: haightAshbury,
        });

        var geocoder = new google.maps.Geocoder();

        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
          addMarker(event.latLng);
        });

        //limita a região
        var strictBounds = new google.maps.LatLngBounds(
          new google.maps.LatLng(-16.8178728, -49.394875),
          new google.maps.LatLng(-16.581105,  -49.152489) 
        );

        // Adds a marker at the center of the map.
        addMarker(haightAshbury);

        document.getElementById('submit').addEventListener('click', function() {
          geocodeAddress(geocoder, map);
        });
      }


      //busca filtrada
      function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        var endereco = {
          'address': address + "Goiania, Brasil",
          'region': 'BR'
        };

        geocoder.geocode(endereco, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var location = results[0].geometry.location;
            addMarker(location);

          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

      // Adds a marker to the map and push to the array.
      function addMarker(location) {
        clearMarkers();
        var marker = new google.maps.Marker({
          position: location,
          map: map,
        });
        markers = [];
        markers.push(marker);
       
      }

     
      // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
      }

      // Removes the markers from the map, but keeps them in the array.
      function clearMarkers() {
        setMapOnAll(null);
      }

      // Deletes all markers in the array by removing references to them.
      function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
    </script>
  </body>
</html>