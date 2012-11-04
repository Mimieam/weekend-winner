<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; BubbleDo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      html, .container { height: 100%; }
      body {
        height: 100%;
        background: #4270ae url(img/CeliaShake.jpg) no-repeat;
      }
      #signin-box {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto;
        background-color: #fff;
        border: 5px solid #23498a;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
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
        <h2>Sign in to BubbleDo</h2>

        <a href="#" class="persona-button" id="signin"><span>Sign in with your Email</span></a>
        <p>No account creation necessary - we're powered by <a href="http://www.mozilla.org/en-US/persona/">Persona</a> to protect your online identity.</p>
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