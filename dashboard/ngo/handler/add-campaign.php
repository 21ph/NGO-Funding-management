<?php

require('../../../db.php');
$title = $_POST['campaign_title'];
$description = $_POST['campaign_description'];
$target = $_POST['target'];
$ngo_id = $_POST['ngo_id'];

$sql_query = "INSERT INTO campaign (`campaign_name`, `description`, `total`, `ngo_id`) VALUES ('$title', '$description', '$target', $ngo_id)";
if(mysqli_query($conn, $sql_query)){
    echo json_encode(['code'=>200, 'msg'=>"Campaign created successfully"]);
} else {
    echo json_encode(['code'=>404, 'msg'=>"Could not insert into the database"]);
}


?>