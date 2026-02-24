<?php
// send_sms.php
// 1. Get the parameters from your AJAX call
$destination = $_POST['destination'] ?? '';
$message = $_POST['message'] ?? '';

// 2. Build the Dialog API URL
$api_url = "https://richcommunication.dialog.lk/api/sms/inline/send";
$params = [
    'q' => '14994248765409', // Your API Key/Q param
    'destination' => $destination,
    'message' => $message,
    'from' => 'HomeAffairs'
];

$final_url = $api_url . "?" . http_build_query($params);

// 3. Make the request from SERVER to SERVER (No CORS here!)
$response = file_get_contents($final_url);

// 4. Return the API response back to your JavaScript
header('Content-Type: application/json');
echo $response;
?>