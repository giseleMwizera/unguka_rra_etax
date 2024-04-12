<?php

function sendRegistrationRequest($requestData) {
    
    $response = http_post("", $requestData);
    return $response;
}

// Example usage:
$requestData = array(
    'RequestId' => uniqid(), 
    'Tin' => '100050928',
    'Names' => 'John Doe',
    'Account' => '123456789',
    'Currency' => 2,
    'Phone' => '1234567890',
    'Nid' => '1234567890123456',
    'Email' => 'john@example.com'
);

$response = sendRegistrationRequest($requestData);
echo json_encode($response);

?>