<?php

// get all campaigns
require('../../../db.php');
$sql = "SELECT * FROM `campaign`";
$result = mysqli_query($conn, $sql);
$campaigns = [];
while($row = mysqli_fetch_assoc($result)){
    $campaigns[] = $row;
}
if(count($campaigns) > 0){
    echo json_encode(array(
        'code' => 200,
        'msg' => 'Successfully retrieved campaigns',
        'campaigns' => $campaigns
    ));
} else {
    echo json_encode(array(
        'code' => 500,
        'msg' => 'Failed to retrieve campaigns'
    ));
}

?>