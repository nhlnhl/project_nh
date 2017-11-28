<?php
//session_start();

// if(isset($login_session))
// {
//   session_destroy();
//   echo "<script>alert('로그아웃 되었습니다.');</script>";
//   echo "<script>location.href = 'index.php'</script>";
// }
// 로그인 안된 상태에서 로그아웃 하는거 방지??? 이거 맞나?


if(session_destroy())
{
    header("Location: index.php");
}

?>
