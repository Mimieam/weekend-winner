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