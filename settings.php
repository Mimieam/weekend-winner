<?php
include 'common.inc.php';
if ($user->isLoggedIn() === false) {
  include 'templates/not-logged-in.php';
  exit;
}
$pageTitle = 'BubbleDo Features &amp; Settings';
$topics = $user->getTopics();
$topicAction = false;
include 'templates/loggedin-header.php';
?>
<h1>HOLD ON</h1>
<?php
include 'templates/loggedin-footer.php';