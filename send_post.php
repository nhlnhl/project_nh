<?php
    include("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {

      $title = addslashes($_POST['title']);
      $theme = addslashes($_POST['theme']);
      $content = addslashes($_POST['texteditor']);
      $lock = addslashes($_POST['lock']);
      //$img = addslashes($_POST['img']);

      $post_theme;
      if($theme == "Friends")  {
        $post_theme = 0;
      }
      else if($theme == "Family")  {
        $post_theme = 1;
      }
      else if($theme == "Ocean") {
        $post_theme = 2;
      }
      else if($theme == "Photo") {
        $post_theme = 3;
      }
      else {
        $theme_name = addslashes($_POST['other']);

        $sql = "SELECT post_theme FROM theme WHERE theme_name = '{$theme_name}'";
        $result = mysqli_query($bd, $sql);
        $row = mysqli_fetch_assoc($result);
        $post_theme = $row['post_theme'];

        if(empty($post_theme))
        {
          $sql = "SELECT COUNT(*) AS cnt FROM theme";
          $result = mysqli_query($bd, $sql);
          $row = mysqli_fetch_assoc($result);
          $post_theme = $row['cnt'];

          $sql = "INSERT INTO theme(post_theme, theme_name) VALUES ($post_theme, '{$theme_name}')";
          $result = mysqli_query($bd, $sql);
        }
      }

      $post_lock;
      if($lock == "Public")  {
        $post_lock = 2;
      }
      else if($lock == "Friends")  {
        $post_lock = 1;
      }
      else {
        $post_lock = 0;
      }

    $sql = "INSERT INTO post(post_title, user_id, post_date, post_content, post_theme, post_lock) VALUES ('{$title}', '{$_SESSION['login_user']}', NOW(), '{$content}', $post_theme, $post_lock)";
    $send = mysqli_query($bd, $sql);

    if($send)
      header("Location: write_day.php");
    else
      echo "fail";
    }
?>
