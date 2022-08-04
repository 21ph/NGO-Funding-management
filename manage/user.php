<?php

require('../db.php');
session_start();
$username = $_POST['username'];
$type = $_POST['type'];
$password = sha1($_POST['password']);

if($type=='register')
{
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username_exists_query =  "SELECT * FROM users where username='$username'";
    $username_exists_res = mysqli_query($conn, $username_exists_query);
    if(mysqli_num_rows($username_exists_res) > 0)
    {
        $msg = "Username Already Exists";
        echo json_encode(['code'=>404, 'msg'=>$msg]);
        exit;
    }
    $inserting_user_sql = "INSERT INTO users (`full_name`, `username`, `password`, `email_id`) VALUES ('$fullname', '$username', '$password', '$email')";
    if(!mysqli_query($conn, $inserting_user_sql))
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
    $login_query =  "SELECT * FROM users where username='$username' and password='$password'";
    $login_res = mysqli_query($conn, $login_query);
    if(mysqli_num_rows($login_res) != 1)
    {
        $msg = "Incorrect Email ID or Password, got the username as $username and password as $password";
        echo json_encode(['code'=>404, 'msg'=>$msg]);
        exit;
    }
    $user = mysqli_fetch_array($login_res);
    $msg = "Successfully Logged In...";
    echo json_encode(['code'=>200, 'msg'=>$msg, 'user'=>$user]);
    exit;
}

?>