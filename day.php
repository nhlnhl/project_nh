<?php
if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

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

      var map;
      var poly;
      var marker = new Array();
      var count = 0;

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 7,
          center: {lat: 41.879, lng: -87.624}  // Center the map on Chicago, USA.
        });

        poly = new google.maps.Polyline({
          strokeColor: '#000000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        });
        poly.setMap(map);

        // Add a listener for the click event
        map.addListener('click', addLatLng);
      }

      // Handles click events on a map, and adds a new point to the Polyline.
      function addLatLng(event) {
        var path = poly.getPath();

        // Because path is an MVCArray, we can simply append a new coordinate
        // and it will automatically appear.
        path.push(event.latLng);

        // Add a new marker at the new plotted point on the polyline.
        marker[count] = new google.maps.Marker({
          position: event.latLng,
          title: '#' + path.getLength(),
          map: map
        });

        count++;
      }
    </script>
  </head>
  <body>
    <div class="col my-4">
      <form action="send_day.php" method="post" id="day_form">
        <label>Day</label>
        <input class="form-comtrol" type="date" name="date">
        <label>Country</label>
        <select class="form-comtrol" type="text" name="country"><option>South Korea<option>Japan</select>
        <label>Money</label>
        <input class="form-comtrol" type="text" name="money">
        <select class="form-comtrol" type="text" name="money_unit"><option>Won<option>Yen</select>
        <div class="map" id="map" name="map"></div>
        <textarea name="texteditor" id="texteditor" rows="10" cols="100" style="width:660px; height:500px;"></textarea>
        <a class="btn btn-primary" href="send_day.php" value="Submit" onclick="submitContents(this)">Next</a>
      </form>
      <script type="text/javascript">
          var oEditors = [];
          nhn.husky.EZCreator.createInIFrame({
              oAppRef: oEditors,
              elPlaceHolder: "texteditor",
              sSkinURI: "./SmartEditor2Skin.html",
              fCreator: "createSEditor2"
          });

          function submitContents(elClickedObj) {
              oEditors.getById["texteditor"].exec("UPDATE_CONTENTS_FIELD", []);

              try {
                  elClickedObj.form.submit();
              } catch(e) {
              }
          }

          function pasteHTML(filepath) {
            var sHTML = '<img src="<%=request.getContextPath()%>' + filepath + '">';
            oEditors.getById["textAreaContent"].exec("PASTE_HTML", [sHTML]);
          }
      </script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeZibfZQe5ngRJF6h41_12BSknR4M4zRE&callback=initMap"></script>
    </div>
  </body>
</html>
