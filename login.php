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
        <label for="email">Email Address</label>
        <input type="text" id="email" placeholder="example123@someemail.com">
        <label for="password">Password</label>
        <input type="password" id="password">
        <input type="submit" id="login" value="Login" class="button">
      </form>
    </div>
    <div class="large-3 columns"></div>
  </div>

  <?php 
  

  include("templates/footer.php");  
?>


