<?php

require('../db.php');
session_start();
$emailid = $_POST['emailid'];
$type = $_POST['type'];
$password = sha1($_POST['password']);

if($type=='register')
{
    $org_name = $_POST['org_name'];
    $address= $_POST['address'];
    $phone_no = $_POST['phone_no'];

    $emailid_exists_query =  "SELECT * FROM ngo where email_id='$emailid'";
    $emailid_exists_res = mysqli_query($conn, $emailid_exists_query);
    if(mysqli_num_rows($emailid_exists_res) > 0)
    {
        $msg = "Email already exists";
        echo json_encode(['code'=>404, 'msg'=>$msg]);
        exit;
    }
    $inserting_ngo_sql = "INSERT INTO ngo (`organisation_name`,`password`,`address`,`phone_no`, `email_id`) VALUES ('$org_name','$password','$address','$phone_no','$emailid')";
    if(!mysqli_query($conn, $inserting_ngo_sql))
    {
        $msg = "<li>Cannot Register, Please try again...</li>";
        echo json_encode(['code'=>400, 'msg'=>$msg]);
        exit;
    }
    $msg = "Successfully Registered";
    echo json_encode(['code'=>200, 'msg'=>$msg]);
    exit;
}
else if($type=='login'){
    $login_query =  "SELECT * FROM ngo where email_id='$emailid' and password='$password'";
    $login_res = mysqli_query($conn, $login_query);
    if(mysqli_num_rows($login_res) != 1)
    {
        $msg = "Incorrect Email ID or Password, got the emailid as $emailid and password as $password";
        echo json_encode(['code'=>404, 'msg'=>$msg]);
        exit;
    }
    $user = mysqli_fetch_array($login_res);
    $msg = "Successfully Logged In...";
    echo json_encode(['code'=>200, 'msg'=>$msg, 'user'=>$user]);
    exit;
}

?>