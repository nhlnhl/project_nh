<?php
	require_once("config.php");
if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
}
$id = $_GET['friend_id'];

$sql='INSERT INTO friendship (user1_id, user2_id) VALUES ("'.$_SESSION['login_user'].'", "'.$id.'")';
echo $sql;
mysqli_query($bd, $sql);
//mysqli_close($connect);
?>
<html>
<head>
<script type="text/javascript">
		alert("친구추가에 성공하였습니다..");
		<?
		$HTTP_REFERER = $_SERVER['HTTP_REFERER'];
		header('location:'.$HTTP_REFERER);
		 ?>
</script>
</head>
</html>
