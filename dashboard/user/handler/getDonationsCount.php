<?php


require('../../../db.php');
$sql = "SELECT count(*) FROM donations";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
echo json_encode([
    'code' => 200,
    'count' => $row['count(*)']
]);



?>