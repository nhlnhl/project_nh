<?php
    include("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {

      $title = addslashes($_POST['title']);
      $theme = addslashes($_POST['theme']);
      $content = addslashes($_POST['texteditor']);
      $lock = addslashes($_POST['lock']);

      $post_theme;
      if($theme = "Friends")  {
        $post_theme = 0;
      }
      else if($theme = "Family")  {
        $post_theme = 1;
      }
      else if($theme = "Ocean") {
        $post_theme = 2;
      }
      else {
        $post_theme = 3;
      }

      $post_lock;
      if($lock = "Public")  {
        $post_lock = 0;
      }
      else if($lock = "Friends")  {
        $post_lock = 1;
      }
      else {
        $post_lock = 2;
      }

    $sql = "INSERT INTO post(user_id, post_date, post_content, post_theme, post_lock) VALUES ('{$_SESSION['login_user']}', NOW(), '{$content}', $post_theme, $post_lock)";
    $send = mysqli_query($bd, $sql);

    if($send)
      header("Location: day.php");
    else
      echo "fail";
    }
?>
