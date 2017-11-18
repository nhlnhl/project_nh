<?php
    include("config.php");
    //session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $myID=addslashes($_POST['id']);
    $myPW=addslashes($_POST['pw']);

    $sql="SELECT * FROM user WHERE user_id='$myID' AND user_pw='$myPW'";
    $result=mysqli_query($bd, $sql);
    //$row=mysql_fetch_array($result);
    //$active=$row['active'];
    $count=mysqli_num_rows($result);

    if($count==1)
    {
        $_SESSION['login_user']=$myID;

        //mysqli_close($connect);
        header("location: home.php");
    }
    else
    {
      //mysqli_close($connect);
        ?>
<html>
    <head>
        <script type="text/javascript">
            alert("아이디 또는 비밀번호가 맞지 않습니다.");
            //document.location = "/project_nh/index.php";
        </script>
    </head>
</html>
        <?php
    }
}

?>
