<?php


require('../../../db.php');
$ngo_id = $_GET['ngo_id'];
$query = "SELECT * FROM campaign WHERE ngo_id='$ngo_id'";
$res = mysqli_query($conn, $query);
$campaigns = [];
while($row = mysqli_fetch_assoc($res)){
    $campaigns[] = $row;
}
if($campaigns){
    echo json_encode(['code'=>200, 'campaigns'=>$campaigns]);
} else {
    echo json_encode(['code'=>404, 'msg'=>"No campaigns found"]);
}

?>





