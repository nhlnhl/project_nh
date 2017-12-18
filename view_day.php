<?php
	require_once("config.php");
if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

$itinerary_id = $_GET['dayno'];

$sql = 'select * from day where itinerary_id = ' . $itinerary_id;
	$result = $bd->query($sql);
  if(!$result)
	{
		echo '오류가 발생했습니다.';
	}
	$row = $result->fetch_assoc();
	$sql2 = 'select * from post where post_id = ' .$row['post_id'];
		$result2 = $bd->query($sql2);

		$row2 = $result2->fetch_assoc();
		$sql3 = 'select * from day where post_id = '.$row['post_id'];
		$result2 = $bd->query($sql3);
		if(!$result3)
		{
			echo '오류가 발생했습니다.';
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

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4"><?php echo $row2['post_title']?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="user.php?id=<?php echo $row2['user_id']?>"><?php echo $row2['user_id']?></a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $row2['post_date']?></p>

          <hr>

          <!-- Preview Image -->
          <!-- <img class="img-fluid rounded" src="http://placehold.it/900x300" alt=""> -->
          <!-- Post Content -->
          <!-- <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus, vero, obcaecati, aut, error quam sapiente nemo saepe quibusdam sit excepturi nam quia corporis eligendi eos magni recusandae laborum minus inventore?</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut, tenetur natus doloremque laborum quos iste ipsum rerum obcaecati impedit odit illo dolorum ab tempora nihil dicta earum fugiat. Temporibus, voluptatibus.</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, doloribus, dolorem iusto blanditiis unde eius illum consequuntur neque dicta incidunt ullam ea hic porro optio ratione repellat perspiciatis. Enim, iure!</p>

          <blockquote class="blockquote">
            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
            <footer class="blockquote-footer">Someone famous in
              <cite title="Source Title">Source Title</cite>
            </footer>
          </blockquote>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, nostrum, aliquid, animi, ut quas placeat totam sunt tempora commodi nihil ullam alias modi dicta saepe minima ab quo voluptatem obcaecati?</p>

          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, dolor quis. Sunt, ut, explicabo, aliquam tenetur ratione tempore quidem voluptates cupiditate voluptas illo saepe quaerat numquam recusandae? Qui, necessitatibus, est!</p> -->
          <p><?php echo $row['post_content']?>  </p>
          <hr>
					<p class="mb-0">Triped in <?php echo $row['day_country']?></p>
					<hr>
					  <p class="mb-0">Triped on <?php echo $row['day_date']?></p>
					<hr>
					여기에 map 정보
					<hr>
					<p>Spend Cost : <?php echo $row['day_money']?>  </p>
					<hr>
					<?php
					$i=0;
					while($row3 = $result3->fetch_assoc())
										{ $i++;
					 ?>
						<a href="view_day.php?dayno=<?php echo $row3['itinerary_id']?>" class="btn btn-primary"> DAY <?echo $i; ?></a>

					<? } ?>
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
