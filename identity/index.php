<?php
include dirname(__FILE__).'/../common.inc.php';
if (!empty($_POST['method'])) {
	if ($_POST['method'] == 'login') {
	    $result = verify_assertion($_POST['assertion']);
	    if ($result->status === 'okay') {	    	$_SESSION['user'] = $result->email;
	    }
	    header('Content-type: application/json');
	    echo json_encode($result);
	    exit;
	} elseif ($_POST['method'] == 'logout') {
		unset($_SESSION['user']);
		session_destroy();
	}
}


function verify_assertion($assertion, $cabundle = NULL) {
    $audience = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
    $postdata = 'assertion=' . urlencode($assertion) . '&audience=' . urlencode($audience);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://verifier.login.persona.org/verify");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    if (substr(PHP_OS, 0, 3) == 'WIN') {
        if (!isset($cabundle)) {
            $cabundle = dirname(__FILE__).DIRECTORY_SEPARATOR.'cabundle.crt';
        }
        curl_setopt($ch, CURLOPT_CAINFO, $cabundle);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $json = curl_exec($ch);
    curl_close($ch);

    return json_decode($json);
}