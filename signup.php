<?php
  include("templates/header.php");
  require_once("utils/dbconnect.php");
  require_once("utils/api.php");
  require_once("templates/display_labels.php");
  require_once("utils/authenticate.php");
  $db=getdb();
  $auth = new authenticate();
  session_start();
  ?>
  <div class="row">
    <div class="large-3 columns" style="min-height: 700px"></div>
    <div class="large-6 columns" style="margin-top: 100px">
      <form method="POST" action = "ajax/createUser.php" id = "userSignup">
        <label for="username">Username</label>
        <input type="text" id="username" name = "username">
        <label for="email">Email Address</label>
        <input type="text" id="email" name = "email">
        <label for="password">Password</label>
        <input type="password" name = "password" id="password">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name = "confirm_password" id="confirm_password">
        <input type="submit" id="login" value="Sign Up" class="button">
        <span><?php echo $_SESSION['create_error']; unset($_SESSION['create_error']); ?></span>
      </form>
    </div>
    <div class="large-3 columns"></div>
  </div>

  <?php 
  

  include("templates/footer.php");  
?>
