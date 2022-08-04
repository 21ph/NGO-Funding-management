<?php

$amount = $_POST['amount'];
$user_id = $_POST['user_id'];

require('../../../db.php');
$sql = "INSERT INTO `self_transfer` (`user_id`, `amount`) VALUES ('$user_id', '$amount')";
$result = mysqli_query($conn, $sql);


// get current balance of user
$sql = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$balance = $row['balance'];
$new_balance = $balance + $amount;
$sql = "UPDATE `users` SET `balance` = '$new_balance' WHERE `user_id` = '$user_id'";
if(mysqli_query($conn, $sql)){
    echo json_encode(array(
        'code' => 200,
        'message' => 'Successfully added funds',
        'balance' => $new_balance
    ));
} else {
    echo json_encode(array(
        'code' => 500,
        'message' => 'Failed to add funds'
    ));
}
exit;

?>