<?php
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "autoset";
$mysql_database = "project_nh";

$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("db connect error");
//mysql_select_db($mysql_database, $bd) or die("db connect error");

?>
