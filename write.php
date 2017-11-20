<?php
// if(!isset($_SESSION['login_user'])) {
//     header("location: index.php");
// }

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project NH</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="post.css" rel="stylesheet">

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="./js/service/HuskyEZCreator.js" charset="utf-8"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAeZibfZQe5ngRJF6h41_12BSknR4M4zRE"></script>

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
        <div class="col-lg-8">
          <form action="send_db.php" method="post" id="write_form">
            <table class="my-4">
              <tr>
                <td><span style="width:30px; height:25px; font-size:10pt;">Title</span></td>
                <td><input name="title" id="title" style="width:640px; height:25px;"/></td>
              </tr>
              <tr>
                <td colspan="2">
                <textarea name="texteditor" id="texteditor" rows="10" cols="100" style="width:660px; height:500px;"></textarea>
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
                </td>
              </tr>
              <script>
                var map = new Array();
                var poly = new Array();
              </script>
              <?php
                if($_SERVER["REQUEST_METHOD"] == "POST") {
                  $days=addslashes($_POST['days']);
                  for($i = 0; $i < $days; $i++) {
                    ?>
                    <tr>
                      <td colspan="2">
                        <?php
                          include("day.php");
                        ?>
                      </td>
                    </tr>
                    <?php
                  }
                }
              ?>
              <tr>
                <td colspan="2">
                  <a class="btn btn-primary" href="send_db.php" value="Submit" onclick="submitContents(this)">Submit</a>
                </td>
              </tr>
            </table>
          </form>
        </div>

        <div class="col-md-4">

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php echo $_SESSION['login_user']; ?></h5>
            <div class="card-body">
              <label>Welcome, <?php echo $_SESSION['login_user']; ?>!</label>
            </div>
          </div>

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Okinawa</a>
                    </li>
                    <li>
                      <a href="#">Hongkong</a>
                    </li>
                    <li>
                      <a href="#">Friends</a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Photo</a>
                    </li>
                    <li>
                      <a href="#">Kota Kinabalu</a>
                    </li>
                    <li>
                      <a href="#">Ocean</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
