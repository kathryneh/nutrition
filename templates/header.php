<!DOCTYPE html>
<html class="no-js" lang="en"> 

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>NuTRUtion</title>
  <link rel="stylesheet" href="stylesheets/normalize.css" />
  <link rel="stylesheet" href="stylesheets/foundation.css" />
  <link rel="stylesheet" href="stylesheets/nutrution.css" />
  <link rel="stylesheet" href="stylesheets/general_enclosed_foundicons.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <script src="js/vendor/custom.modernizr.js"></script>
  <script src="js/vendor/jquery.js"></script>
  <script src="js/nutrution.js"></script>
</head>
<nav class="top-bar">
  <ul class="title-area">
    <li class="name">
      <h1><a href="index.php">NuTRUtion</a></h1>
    </li>
</ul>
  
  <section class="top-bar-section">
    <ul class="left">
      <li><a href="#"><span>About</span></a></li>
      <li class="divider"></li>
      <li><a href="#">Contact</a></li>
      <li class="divider"></li>
      <li><a href="help.php">Help</a></li>
      <li class="divider"></li>
      <li style="display:none"><a href="todo.php">Todo</a></li>
      <li style="display:none" class="divider"></li>
    </ul>

    <ul class="right">
      <li class="divider hide-for-small"></li>
      <?php 
        session_start();
        if(isset($_SESSION['user_id'])) {
          echo '<li><a href="settings.php">Settings</a></li>';
          echo '<li class="divider"></li>';
        }
        else{
        }
      ?>
      <li class="has-form">
        <form>
          <div class="row collapse">
            <?php
              if(isset($_SESSION['user_id'])) {
                echo '<a class="alert button" href="ajax/logout.php">Log Out</a>';
              }
              else {
                echo '<a class="alert button" href="login.php">Log In</a>';
              }
            ?>
          </div>
        </form>
      </li>
      <li class="divider show-for-small"></li>
      <li class="has-form">
        <?php
          if(!isset($_SESSION['user_id'])) {
            echo '<a class="button" href="signup.php">Sign Up</a>';
          }
          else {
            echo '<a href="#">Logged in as ' . $_SESSION['user_id'] . '</a>'; 
          }
        ?>
      </li>
      <li><img style="margin-top:10px; clear:left;" src="images/cog.png"></img></li>
    </ul>
  </section>
</nav>
<header>
  <div class="row" id="notChromeRow">
    <div class="notChrome large-6 large-offset-3 columns panel" style="display:none;">This site is optimized for Google Chrome and may act unexpectedly in other browsers</div>
  </div>
	<div class="row">
		<div class="twelve columns">
			<h2 class="subheader">NuTRUtion Nation<small class="subheader">&nbsp; &nbsp;In pursuit of understanding the TRUE nutrition information about our food.</small></h2>
  </div>
	</div>
</header>
<body>