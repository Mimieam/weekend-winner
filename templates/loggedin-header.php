<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $pageTitle; ?> &middot; BubbleDo</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap-lightbox.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet">
    <style>
      html {
          height: 100%;
      }
      body {
        height: 100%;
        margin: 0;
        background: #b2ffff url(img/bubble-do-blue-sky.jpg) no-repeat;
        /*
        background-repeat: no-repeat;
        background-attachment: fixed;
        background: #b2ffff;
        background: -moz-linear-gradient(top,  #b2ffff 0%, #e6ffff 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b2ffff), color-stop(100%,#e6ffff));
        background: -webkit-linear-gradient(top,  #b2ffff 0%,#e6ffff 100%);
        background: -o-linear-gradient(top,  #b2ffff 0%,#e6ffff 100%);
        background: -ms-linear-gradient(top,  #b2ffff 0%,#e6ffff 100%);
        background: linear-gradient(to bottom,  #b2ffff 0%,#e6ffff 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b2ffff', endColorstr='#e6ffff',GradientType=0 );
        */
      }
      .container {
        position: relative;
      }
      #top-navbar {
        background: #000000; /* Old browsers */
        background: -moz-linear-gradient(top,  #000000 0%, #00213f 17%, #006f8b 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#000000), color-stop(17%,#00213f), color-stop(100%,#006f8b)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #000000 0%,#00213f 17%,#006f8b 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #000000 0%,#00213f 17%,#006f8b 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #000000 0%,#00213f 17%,#006f8b 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #000000 0%,#00213f 17%,#006f8b 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#006f8b',GradientType=0 ); /* IE6-9 */        
      }
      #bottom-navbar div.navbar-inner {
        border-top: 0;
        background: #006f8b; /* Old browsers */
        background: -moz-linear-gradient(top,  #006f8b 0%, #00213f 83%, #000000 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#006f8b), color-stop(83%,#00213f), color-stop(100%,#000000)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #006f8b 0%,#00213f 83%,#000000 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #006f8b 0%,#00213f 83%,#000000 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #006f8b 0%,#00213f 83%,#000000 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #006f8b 0%,#00213f 83%,#000000 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#006f8b', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
      }
      #top-navbar > div {
        background: transparent;
        height: 48px;
        border-bottom: 0;
      }
      div.navbar {
        z-index:400;
      }
      #top-navbar ul.nav.left-nav {
        margin: 0 0 -14px;
        padding: 0;
        height: auto;
      }
      #top-navbar ul.nav.left-nav li {
        padding-bottom: 0;
        margin-bottom: 0;
      }
      #top-navbar ul.nav.left-nav li a {
        padding-top: 26px;
        padding-bottom: 6px;
        margin-bottom: 0;
      }

      div.task-container {
        border: 8px solid #ec9912;
        cursor: pointer;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        border-radius: 10px;
        -moz-background-clip: padding; 
        -webkit-background-clip: padding-box; background-clip: padding-box;
        -webkit-box-shadow: 0px 0px 8px 0px #00213f;
                box-shadow: 0px 0px 8px 0px #00213f;
        background: #ffffff; /* Old browsers */
        background: -moz-linear-gradient(top,  #ffffff 47%, #c6e9fa 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(47%,#ffffff), color-stop(100%,#c6e9fa)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #ffffff 47%,#c6e9fa 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #ffffff 47%,#c6e9fa 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #ffffff 47%,#c6e9fa 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #ffffff 47%,#c6e9fa 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#c6e9fa',GradientType=0 ); /* IE6-9 */
        padding: 6px;
        position: absolute;
        min-width:80px;
        width: auto;
        z-index: 0;
      }
      div.task-container div.task-content {
        padding: 3px;
      }

      div.task-container .hide-not-active {
        display: none;
      }
      div.task-container.dragging {
        cursor: move;
      }
      div.task-container.active {
        border-width: 12px;
        cursor: default;
      }
      div.task-container.active .hide-not-active {
        display: block;
      }
      .datepicker {z-index:12000;}
    </style>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/persona-buttons.css" rel="stylesheet">
    <script src="https://login.persona.org/include.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script src="js/mustache.js"></script>
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" id="top-navbar">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="nav-collapse collapse">
            <span class="brand" style="padding-bottom:5px"><img src="/img/bubbledo-logo-40.png" alt="logo" style="margin-top:-3px"/></span>
            <ul class="nav left-nav"  role="navigation">
              <?php foreach ($topics AS $topicId => $topicName): ?>
                <?php if ($topicAction === true && $user->getViewedTopicId() == $topicId): ?>
                  <li class="active">
                    <a href="#" data-toggle="modal" data-target="#changeTopic"><i class="icon-edit icon-white"></i>&nbsp;&nbsp;<?php echo htmlspecialchars($topicName); ?></a>
                  </li>
                <?php else: ?>
                  <li><a href=".?topic=<?php echo $topicId; ?>"><?php echo htmlspecialchars($topicName); ?></a></li>
                <?php endif; ?>
              <?php endforeach; ?>
              <?php if ($topicAction === true): ?>
                <li><a href="#" data-toggle="modal" data-target="#newTopic"><i class="icon-plus-sign icon-white"></i>&nbsp;Create Topic</a>
              <?php endif; ?>
              </li>
            </ul>
            <ul class="nav pull-right" style="margin-top:10px">
              <li id="fat-menu" class="dropdown">
                <div>
                  <img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['user']))); ?>?s=40" class="img-rounded pull-right" style="display:block; margin-top:-2px; margin-left: 0px; margin-right: -10px; width:40px; height: 40px"/>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white; display: inline-block; padding-top:18px; padding-right: 20px">
                    <?php echo htmlspecialchars($_SESSION['user']); ?>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li role="menuitem"><a href="settings.php" class="navbar-link">Features &amp; Settings</a></li>
                    <li role="menuitem"><a href="about.php" class="navbar-link">About</a></li>
                    <li role="menuitem"><a href="#" class="navbar-link" id="signout">Logout</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <div class="container">