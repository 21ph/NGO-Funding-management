<?php


require('../../../db.php');
$user_id = $_POST['user_id'];
$sql = "SELECT users.full_name, campaign.campaign_name, donations.amount, donations.donation_id, donations.timestamp FROM donations JOIN users on donations.user_id=users.user_id JOIN campaign on donations.campaign_id=campaign.campaign_id WHERE users.user_id=$user_id ORDER BY donations.timestamp DESC LIMIT 7";
$res = mysqli_query($conn, $sql);
$donations = [];
while($row = mysqli_fetch_assoc($res)) {
    $donations[] = $row;
}
echo json_encode([
    'code' => 200,
    'donations' => $donations
]);

?>