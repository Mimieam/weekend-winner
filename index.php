<?php
include 'common.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; BubbleDo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
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

      <form class="form-signin">
        <?php if (empty($_SESSION['user'])): ?>
          <h2 class="form-signin-heading">Sign in to BubbleDo</h2>

          <a href="#" class="persona-button" id="signin"><span>Sign in with your Email</span></a>
          <p>No account creation necessary - we're powered by <a href="http://www.mozilla.org/en-US/persona/">Persona</a> to protect your online identity.</p>
        <?php else: ?>
          <h2 class="form-signin-heading">Signed into BubbleDo at <?php echo htmlspecialchars($_SESSION['user']); ?></h2>
          <a href="#" class="persona-button" id="signout"><span>Sign out</span></a>
        <?php endif; ?>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script>
      var signinLink = document.getElementById('signin');
      if (signinLink) {
        signinLink.onclick = function() { navigator.id.request(); };
      }
       
      var signoutLink = document.getElementById('signout');
      if (signoutLink) {
        signoutLink.onclick = function() { navigator.id.logout(); };
      }
      var currentUser = <?php echo isset($_SESSION['user']) ? json_encode($_SESSION['user']) : 'false'; ?>;       
      navigator.id.watch({
        loggedInUser: currentUser,
        onlogin: function(assertion) {
          <?php if (empty($_SESSION['user'])): ?>
          // A user has logged in! Here you need to:
          // 1. Send the assertion to your backend for verification and to create a session.
          // 2. Update your UI.
          $.ajax({ /* <-- This example uses jQuery, but you can use whatever you'd like */
            type: 'POST',
            url: '/identity/', // This is a URL on your website.
            data: {
              assertion: assertion,
              method: 'login'
            },
            success: function(res, status, xhr) {
              if (res.status == 'okay') {
                window.location.reload();
              } else {
                alert(res.reason);
              }
            },
            error: function(xhr, status, err) {
              alert("login failure" + res);
            }
          });
          <?php endif; ?>
        },
        onlogout: function() {
          <?php if (!empty($_SESSION['user'])): ?>
            // A user has logged out! Here you need to:
            // Tear down the user's session by redirecting the user or making a call to your backend.
            // Also, make sure loggedInUser will get set to null on the next page load.
            // (That's a literal JavaScript null. Not false, 0, or undefined. null.)
            $.ajax({
              type: 'POST',
              data: {
                method: 'logout'
              },
              url: '/identity/', // This is a URL on your website.
              success: function(res, status, xhr) {
                window.location.reload();
              },
              error: function(xhr, status, err) {
                alert("logout failure" + res);
              }
            });
          <?php endif; ?>
        }
      });
    </script>
  </body>
</html>