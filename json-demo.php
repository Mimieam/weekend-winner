<?php
$tasks = array(
	1 => array(
		'text' => "Present on Sunday",
		'create' => mktime(10, 0, 0, 11, 3),
		'tags' => array('tough', 'short', 'awesome'),
		'coord-x' => 100,
		'coord-y' => 100,
		'relations' => array(),
	),
	2 => array(
		'text' => "Practice Demo",
		'create' => mktime(9, 0, 0, 11, 3),
		'tags' => array('boring'),
		'coord-x' => 200,
		'coord-y' => 200,
		'relations' => array(1),
	),
	3 => array(
		'text' => "Find Parts for Demo",
		'create' => mktime(7, 0, 0, 11, 3),
		'tags' => array('tough', 'short', 'awesome'),
		'coord-x' => 300,
		'coord-y' => 300,
		'relations' => array(2),
	),
	4 => array(
		'text' => "Decide Platform for Demo",
		'create' => mktime(23, 0, 0, 11, 2),
		'tags' => array('diverse', 'awesome'),
		'coord-x' => 400,
		'coord-y' => 400,
		'relations' => array(2),
	),
	5 => array(
		'text' => "Choose accent",
		'create' => mktime(22, 0, 0, 11, 2),
		'tags' => array('silly'),
		'coord-x' => 500,
		'coord-y' => 500,
		'relations' => array(2, 1),
	),
);
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
if (isset($_GET['callback'])) {
	echo $_GET['callback'] . '('.json_encode($tasks).')';
} else {
	echo json_encode($tasks);
}