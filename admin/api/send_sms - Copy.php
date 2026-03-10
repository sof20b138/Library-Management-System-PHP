<?php
include('../includes/config.php');

// Initialize a response array
$output = [
    'success' => false,
    'message' => 'Unknown error',
    'api_raw' => ''
];

$destination = $_POST['destination'] ?? '';
$message = $_POST['message'] ?? '';
$issueid = $_POST['issueid'] ?? null;
$reminder = $_POST['reminder'] ?? 0;
$reminder++;

if ($issueid) {
    $sql = "UPDATE tblissuedbookdetails SET Reminder=:reminder, ReturnDate=null WHERE id=:issueid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':reminder', $reminder, PDO::PARAM_INT);
    $query->bindParam(':issueid', $issueid, PDO::PARAM_INT);

    if ($query->execute()) {
        $api_url = "https://richcommunication.dialog.lk/api/sms/inline/send";
        $params = [
            'q' => '14994248765409', 
            'destination' => $destination,
            'message' => $message,
            'from' => 'HomeAffairs'
        ];

        $final_url = $api_url . "?" . http_build_query($params);
        
        // Use error suppression and check result
        $api_res = @file_get_contents($final_url);

        if ($api_res !== false) {
            $output['success'] = true;
            $output['message'] = 'SMS Processed';
            $output['api_raw'] = $api_res; // Keep this to see what Dialog actually says
        } else {
            $output['message'] = 'Database updated, but SMS API connection failed.';
        }
    } else {
        $output['message'] = 'Database update failed.';
    }
} else {
    $output['message'] = 'Missing Issue ID.';
}

// ALWAYS return JSON
header('Content-Type: application/json');
echo json_encode($output);
exit;