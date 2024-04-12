<?php

header("Content-Type: text/plain; charset=UTF-8");

include("config.php");

function sendOTP($otpNumber)
{
    return $otpNumber;
}

function verifyOTP($otpNumber)
{
    global $otp;
    if ($otpNumber == $otp) {
        return true;
    } else {
        return false;
    }
}

function sendHttpRequest($url, $requestData)
{
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
}

function checkAccountExists($accountNumber, $customerNumber)
{
    $apiUrl = 'http://10.99.100.221/xapi/v1.1/accountLookUp';
    $requestData = array(
        'referenceId' => 1,
        'accessCode' => 'UngukaBank',
        'accountNumber' => $accountNumber,
        'customerNumber' => $customerNumber
    );
    $response = sendHttpRequest($apiUrl, $requestData);
    $resData = json_decode($response, true);
    if (isset($resData['responseCode']) && $resData['responseCode'] == 00) {

        return true;
    } else {
        return false;
    }
}

function registerTaxPayer($requestData)
{
    global $db_mysql;
    $response = array();

    foreach ($requestData as $data) {
        $accountNumber = $data['Account'];
        $customerNumber = $data['Phone'];

        if (checkAccountExists($accountNumber, $customerNumber)) {
            $response[] = array(
                'RequestId' => $data['RequestId'],
                'MessageCode' => 0,
                'MessageDescription' => 'Account exists'
            );
        } else {
            $sql = "INSERT INTO etaxpayers (RequestId, Tin, Names, Account, Currency, Phone, Nid, Email) 
                VALUES ('{$data['RequestId']}', '{$data['Tin']}', '{$data['Names']}', '{$data['Account']}', 
                        '{$data['Currency']}', '{$data['Phone']}', '{$data['Nid']}', '{$data['Email']}')";

            if (mysqli_query($db_mysql, $sql)) {
                $response[] = array(
                    'RequestId' => $data['RequestId'],
                    'MessageCode' => 1,
                    'MessageDescription' => 'New account created successfully'
                );
            } else {
                $response[] = array(
                    'RequestId' => $data['RequestId'],
                    'MessageCode' => 0,
                    'MessageDescription' => 'Error: ' . mysqli_error($db_mysql)
                );
            }
        }
    }
    return $response;
}

$requestData = array(
    array(
        'RequestId' => generateUniqueRequestId(),
        'Tin' => '103134666',
        'Names' => 'SITINA LTD',
        'Account' => '10100000560019',
        'Currency' => 4,
        'Phone' => '0788482014',
        'Nid' => '1199870021034088',
        'Email' => 'test@esicia.rw'
    )
);

$registrationResponse = registerTaxPayer($conn, $requestData);

foreach ($registrationResponse as $response) {
    if ($response['MessageCode'] == 1) {
        $otp = rand(1000, 9999);
        $otpVerificationRequestData = array(
            'RequestId' => $response['RequestId'],
            'OTP' => sendOTP($otp)
        );

        $otpVerificationResponse = verifyOTP($otpVerificationRequestData);

        if ($otpVerificationResponse) {
            echo json_encode($otpVerificationResponse, JSON_PRETTY_PRINT);
        } else {
            echo json_encode($otpVerificationResponse, JSON_PRETTY_PRINT);
        }
    } else {
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}

mysqli_close($conn);
