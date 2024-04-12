<?php
require('config.php');
require("functions.php");
header("Content-Type: text/plain; charset=UTF-8");

$docId = $_POST['docId'];


foreach ($_POST['names'] as $key => $name) {
    $requestData[] = array(
        'RequestId' => generateUniqueRequestId(),
        'Tin' => $_POST['tin'][$key],
        'Names' => $name,
        'Account' => $_POST['account'][$key],
        'Currency' => $_POST['currency'][$key],
        'Phone' => $_POST['number'][$key],
        'Nid' => $_POST['NID'][$key]
    );
}
print_r($requestData);
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

function makePayment(){
    $apiUrl = 'http://10.99.100.221:3800/xapi/v1.1/accountTransfer';

        $requestData = array(
            'referenceId' => $refId, 
            'accessCode' => "UngukaBank", 
            'narration' => $narration,
            "txnAmount" => 10,
            "currency" =>  "RWF",
            "originator" => "NJINU",
            "accountNo" => "10100000560018",
            "contraAcctNo" => "10100000150017"
        );
    
        $response = sendHttpRequest($apiUrl, $requestData);
    
        $resData = json_decode($response, true);
    
        if (isset($resData['responseCode']) && $resData['responseCode'] == '00') {
            if (isset($resData['availableBalance'])) {
                return $resData['availableBalance'];
            } else {
                throw new Exception("Balance retrieval failed!");
            }
        } else {
            throw new Exception("Check balance failed!");
        } 

}
function saveToDB(){

}

function sendResponse(){

}


$accessToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJVTkdVS0FCIiwicm9sZXMiOlsiUlJBX0VQQVlfQVBJX1VTRVIiXSwiaXNzIjoiaHR0cDovLzE5Mi4xNjguMC4xMTc6ODU3MC9hcGkvdjEvZXBheW1lbnQvYXV0aC90b2tlbi9yZWZyZXNoIiwiZXBheW1lbnRfYmFua19pZCI6MjA0LCJlcGF5bWVudF91c2VyX2lkIjo5OCwiZXhwIjoxNzA5MDI0OTgwfQ.A_Eq9PL-B492yO2qOVhUmOA2WfllG_pf2xB_PG-cbmY";

$response = json_decode(docLookup('0014415685',$accessToken));

$taxDetails = array();

 if (isset($response->MessageCode)) {
    $messageCode = $response->MessageCode;

    if ($messageCode == 1) {
       $docDetails =  json_decode(json_encode($response->ResponseObject), true)
       ;
    } else {
    
        echo "Response from RRA API:\n" . json_encode($response);
    }
} else {
  
    echo "Invalid response format from RRA API:\n" . json_encode($response);
}

print_r($taxDetails);

?>