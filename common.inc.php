<?php
define('APP_PATH', dirname(__FILE__).'/');
include APP_PATH.'config.ini.php';
$GLOBALS['conn'] = new mysqli(SQL_HOST, SQL_USER, SQL_PASS, SQL_DATABASE);
if (empty($GLOBALS['conn'])) {
	die('Cannot talk to MySQL server.');
}
$GLOBALS['conn']->set_charset("utf8");
include APP_PATH.'classes/User.class.php';
include APP_PATH.'classes/Topic.class.php';
include APP_PATH.'classes/Task.class.php';

include APP_PATH.'/classes/Amazon/sdk.class.php';
include APP_PATH.'/classes/Amazon/services/s3.class.php';

session_start();
if (isset($_SESSION['user'])) {
	$user = new User($_SESSION['user']);
} else {
	$user = new User();
}