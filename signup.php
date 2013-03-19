<?php
  include("templates/header.php");
  require_once("utils/dbconnect.php");
  require_once("utils/api.php");
  require_once("templates/display_labels.php");
  require_once("utils/authenticate.php");
  $db=getdb();
  ?>
  <div class="row">
    <div class="large-3 columns" style="min-height: 700px"></div>
    <div class="large-6 columns" style="margin-top: 100px">
      <!--TODO: What is this auth.php thing? -->
      <form action='auth.php'>
        <label for="username">Username</label>
        <input type="text" id="username" placeholder="example123">
        <label for="email">Email Address</label>
        <input type="text" id="email" placeholder="example123@someemail.com">
        <label for="password">Password</label>
        <input type="password" id="password">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" id="confirm_password">
        <input type="submit" id="login" value="Sign Up" class="button">
      </form>
    </div>
    <div class="large-3 columns"></div>
  </div>

  <?php 
  

  include("templates/footer.php");  
?>
