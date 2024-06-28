<?php
require_once "config.php";
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $cotp=$_POST['otp'];
    $e=$_SESSION['mail'];
    $check=mysqli_query($conn,"SELECT * from user where usermail='$e'") or die(mysqli_error($conn));
    $check1=mysqli_fetch_object($check);
    if($cotp==$check1->otp){
        echo "success";

    }
    else{
        echo "Please enter correct OTP";
    }
}



?>