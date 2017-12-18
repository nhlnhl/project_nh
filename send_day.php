<?php
    include("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {

      $date = addslashes($_POST['date']);
      $country = addslashes($_POST['country']);
      $money = addslashes($_POST['money']);
      $content = addslashes($_POST['texteditor']);
      $marker = addslashes($_POST['markers']);

      $sql = "SELECT COUNT(*) AS cnt FROM post";
      $result = mysqli_query($bd, $sql);
      $row = mysqli_fetch_assoc($result);
      $post_id = $row['cnt'];

      $sql = "INSERT INTO day(post_id, day_date, day_country, day_money, day_content) VALUES ($post_id, '{$date}', '{$country}', $money, '{$content}')";
      $send = mysqli_query($bd, $sql);

      if(!$send)
        echo "fail day";

      $sql = "SELECT COUNT(*) AS cnt FROM day";
      $result = mysqli_query($bd, $sql);
      $row = mysqli_fetch_assoc($result);
      $itinerary_id = $row['cnt'];

      $sql = "INSERT INTO marker(itinerary_id, marker_json) VALUES ($itinerary_id, '{$marker}')";
      $send = mysqli_query($bd, $sql);

      if($send)
      {
        if ($_POST['action'] == 'Next') {
          header("Location: write_day.php");
        }
        else {
        header("Location: home.php");
        }
      }
      else
        echo "fail marker";
    }
?>
