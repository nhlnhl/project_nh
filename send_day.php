<?php
    include("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {

      $date = addslashes($_POST['date']);
      $country = addslashes($_POST['country']);
      $money = addslashes($_POST['money']);
      $content = addslashes($_POST['texteditor']);

      $sql = "SELECT p1.post_id FROM post p1 WHERE p1.post_date = (SELECT max(post_date) FROM post p2 WHERE p2.post_id = p1.post_id)";
      $result = mysqli_query($bd, $sql);
      $row = mysqli_fetch_assoc($result);
      $post_id = $row['post_id'];

      echo $post_id;

      $sql = "INSERT INTO day(post_id, day_date, day_country, day_money, day_content) VALUES ($post_id, $date, '{$country}', $money, '{$content}')";
      $send = mysqli_query($bd, $sql);

      if($send)
      {
        if ($_POST['action'] == 'Next') {
          header("Location: day.php");
        }
        else {
          header("Location: home.php");
        }
      }
      else
        echo "fail";
    }
?>
