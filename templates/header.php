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
      <h1><a href="#">NuTRUtion</a></h1>
    </li>
</ul>

  <section class="top-bar-section">
    <ul class="left">
      <li><a href="#"><span>About</span></a></li>
      <li class="divider"></li>
      <li><a href="#">Contact</a></li>
      <li class="divider"></li>
      <li><a href="todo.php">Todo</a></li>
      <li class="divider"></li>
    </ul>

    <ul class="right">
      <li class="divider hide-for-small"></li>
      <li><a href="#">Settings</a></li>
      <li class="divider"></li>
      <li class="has-form">
        <form>
          <div class="row collapse">
              <a href="ajax/login.php" class="alert button">
                <?php
                  session_start();
                  if(isset($_SESSION['user_id'])) {
                      echo "Log Out";
                  }
                  else {
                      echo "Log In";
                  }
                ?></a>
          </div>
        </form>
      </li>
      <li class="divider show-for-small"></li>
      <li class="has-form">
        <a class="button" href="signup.php">
          <?php 
            if(isset($_SESSION['user_id'])) {
                echo $_SESSION['user_id'];
            }
            else echo "Sign Up";
          ?>
            </a>
      </li>
    </ul>
  </section>
</nav>
<header>
	<div class="row">
		<div class="twelve columns">
			<h1>NuTRUtion Nation</h1>
			<p class="subtitle">Helping understand America's dietary trends and the TRUE nutrition information about our food.</p>
		</div>
	</div>
</header>
<body>