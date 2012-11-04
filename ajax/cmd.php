<?php
include dirname(__FILE__).'/../common.inc.php';
if ($user->isLoggedIn() === false) {
  die('Access not allowed');
}

$cmd = isset($_REQUEST['cmd']) ? $_REQUEST['cmd'] : false;
switch ($cmd) {
	case 'move-task':
		Task::reposition($_REQUEST['id'], $_REQUEST['top'], $_REQUEST['left'], $user);
		exit;
	break;
}
