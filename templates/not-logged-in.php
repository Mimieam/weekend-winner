<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; BubbleDo</title>
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      html, .container {
          height: 100%;
      }
      body {
        height: 100%;
        margin: 0;
        background: #b2ffff url(img/CeliaShake.jpg) no-repeat;
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
      #signin-box {
        background: transparent url(img/do-homepage-trans.png) no-repeat;
        width: 700px;
        height: 398px;
        position: relative;
        margin: 0 auto;
      }
      #signin-box > div {
        position: absolute;
        width: 280px;
        right: 100px;
        top: 180px;
        text-align: center;
      }
      #signin-box h2 {
        margin-bottom: 10px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/persona-buttons.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="https://login.persona.org/include.js"></script>
  </head>

  <body>

    <div class="container">
      <div id="signin-box">
        <div>
          <h2>sign in:</h2>
          <a href="#" class="persona-button" id="signin"><span>Sign in with your Email</span></a>
          <p>sign in powered by <a href="http://www.mozilla.org/en-US/persona/">Persona</a></p>
        </div>
      </div>
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/flexverticalcenter.js"></script>
    <script>
      $(document).ready(function() {
        $('#signin-box').flexVerticalCenter();
      });
    </script>
    <?php
    include dirname(__FILE__).'/persona-handler.inc.php';
    ?>
  </body>
</html>