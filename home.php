<?php
	require_once("config.php");
if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}

	if(isset($_GET['cate_id']))
	{
		$cate_id = $_GET['cate_id'];
	}
	else {
		$cate_id = 1;
	}

if($cate_id != 1)
{
$cate_list = mysqli_query($bd, "SELECT post_theme FROM theme WHERE post_theme = '$cate_id'");
$cate_name = mysqli_fetch_array($cate_list);
}
	/* 페이징 시작 */
		//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
		if(isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}


			/* 검색 끝 */

		/* 검색 시작 */
		$subString=null;
		$searchText=null;

	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText;
	}

	if(isset($searchText)) {
		$searchSql = ' where post_title like "%' . $searchText . '%" or post_content like "%' . $searchText . '%" AND ';
	} else {
		$searchSql = ' WHERE ';
	}

	/* 검색 끝 */
if($cate_id!=1)
{
  $sql = 'select count(*) as cnt from post' . $searchSql . ' post_theme = "'.$cate_id.'"and user_id = "'.$_SESSION['login_user'].'" or post_lock = 2 or (post_lock = 1 and user_id = (select user1_id from friendship where user2_id = "'.$_SESSION['login_user'].'")) or (post_lock = 1 and user_id =(select user2_id from friendship where user1_id = "'.$_SESSION['login_user'].'"))';
}
else {
  $sql = 'select count(*) as cnt from post'. $searchSql.' user_id = "'.$_SESSION['login_user'].'" or post_lock = 2 or (post_lock = 1 and user_id = (select user1_id from friendship where user2_id = "'.$_SESSION['login_user'].'")) or (post_lock = 1 and user_id = (select user2_id from friendship where user1_id = "'.$_SESSION['login_user'].'"))';

}
		$result = $bd->query($sql);
		$row = $result->fetch_assoc();

		$allPost = $row['cnt']; //전체 게시글의 수

		if(empty($allPost)) {
			$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
			$paging = '<ul>';
			if($page == 1)
			{
					$paging .= '<li class="page current">1</li>';
			}

				$paging .= '</ul>';
		} else {

		$onePage = 3; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수 ceil로 올림

		if($page < 1 || $page > $allPage) {
	?>
			<script>
				alert("존재하지 않는 페이지입니다.");
				history.back();
			</script>
	<?php
			exit;
		}

		$oneSection = 2; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
		$currentSection = ceil($page / $oneSection); //현재 섹션
		$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

		$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

		if($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}

		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

		$paging = '<ul class="pagination justify-content-center mb-4">'; // 페이징을 저장할 변수

		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) {
$paging .= '<li class="page-item"><a class="page-link" href="./index.php?page=1' . $subString . '">&larr; Newer</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
$paging .= '<li class="page-item"><a class="page-link" href="./index.php?page=' . $prevPage . $subString . '">&larr; Newer</a></li>';
		}

		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="page-item">' . $i . '</li>';
			} else {
				$paging .= '<li class="page-item"><a class="page-link" href="./index.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}

		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
$paging .= '<li class="page page_next page-item"><a class="page-link" href="./index.php?page=' . $nextPage . $subString . '">Older &rarr;</a></li>';		}

		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end page-item"><a class="page-link" href="./index.php?page=' . $allPage . $subString . '">Older &rarr;</a></li>';
		}


		// if($page == 1)
		// {
		// 		$paging .= '<li class="page-item page current">1</li>';
		// }
		//
			$paging .= '</ul>';
		/* 페이징 끝 */


		$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

    if($cate_id!=1)
    {
      $sql = 'select * from post ' . $searchSql .' post_theme = "'.$cate_id.'"and user_id = "'.$_SESSION['login_user'].'" or post_lock = 2 or (post_lock = 1 and user_id = "(select user1_id from friendship where user2_id = "'.$_SESSION['login_user'].'")") or (post_lock = 1 and user_id =	"(select user2_id from friendship where user1_id = "'.$_SESSION['login_user'].'"))'.' order by b_no desc ' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
  		$sql2 = 'select * from post ' . $searchSql .' post_theme = "'.$cate_id.'"and user_id = "'.$_SESSION['login_user'].'" or post_lock = 2 or (post_lock = 1 and user_id = "(select user1_id from friendship where user2_id = "'.$_SESSION['login_user'].'")") or (post_lock = 1 and user_id =	"(select user2_id from friendship where user1_id = "'.$_SESSION['login_user'].'"))'.' order by b_no desc'; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
    }
    else{
      $sql = 'select * from post ' . $searchSql.' user_id = "'.$_SESSION['login_user'].'" or post_lock = 2 or (post_lock = 1 and user_id = "(select user1_id	from friendship where user2_id = "'.$_SESSION['login_user'].'")") or (post_lock = 1 and user_id = "(select user2_id	from friendship where user1_id = "'.$_SESSION['login_user'].'")")'.'order by b_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
  		$sql2 = 'select * from post ' . $searchSql .' user_id = "'.$_SESSION['login_user'].'" or post_lock = 2 or (post_lock = 1 and user_id = "(select user1_id	from friendship where user2_id = "'.$_SESSION['login_user'].'")") or (post_lock = 1 and user_id = "(select user2_id from friendship	where user1_id = "'.$_SESSION['login_user'].'")")'.'order by b_no desc'; //원하는 개수만큼 가져온다. (0번째부터 20번째까지

    }
		$result = $bd->query($sql);
		$result2 = $bd->query($sql2);

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
    <link href="home.css" rel="stylesheet">

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

        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <?php
         					$cnt = 1;
         					if(isset($emptyData)) {
         							echo $emptyData;
         						} else {
         							$num_rows = mysqli_num_rows($result2);
         							$virtual_bno =$num_rows - $onePage*($page-1);
         	          while($row = $result->fetch_assoc())
         	          {
         	            $datetime = explode(' ', $row['post_date']);
         	            $date = $datetime[0];
         	            $time = $datetime[1];
         	            if($date == Date('Y-m-d'))
         	              $row['post_date'] = $time;
         	            else
         	              $row['post_date'] = $date;
         	        ?>
          <!-- Blog Post -->
          <div class="card mb-4 my-4">

            <!-- <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap"> -->
            <div class="card-body">
              <h2 class="card-title"><?php echo $row['post_title']?></h2>
              <p class="card-text"><?php echo substr($row['post_content'], 0, 50)?></p>
              <a href="post.php?bno=<?php echo $row['post_id']?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $row['post_date']?>
            </div>
          </div>
          <?php
       	          }
       					}
       	        ?>



          <!-- Pagination -->
          <div class="paging">
            <?php echo $paging ?>
          </div>


        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php echo $_SESSION['login_user']; ?></h5>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <label>Welcome, <?php echo $_SESSION['login_user']; ?>!</label>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <a class="btn btn-primary" href="write.php">Write</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search Friends</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for friends">
                <span class="input-group-btn">
                  <a class="btn btn-secondary" type="button" href="search_friend.php">Go!</a>
                </span>
              </div>
            </div>
          </div>

          <!-- Search Widget -->
          <div class="card my-4" class="searchBox">
            <h5 class="card-header">Search Posts</h5>
            <div class="card-body">
              <div class="input-group">
                    <form action="./index.php" method="get">
                    <input type="text" name="searchText" class="form-control" placeholder="Search for posts" value="<?php echo isset($searchText)?$searchText:null?>">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="submit">Go!</button>
                    </span>
                </form>
              </div>
            </div>
            <?php
            $cate_sql = mysqli_query($bd,"SELECT * FROM theme ORDER BY post_theme");
            $index = 'home.php';
            ?>
          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <?php
                   while($cate_row = mysqli_fetch_array($cate_sql))
                   {
                     $bo_type = $cate_row['post_theme'];
                     echo "<li> <a href=$index?cate_id=$bo_type>" . $cate_row['theme_name'] . "</a></li>";
                   }?>
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
        <p class="m-0 text-center text-white">Copyright &copy; Project NH 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
