<?	require_once("config.php"); ?>
<!-- Sidebar Widgets Column -->
<div class="col-md-4">

  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header"><a href="user.php?id=<?php echo $_SESSION['login_user']?>"><?php echo $_SESSION['login_user']; ?> </a></h5>

    <div class="card-body">
      <div class="row">
        <div class="col">
          <label>Welcome, <?php echo $_SESSION['login_user']; ?>!</label>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <a class="btn btn-primary" href="write_post.php">Write</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Search Widget -->
  <div class="card my-4">
    <h5 class="card-header">Search Friends</h5>
    <div class="card-body">
      <div class="input-group">
        <form class="form-control" action="./search_friend.php" method="get">
        <input type="text" name="searchFriend" class="form-control" placeholder="Search for friends" value="<?php echo isset($searchFriend)?$searchFriend:null?>">
        <span class="input-group-btn">
          <button class="btn btn-secondary" type="submit">Go!</button>
        </span>
    </form>
      </div>
    </div>
  </div>

  <!-- Search Widget -->
  <div class="card my-4" class="searchBox">
    <h5 class="card-header">Search Posts</h5>
    <div class="card-body">
      <div class="input-group">
            <form class="form-control" action="./home.php" method="get">
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
    </div>
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
<!-- /.row -->

</div>
<!-- /.container -->
