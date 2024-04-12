<?php
include("config.php");

 function generateUniqueRequestId() {
    $currentDate = date("Ymd"); 
    $currentHour = date("H");    
    $currentSeconds = date("s"); 

    $randomComponent = bin2hex(random_bytes(3)); 

    $uniqueId =  $randomComponent . $currentDate  . $currentSeconds ;
    $uniqueId = strtoupper($uniqueId);

    return $uniqueId;
}


function getDocID(){
  if(isset($_GET['docId'])) {
  
    $docId = $_GET['docId'];

    $url = "http://192.168.0.117:8080/api/v1/epayment/cashier/payment/getDoc?DocID=" . urlencode($docId);

   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Bearer: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJVTkdVS0FCIiwicm9sZXMiOlsiUlJBX0VQQVlfQVBJX1VTRVIiXSwiaXNzIjoiaHR0cDovLzE5Mi4xNjguMC4xMTc6ODU3MC9hcGkvdjEvZXBheW1lbnQvYXV0aC90b2tlbi9yZWZyZXNoIiwiZXBheW1lbnRfYmFua19pZCI6MjA0LCJlcGF5bWVudF91c2VyX2lkIjo5OCwiZXhwIjoxNzA5MjEwMzUwfQ.XUbAc6YwkRQwnq82dZ8UlB0nUI9pv2nAQDI7fERi994'
       
    ));

    $response = curl_exec($ch);

 
    if(curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }
    curl_close($ch);

    echo $response;
} else {
    echo "Error: docId not provided.";
}
}


function showphone ($phone) {
    
    $phone =   substr($phone,2,10);
   // $phone =   substr($phone,0,3)." ".substr($phone,3,3)." ".substr($phone,6,4);
              
              return $phone;
  }
  

    
?>
