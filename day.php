<?php
// if(!isset($_SESSION['login_user'])) {
//     header("location: index.php");
// }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Project NH</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      .map {
        width:660px;
        height:500px;
      }
    </style>

    <script>

      // This example creates an interactive map which constructs a polyline based on
      // user clicks. Note that the polyline only appears once its path property
      // contains two LatLng coordinates.

      function initMap() {
        map[<?php echo $i; ?>] = new google.maps.Map(document.getElementById('map[<?php echo $i; ?>]'), {
          zoom: 7,
          center: {lat: 41.879, lng: -87.624}  // Center the map on Chicago, USA.
        });

        poly[<?php echo $i; ?>] = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        });
        poly[<?php echo $i; ?>].setMap(map[<?php echo $i; ?>]);

        // Add a listener for the click event
        map[<?php echo $i; ?>].addListener('click', addLatLng);
      }

      // Handles click events on a map, and adds a new point to the Polyline.
      function addLatLng(event) {
        var path = poly[<?php echo $i; ?>].getPath();

        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        path.push(event.latLng);

        // Add a new marker at the new plotted point on the polyline.
        var marker = new google.maps.Marker({
          position: event.latLng,
          title: '#' + path.getLength(),
          map: map[<?php echo $i; ?>]
        });
      }
    </script>
  </head>
  <body>
    <div class="col my-4">
      <label>Day <?php echo $i + 1; ?></label>
      <div class="map" id="map[<?php echo $i; ?>]"></div>
      <script>initMap();</script>
    </div>
  </body>
</html>
