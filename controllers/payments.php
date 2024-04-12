<?php
require('config.php');
require("functions.php");
header("Content-Type: text/plain; charset=UTF-8");

$rraData = array(
    "RraRef" => "231231321321",
    "DecId" =>  167076386,
    "Tin" => "100005050",
    "DocID" => 55632207,
    "AccountNumber" =>  "10100000560018",
    "CurrencyNumber"=> 2,
    "Amount" => 1000,
    "RequestId" => generateUniqueRequestId(),
    "TaxType" => 1,
    "TaxTypeDescription" => "Testing BAL ENQUIRY",
    "TaxCenter" => 1,
    "TaxCenterDescription" => "KIGALI LTD",
    "AssessmentNumber" => 18053237,        
);

$OtpDetails = array(
"RequestId" => "230",
"OTP" => "731204"
);

function sendHttpRequest($url, $requestData) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json'
    ));
    $response = curl_exec($ch);
    curl_close($ch);
 
    return $response;
};

function checkBalance($balanceParams) {
$apiUrl = 'http://10.99.100.221:3800/xapi/v1.1/balanceInquiry';

$refId = $balanceParams['RraRef'];
$accountNumber = $balanceParams['AccountNumber'];
$narration = $balanceParams['TaxTypeDescription'];

    $requestData = array(
        'referenceId' => $refId, 
        'accessCode' => "UngukaBank", 
        'narration' => $narration,
        'accountNo' => $accountNumber,
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
};

function accountLookup($lookupDetails){
    $apiUrl = 'http://10.99.100.221:3800/xapi/v1.1/accountLookUp';
    $requestData = array(
        'referenceId' => $lookupDetails['RraRef'], 
        'accessCode' => $lookupDetails['TaxCenterDescription'], 
        'narration' => 'Testing Account Lookup',
        'accountNo' => $lookupDetails['AccountNumber'],
        'customerNumber' => ""
    );
    $response = sendHttpRequest($apiUrl, $requestData);
    $resData = json_decode($response, true);
   
    
    if (isset($resData['responseCode']) && $resData['responseCode'] == '00') {
        return array(
            "responseCode" => 1,
            "responseMessage" => "Account exists",
            "data" => $resData
        );
    } else {
        return array(
            "responseCode" => 0,
            "responseMessage" => "Account doesn\'t exists",
            "data" => $resData
        );
    }
}

function sendOTP(){
    return 731204;
}

function validateOTP($OtpDetails){
$response = array();

$otp = $OtpDetails['OTP'];

if($otp == sendOTP()){
    // moneyTransfer();
}else{

}
}

function initiatePayment($rraData){
    $response = array();
  try{
    
    if(accountLookup($rraData)['responseCode'] == 1){

    if(checkBalance($rraData) >= $rraData['Amount']){

        $response[] = array(
            'RequestId' => $rraData['RequestId'],
            'MessageCode' => 1,
            'MessageDescription' => 'Payment Request Received Successfully'
        );
        // validateOTP($OtpDetails);
    } else{
        $response[] = array(
            'RequestId' => $rraData['RequestId'],
            'MessageCode' => 0,
            'MessageDescription' => 'Balance is unsufficient'
        );
    }
  } else {
    $response[] = array(
        'RequestId' => $rraData['RequestId'],
        'MessageCode' => 0,
        'MessageDescription' => 'Account doesn\'t exist'
    );
  }
    return $response;

}catch(Exception $e){

         echo 'Caught exception: ',  $e->getMessage(), "\n";
         return $e->getMessage();
     }

};

function moneyTransfer($rraData){
    $apiUrl = 'http://10.99.100.221:3800/xapi/v1.1/accountTransfer';
    $requestData = array(
        // 'referenceId' => $lookupDetails['RraRef'], 
        'accessCode' => "UngukaBank", 
        'narration' => "Testing TRANSFER",
        'txnAmount'=> 10,
        "currency" => "RWF",
        "originator" => "NJINU",
        // 'accountNo' => $lookupDetails['AccountNumber'],
        "contraAcctNo"=> "10100000560018"
    );
    $response = sendHttpRequest($apiUrl, $requestData);
    $resData = json_decode($response, true);
   
}


print_r(initiatePayment($rraData));
// initiatePayment($rraData);
// print_r(accountLookup($rraData));
// accountLookup($rraData);

// print_r(sendPayment($rraData));