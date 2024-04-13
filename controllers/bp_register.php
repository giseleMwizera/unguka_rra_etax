<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: text/plain; charset=UTF-8");

include("../helpers/functions.php");
include("../config/config.php");
include("../config/sess.php");


$requestData = [];

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
};


function postlumutel($url, $fields_string, $headers)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_FOLLOWLOCATION => 1,
        CURLOPT_VERBOSE        => 1,
        CURLOPT_STDERR => $verbose = fopen('php://temp', 'rw+')
    ));


    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function pushToDatabase($requestData)
{

    $response = array();
    global $db_mysql;

    foreach ($requestData as $data) {

        $sql = "INSERT INTO etaxpayers (RequestId, Tin, Names, Account, Currency, Phone, Nid, originator, email) 
        VALUES ('{$data['RequestId']}', '{$data['Tin']}', '{$data['Names']}', '{$data['Account']}', 
                '{$data['Currency']}', '{$data['Phone']}', '{$data['Nid']}', 'UNGUKA', '{$data['Phone']}',)";
    };

    if (mysqli_query($db_mysql, $sql)) {
        $response[] = array(
            'RequestId' => $data['RequestId'],
            'MessageCode' => 1,
            'MessageDescription' => 'Tax payer created successfully'
        );
    } else {
        $response[] = array(
            'RequestId' => $data['RequestId'],
            'MessageCode' => 0,
            'MessageDescription' => 'Error: ' . mysqli_error($db_mysql)
        );
    }

    return $response;
}


function registerAccountsToRRA($requestData, $accessToken)
{
    $apiUrl = 'http://192.168.0.117:8080/api/v1/epayment/registration/register';
    $fields_string = json_encode($requestData);
    $headers = [
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: Bearer ' . $accessToken
    ];

    $response = json_decode(postlumutel($apiUrl, $fields_string, $headers));

    if (isset($response->ResponseObject[0]->MessageCode)) {
        $messageCode = $response->ResponseObject[0]->MessageCode;

        if ($messageCode == 1) {
            print_r(pushToDatabase($requestData));
        } else {

            echo json_encode($_SESSION);
            // echo json_encode($response);
      
        }
    } else {
        
        echo json_encode($_SESSION);
        // echo json_encode($response);
    }
}

$accessToken = $_SESSION['access_token'];

registerAccountsToRRA($requestData, $accessToken);
