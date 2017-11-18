<?php
if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

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
        <div class="col-lg-8">
          <form action="write.php" method="post">
            <div class="col my-4">
              <label>Number of days</label>
              <input class="form-comtrol" type="text" name="days">
            </div>
            <div class="col my-4">
              <button class="btn btn-primary text-white" type="submit">Write</button>
            </div>
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
