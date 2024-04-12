<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: text/plain; charset=UTF-8");

include('../config/sess.php');



  $docId = $_GET['docId'];

  $accessToken = $_SESSION['access_token'];

function sendHttpRequest($url, $method, $requestData, $accessToken) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer ' . $accessToken
    ));
    $response = curl_exec($ch);
    curl_close($ch);
 
    return $response;
};

function docLookup($docId, $accessToken){
    $apiUrl = 'http://192.168.0.117:8080/api/v1/epayment/cashier/payment/getDoc?DocID=' .$docId;
    
    $resData = sendHttpRequest($apiUrl,"GET", "", $accessToken);
  
    return $resData;
}

echo docLookup($docId,$accessToken);

?>