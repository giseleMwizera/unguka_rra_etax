<?php


function postRequest($url, $data, $headers) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendOTPVerificationRequest($requestData) {
    $url = 'http://bank_api_endpoint/verify_otp'; 
    $data = json_encode($requestData);
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json'
    );
    return postRequest($url, $data, $headers);
}


$requestData = array(
    'RequestId' => 1234,
    'OTP' => '123456' 
);


$response = sendOTPVerificationRequest($requestData);


echo "Response from Bank API:\n";
echo $response;

?>
