<?php
include 'common.inc.php';
if ($user->isLoggedIn() === false) {
  include 'templates/not-logged-in.php';
  exit;
}
$pageTitle = 'BubbleDo';
include 'templates/loggedin-header.php';
include 'templates/loggedin-footer.php';