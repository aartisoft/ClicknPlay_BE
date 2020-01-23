<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");

header('Content-Type: application/json');
ob_start();
error_reporting(E_ALL); //E_ALL ^ E_NOTICE ^ E_DEPRECATED
ini_set('display_errors', 0);
$response = array();

$url = "http://menadcb.etracker.cc/MENAMsisdnForwarding/MsisdnForwarding.aspx?AccessToken=21F5F3293EEDACBC57BA4585976D0CF7&Language=1&CountryId=21&ServiceName=FunMunch&Price=5.00&SubscriptionCycle=2&RefId=r5h97u3nvqcqsphhqdgq&CallBackUrl=http%3a%2f%2ffunmunch.mobi%2finit-response&FreeTrial=False&RequestId=0&SubId=0";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
$data = curl_exec($ch);
curl_close($ch);
echo $data;


//echo json_encode($result,JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>