<?php
include_once('Smscountryapi.php');
$token = "QoVeIRIORSBkUn6pDg3AKLNFy126VOI7ohS2lRzw";
$key = "aWR5R3M2bXN2Qmg3R1phRTZFZU06UW9WZUlSSU9SU0JrVW42cERnM0FLTE5GeTEyNlZPSTdvaFMybFJ6dw==";

$connection = new Smscountryapi('idyGs6msvBh7GZaE6EeM','QoVeIRIORSBkUn6pDg3AKLNFy126VOI7ohS2lRzw'); //i created a new object
//die('dd');
//$conn=$connection->getSmsDetails('a705324e-5437-4905-9bb1-62b9e3b9b611'); 
//$conn=$connection->getSmsCollection('','2015-02-19 15:04','','',3); 
//$conn=$connection->sendSms('hello php testing','918284008438','SMSCou');
//$conn=$connection->sendBulkSms('hello php testing bult',array('918284008438','919815091410'));
//$conn=$connection->numberArraycon(array('918284008438','919815091410'));
//$conn=$connection->getCallDetails('b2916af6-2fab-4218-b739-d66a48ed50f3');
//$conn=$connection->getCallsList('','2015-02-19 15:04','','',3); 
$conn = $connection->DisconnectAllParticipants();
echo "<pre>";
print_r($conn);
?>
