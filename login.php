<?php
  include("templates/header.php");
  require_once("utils/dbconnect.php");
  require_once("utils/api.php");
  require_once("templates/display_labels.php");
  require_once("utils/authenticate.php");
  $db=getdb();
  session_start();
?> 

  <div class="row">
    <div class="large-6 columns large-offset-1" style="margin-top: 100px; min-height: 700px">
      <div class="row">
        <form method = "POST" action = "ajax/login.php" id = 'userLogin'>
          <h3> Log In </h3>
          <div class="large-3 columns">
            <label for="username" class="right">Username</label>
          </div>
          <div class="large-9 columns">
            <input type="text" name = "username" id="username">
          </div>
        </div>
        <div class="row">
          <div class="large-3 columns">
          <label for="password" class="right">Password</label>
        </div>
          <div class="large-9 columns">
            <input type="password" name="password" id="password">
          </div>
        </div>
        <br>
        <div class="row">
          <div class="large-6 columns">
            <input type="submit" id="login" value="Login" class="button right">
            <span><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></span>
            </form>
          </div>
          <div class="large-6 columns">
            <form method = "GET" action = "ajax/login.php" id = "guestLogin">
              <input type="submit" id="guestSubmit" value="Login as guest" class="button">
            </form>
          </div>
      </div> 
    </div>
  </div>

<?php 
  include("templates/footer.php");
?>