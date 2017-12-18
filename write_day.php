<?php
if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project NH</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="post.css" rel="stylesheet">

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="./js/service/HuskyEZCreator.js" charset="utf-8"></script>

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
          center: {lat: 37.35, lng: 127}  // Korea
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

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Project NH</a>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Write Column -->
        <div class="col my-4">
          <form action="send_day.php" method="post" id="day_form" onsubmit="temp()">
            <label>Day</label>
            <input class="form-comtrol" type="date" name="date">
            <label>Country</label>
            <select class="form-comtrol" type="text" name="country"><option>South Korea<option>Japan</select>
            <label>Money</label>
            <input class="form-comtrol" type="text" name="money">
            <div class="map" id="map" name="map"></div>
            <input class="form-comtrol" type="hidden" id="markers" name="markers">
            <textarea name="texteditor" id="texteditor" rows="10" cols="100" style="width:660px; height:500px;"></textarea>
            <input class="btn btn-primary text-white" type="button" name="action" value="Next" onclick="submitContents(this)">
            <input class="btn btn-primary text-white" type="button" name="action" value="End" onclick="submitContents(this)">
          </form>
          <script type="text/javascript">
          function temp () { return false;}
              var oEditors = [];
              nhn.husky.EZCreator.createInIFrame({
                  oAppRef: oEditors,
                  elPlaceHolder: "texteditor",
                  sSkinURI: "./SmartEditor2Skin.html",
                  fCreator: "createSEditor2"
              });

              function save_markers(json) {
                day_form.markers.value = JSON.stringify(json);
                day_form.submit();
              }

              function submitContents(elClickedObj) {
                  oEditors.getById["texteditor"].exec("UPDATE_CONTENTS_FIELD", []);

                  //map.data.toGeoJson(save_markers);
                  var markers = new Array();
                  for(var i = 0; i < count; i++) {
                    var lat = marker[i].position.lat();
                    var lng = marker[i].position.lng();
                    var name = toString(marker[i].title);
                    var obj = {"lat": lat, "lng": lng, "name": name};
                    markers[i] = obj;
                  }

                  save_markers(markers);

                  try {
                      //elClickedObj.form.submit();
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

  <?php include("aside.php"); ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

	  <?php include("footer.php"); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
