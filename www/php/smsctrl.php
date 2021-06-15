<?php

require_once('smsctrl.config.php');
$locale = 'fr_FR.utf-8';
setlocale(LC_ALL, $locale);
putenv('LC_ALL='.$locale);
 
header("X-Robots-Tag: noindex, nofollow", true);
 
$post_data = json_decode(file_get_contents('php://input'), true);

$token = (string)$post_data['token'];
 
$data = array();
if (!$token
	|| !$tokens_authorized
	|| !in_array($token, $tokens_authorized)) {
    $data = array(
        'error' => "Not authorised",
        'error_code' => 403,
        'error_description' => "Not authorised",
        'resource' => null,
	'token' => $token
    );
    echo json_encode($data);
    header('HTTP/1.0 403 Forbidden');
    exit;
}
 
$message = urldecode((string)$post_data['msg']);
$number = (string)$post_data['gsm'];
$number_array = explode('-', $number);
 
if (!$message || !$number_array) {
    $data = array(
        'error' => "Missing data",
        'error_code' => 403,
        'error_description' => "Missing data",
        'resource' => null
    );
    echo json_encode($data);
    header('HTTP/1.0 403 Forbidden');
    exit;
}
 
foreach ($number_array as $number) {
    #exec('echo "'.$message.'" | gammu --sendsms TEXT '.$number.' &');
    exec('/usr/bin/gammu-smsd-inject TEXT '.$number.' -text "'.$message.'" 1>/tmp/smsctrl.php.log 2>&1 &');
    $data[$number] = 'done';
}
echo json_encode($data);
header('HTTP/1.0 200');

?>
