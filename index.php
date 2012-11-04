<?php
include 'common.inc.php';
if ($user->isLoggedIn() === false) {
  include 'templates/not-logged-in.php';
  exit;
}

if (empty($_REQUEST['topic'])) {
	$topic = new Topic($user->getViewedTopicId(), $user);
} else {
	$topic = new Topic($_REQUEST['topic'], $user);
	if ($topic->getId()) {
		$user->setTopic($_REQUEST['topic']);
	} else {
		die('Invalid access attempt.');
	}
}

$cmd = isset($_REQUEST['cmd']) ? $_REQUEST['cmd'] : false;
switch ($cmd) {
	case 'create-topic':
		Topic::create($_REQUEST['topic-name'], $user);
		header("Location: .");
		exit;
	break;
	case 'delete-topic':
		if (Topic::delete($_REQUEST['topic-id'], $user) === false) {
			$_SESSION['message'] = 'You must have at least one topic.';
		}
		header("Location: .");
		exit;
	break;
	case 'update-topic':
		Topic::update($_REQUEST['topic-name'], $_REQUEST['topic-id'], $user);
		header("Location: .");
		exit;
	break;
	case 'new-task':
		Task::create($_REQUEST, $topic, $user);
		header("Location: .");
		exit;
	break;
}

$topics = $user->getTopics();
$tasks = $topic->getTasks();
$pageTitle = $topic->getName();
include 'templates/loggedin-header.php';
include 'templates/loggedin-footer.php';
unset($_SESSION['message']);