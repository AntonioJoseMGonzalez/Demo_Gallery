<html lang="en">

<head>

    <?php include_once("/includes/header.php"); ?>

</head>

<body>

    <?php require_once("/includes/config/db.php");
          require_once("/login/classes/Login.php"); 
          $login = new Login();
          include_once("/includes/nav.php"); 
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Page Content -->
    <div class="container">
        <?php
          // show potential errors / feedback (from login object)
          if (isset($login)) {
              if ($login->errors) {
                  foreach ($login->errors as $error) {
                      echo ('<center><h5 class="btn-danger">'.$error.'</h5></center>');
                  }
              }
              if ($login->messages) {
                  foreach ($login->messages as $message) {
                      echo ('<center><h5 class="btn-success">'.$message.'</h5></center>');
                  }
              }
          }
        ?>
        <div class="row">
            <!-- login form box -->
            <form method="post" action="/index.php" name="loginform" class="form-horizontal">
              <fieldset>
                <!-- Form Name -->
                <center><legend>Sign In</legend></center>

                <!-- Email input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="login_input_username"></label>
                  <div class="col-md-4">
                    <input id="login_input_username" placeholder="User or email" class="login_input form-control input-md" type="text" name="user_name" required="" />
                  </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="login_input_password"></label>
                  <div class="col-md-4">
                    <input id="login_input_password" placeholder="Password" class="login_input form-control input-md" type="password" name="user_password" autocomplete="off" required="" />
                  </div>
                </div>

                <!-- Button (Double) -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="login" ></label>
                  <div class="col-md-8">
                    <input type="submit"  name="login" value="Log in" class="btn btn-primary"/>
                  </div>
                </div>
              </fieldset>
            </form>
        </div>

    <?php include_once("/includes/footer.php"); ?>
</body>

</html>
