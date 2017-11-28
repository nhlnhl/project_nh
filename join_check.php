<?php
    include("config.php");

    if($_SERVER["REQUEST_METHOD"] == "POST") {

    $myName=addslashes($_POST['name']);
    $myID=addslashes($_POST['id']);
    $myPW=addslashes($_POST['pw']);
    $myBirthday=addslashes($_POST['birthday']);
    $myCountry=addslashes($_POST['country']);
    $myRegion=addslashes($_POST['region']);
    $myGender=addslashes($_POST['gender']);

    $sql="SELECT name FROM user WHERE user_id='$myID'";
    $result=mysqli_query($bd, $sql);
    $count=mysqli_num_rows($result);

    if($count!=0)
    {
      //mysqli_close($connect);
        ?>
<html>
    <head>
        <script type="text/javascript">
            alert("이미 존재하는 아이디입니다.");
            document.location = "/project_nh";
        </script>
    </head>
</html>
        <?php
    }
    else
    {
        if($myGender == 'Female')
          $myGender = true;
        else
          $myGender = false;

        $sql="INSERT INTO user (user_name, user_id, user_pw, user_birthday, user_country, user_region, user_gender) VALUES ('$myName', '$myID', '$myPW', '$myBirthday', '$myCountry', '$myRegion', '$myGender')";
        mysqli_query($bd, $sql);
        //mysqli_close($connect);
        ?>
<html>
    <head>
        <script type="text/javascript">
            alert("가입에 성공하였습니다..");
            document.location = "/project_nh";
        </script>
    </head>
</html>
        <?php
    }
}

?>
