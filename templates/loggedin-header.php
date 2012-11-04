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
            <span class="brand">BubbleDo</span>
            <ul class="nav" role="navigation">
              <?php foreach ($topics AS $topicId => $topicName): ?>
                <?php if ($user->getViewedTopicId() == $topicId): ?>
                  <li class="active">
                    <a href="#" data-toggle="modal" data-target="#changeTopic"><i class="icon-edit icon-white"></i>&nbsp;&nbsp;<?php echo htmlspecialchars($topicName); ?></a>
                  </li>
                <?php else: ?>
                  <li><a href=".?topic=<?php echo $topicId; ?>"><?php echo htmlspecialchars($topicName); ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
              <li><a href="#" data-toggle="modal" data-target="#newTopic"><i class="icon-plus-sign icon-white"></i>&nbsp;Create Topic</a>
              </li>
            </ul>
            <ul class="nav pull-right">
              <li id="fat-menu" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo htmlspecialchars($_SESSION['user']); ?></a>
                <ul class="dropdown-menu" role="menu">
                  <li role="menuitem"><a href="settings.php" class="navbar-link">Features &amp; Settings</a></li>
                  <li role="menuitem"><a href="#" class="navbar-link" id="signout">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">
