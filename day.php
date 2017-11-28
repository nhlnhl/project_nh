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
      <input class="form-comtrol" type="date" name="date[<?php echo $i; ?>]">
      <label>Country</label>
      <select class="form-comtrol" type="text" name="country[<?php echo $i; ?>]"><option>South Korea<option>Japan</select>
      <label>Money</label>
      <input class="form-comtrol" type="text" name="money[<?php echo $i; ?>]">
      <select class="form-comtrol" type="text" name="money_unit[<?php echo $i; ?>]"><option>Won<option>Yen</select>
      <div class="map" id="map[<?php echo $i; ?>]" name="map[<?php echo $i; ?>"]></div>
      <textarea name="texteditor[<?php echo $i; ?>]" id="texteditor[<?php echo $i; ?>]" rows="10" cols="100" style="width:660px; height:500px;"></textarea>
      <script type="text/javascript">
          var oEditors = [];
          nhn.husky.EZCreator.createInIFrame({
              oAppRef: oEditors,
              elPlaceHolder: "texteditor[<?php echo $i; ?>]",
              sSkinURI: "./SmartEditor2Skin.html",
              fCreator: "createSEditor2"
          });

          function submitContents(elClickedObj) {
              oEditors.getById["texteditor[<?php echo $i; ?>]"].exec("UPDATE_CONTENTS_FIELD", []);

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
      <script>initMap();</script>
    </div>
  </body>
</html>
