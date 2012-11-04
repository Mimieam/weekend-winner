<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $pageTitle; ?> &middot; BubbleDo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/bootstrap-lightbox.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/colorpicker.css" rel="stylesheet">
    <link href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet">
    <style>
      html {
          height: 100%;
      }
      body {
        height: 100%;
        margin: 0;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background: #b2ffff; /* Old browsers */
        background: -moz-linear-gradient(top,  #b2ffff 0%, #e6ffff 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b2ffff), color-stop(100%,#e6ffff)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top,  #b2ffff 0%,#e6ffff 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top,  #b2ffff 0%,#e6ffff 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top,  #b2ffff 0%,#e6ffff 100%); /* IE10+ */
        background: linear-gradient(to bottom,  #b2ffff 0%,#e6ffff 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b2ffff', endColorstr='#e6ffff',GradientType=0 ); /* IE6-9 */
      }
      .container {
        position: relative;
      }
      .colorpicker, .datepicker, .lightbox, .lightbox *  {z-index:12000 !important;}
      .modal-backdrop {z-index: 1000 !important;}
      .modal-backdrop * {z-index: 1001 !important;}
      div.navbar {
        z-index:12001;
      }
      div.task-container {
        position: absolute;
        border: 8px solid #ec9912;
        width: 240px;
        height: 60px;
        -webkit-border-radius: 25px;
        -moz-border-radius: 25px;
        border-radius: 25px;
        padding: 10px;
        cursor: pointer;
        z-index: 1;
      }
      div.task-container.dragging {
        cursor: move;
      }
      div.task-container.active {
        border-width: 12px;
        cursor: default;
      }
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
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="nav-collapse collapse">
            <span class="brand">BubbleDo</span>
            <ul class="nav" role="navigation">
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
            <ul class="nav pull-right">
              <li id="fat-menu" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower(trim($_SESSION['user']))); ?>?s=30" class="img-rounded pull-right" style="display:block; margin-top:-5px; margin-left: 10px; margin-right: -20px"/>
                  <?php echo htmlspecialchars($_SESSION['user']); ?>
                </a>
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