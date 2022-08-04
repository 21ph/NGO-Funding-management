<?php

require('../../../db.php');

$amount = $_POST['amount'];
$campaign_id = $_POST['campaign_id'];
$user_id = $_POST['user_id'];
$update_user_sql = "UPDATE users SET balance = balance - $amount WHERE user_id = $user_id";
$update_campaign_sql = "UPDATE campaign SET received = received + $amount WHERE campaign_id = $campaign_id";
$create_transaction_sql = "INSERT INTO donations (user_id, campaign_id, amount) VALUES ($user_id, $campaign_id, $amount)";
$update_user_res = mysqli_query($conn, $update_user_sql);
$update_campaign_res = mysqli_query($conn, $update_campaign_sql);
$create_transaction__res = mysqli_query($conn, $create_transaction_sql);

if($update_user_res && $update_campaign_res && $create_transaction__res) {
    echo json_encode([
        'code' => 200,
        'message' => 'Success'
    ]);
} else {
    echo json_encode([
        'code' => 500,
        'message' => 'Error'
    ]);
}


?>