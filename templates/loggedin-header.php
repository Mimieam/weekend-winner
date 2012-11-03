<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $pageTitle; ?> &middot; BubbleDo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/persona-buttons.css" rel="stylesheet">
    <script src="https://login.persona.org/include.js"></script>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="nav-collapse collapse">
            <a class="brand" href="#">BubbleDo</a>
            <ul class="nav" role="navigation">
              <li class="active"><a href="#">Topic One</a></li>
              <li><a href="#about">Topic Two</a></li>
              <li><a href="#contact">Topic Three</a></li>
            </ul>
            <ul class="nav pull-right">
              <li id="fat-menu" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo htmlspecialchars($_SESSION['user']); ?></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                  <li><a href="settings.php" class="navbar-link">Features &amp; Settings</a></li>
                  <li><a href="#" class="navbar-link" id="signout">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
