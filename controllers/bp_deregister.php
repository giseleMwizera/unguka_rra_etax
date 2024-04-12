<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: text/plain; charset=UTF-8");
    
    include("functions.php");
    include("config.php");


    $requestData = [];
    
    foreach ($_POST['names'] as $key => $name) {
        $requestData[] = array(
            'RequestId' => generateUniqueRequestId(),
            'Tin' => $_POST['tin'][$key],
            'Account' => $_POST['account'][$key],
            
        );
    }
    
    
    function postlumutel($url, $fields_string, $headers) {
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
    
    function deleteFromDatabase($requestData){
    
        $response = array();
        global $db_mysql;
    
        foreach($requestData as $data){
    
            $sql = "DELETE FROM etaxpayers where Tin = $data[Tin]";
        };
       
        if (mysqli_query($db_mysql, $sql)) {
            $response[] = array(
                  'RequestId' => $data['RequestId'],
                  'MessageCode' => 1,
                  'MessageDescription' => 'Tax payer deleted successfully'
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

    
    function deregisterAccounts($requestData, $accessToken) {
        $url = 'http://192.168.0.117:8080/api/v1/epayment/registration/deregister';
        $data = json_encode($requestData);
        $headers = array(
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Bearer ' . $accessToken
        );

        $response = postlumutel($url, $data, $headers);
        print_r($response);
        return ;
    }
    
    $accessToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJVTkdVS0FCIiwicm9sZXMiOlsiUlJBX0VQQVlfQVBJX1VTRVIiXSwiaXNzIjoiaHR0cDovLzE5Mi4xNjguMC4xMTc6ODU3MC9hcGkvdjEvZXBheW1lbnQvYXV0aC90b2tlbi9yZWZyZXNoIiwiZXBheW1lbnRfYmFua19pZCI6MjA0LCJlcGF5bWVudF91c2VyX2lkIjo5OCwiZXhwIjoxNzA5NjM0NzA4fQ.6RBOK24Z95JvLPkZh1dbqguVJlE7dnz3HT6aSrKzU9E";
    
    echo deregisterAccounts($requestData, $accessToken);


?>