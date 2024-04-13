<?php
header("Content-Type: text/plain; charset=UTF-8");

include("../config/sess.php");

function lumutelRequest($url, $headers, $method = 'GET', $data = null)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$username = $_POST['username'];
$password = $_POST['password'];
$headers = [
    'username: ' . $username,
    'password: ' . $password,
    'accept: application/json',
];

$fields_string = '';
$api_response = lumutelRequest("http://192.168.0.117:8080/api/v1/epayment/auth/login", $headers,"POST", $fields_string);

$response = json_decode($api_response, true);

if ($response['MessageCode'] === 1) {

    $_SESSION['loggedin'] = true;
    $_SESSION['access_token'] = $response['ResponseObject']['AccessToken'];
    $_SESSION['refresh_token'] = $response['ResponseObject']['RefreshToken'];
    $_SESSION['token_expiry'] = time() + 24 * 3600;
    header('Location: ../views/dashboard.php');
    exit();

} else {

    if ($response["Errors"]["Error"] === "Please use your refresh token to get a new one") {
        
        $refresh_token = $_SESSION['refresh_token'];
        $headers = [
            'Authorization: Bearer ' . $refresh_token,
            'accept: application/json',
        ];

        $refresh_response = lumutelRequest("http://192.168.0.117:8080/api/v1/epayment/auth/token/refresh", $headers);
        $refresh_result = json_decode($refresh_response, true);
        
        if (isset($refresh_result['ResponseObject']['AccessToken'])) {
            $_SESSION['access_token'] = $refresh_result['ResponseObject']['AccessToken'];
            $_SESSION['token_expiry'] = time() + 24 * 3600;
            $_SESSION['loggedin'] = true;
            $new_access_token = $_SESSION['access_token'];
            header('Location: ../?content=dashboard');
            exit();
        } else {
            header("Location: ../index.php?error=" . $refresh_result["Errors"]["Error"] . "In refreshing");
            exit();
        }
    } else if ($response['Errors']['Error'] === "You are already logged in") {
        $_SESSION['refresh_token'] = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJVTkdVS0FCIiwiaXNzIjoiaHR0cDovLzE5Mi4xNjguMC4xMTc6ODU3MC9hcGkvdjEvZXBheW1lbnQvYXV0aC9sb2dpbiIsImV4cCI6MTcxNTUwNjE3MH0.sbtqkV17KgrdiYx6t8I5oRhqrF8Q8Pq7swrz9EsyItw";
        $refresh_token = $_SESSION['refresh_token'];
        $refresh_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJVTkdVS0FCIiwiaXNzIjoiaHR0cDovLzE5Mi4xNjguMC4xMTc6ODU3MC9hcGkvdjEvZXBheW1lbnQvYXV0aC9sb2dpbiIsImV4cCI6MTcxNTUwNjE3MH0.sbtqkV17KgrdiYx6t8I5oRhqrF8Q8Pq7swrz9EsyItw";
        $headers = [
            'Authorization: Bearer ' . $refresh_token,
            'accept: application/json',
        ];

        $refresh_response = lumutelRequest("http://192.168.0.117:8080/api/v1/epayment/auth/token/refresh", $headers);
        $refresh_result = json_decode($refresh_response, true);
        print_r($refresh_result);

        if (isset($refresh_result['ResponseObject']['AccessToken'])) {
            $_SESSION['access_token'] = $refresh_result['ResponseObject']['AccessToken'];
            $_SESSION['token_expiry'] = time() + 24 * 3600;
            $_SESSION['loggedin'] = true;
            $new_access_token = $_SESSION['access_token'];
            // header('Location: ../?content=dashboard');
            exit();
        } else {
            header("Location: ../index.php?error=" . $refresh_result["Errors"]["Error"] . "In refreshing");
            exit();
        }
        // header('Location: ../views/dashboard.php');
        exit();
    } else {
        header("Location: ../index.php?error=" . $response["ResponseObject"]["Error"]);
        exit();
    }
}
