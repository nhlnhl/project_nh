<?php
if(!isset($_SESSION['login_user'])) {
    header("location: index.php");
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

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="post.css" rel="stylesheet">

    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="./js/service/HuskyEZCreator.js" charset="utf-8"></script>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Project NH</a>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Write Column -->
        <div class="col-lg-8">
          <form action="send_post.php" method="post" id="write_form">
            <table class="my-4">
              <tr>
                <td>
                  <label>Title</label>
                  <input class="form-comtrol" name="title" id="title" style="width:640px;"/>
                </td>
              </tr>
              <tr>
                <td>
                <textarea name="texteditor" id="texteditor" rows="10" cols="100" style="width:660px; height:500px;"></textarea>
                <script type="text/javascript">
                    var oEditors = [];
                    nhn.husky.EZCreator.createInIFrame({
                        oAppRef: oEditors,
                        elPlaceHolder: "texteditor",
                        sSkinURI: "./SmartEditor2Skin.html",
                        fCreator: "createSEditor2"
                    });

                    function submitContents(elClickedObj) {
                        oEditors.getById["texteditor"].exec("UPDATE_CONTENTS_FIELD", []);

                        try {
                            elClickedObj.form.submit();
                        } catch(e) {
                        }
                    }

                    function pasteHTML(filepath) {
                      var sHTML = '<img src="<%=request.getContextPath()%>' + filepath + '">';
                      oEditors.getById["textAreaContent"].exec("PASTE_HTML", [sHTML]);
                    }
                </script>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Theme</label>
                  <select class="form-comtrol" name="theme" id="theme"><option>Friends<option>Family<option>Ocean<option>Photo<Option>Other</select>
                  <input class="form-comtrol" name="other" id="other" style="width:100px;"/>
                  <select class="form-comtrol" name="lock" id="lock"><option>Public<option>Friends<option>Only Me</select>
                  <button class="btn btn-primary text-white" type="submit" onclick="submitContents(this)">Next</button>
                </td>
              </tr>
            </table>
          </form>
        </div>

  <?php include("aside.php"); ?>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

	  <?php include("footer.php"); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
