<?php
require_once "config.php";
session_start();
if($_SERVER["REQUEST_METHOD"]==='POST'){
    $email=$_POST['email'];
    $otp=$_POST['otp'];
    $r=mysqli_query($conn,"SELECT * FROM user where usermail='$email'") or die(mysqli_error($conn));
    if(mysqli_num_rows($r)>0){
        $m=mysqli_fetch_object($r);
        $_SESSION['mail']=$email;
      
        $o=mysqli_query($conn,"UPDATE user SET otp='$otp' where usermail='$email'") or die(mysqli_error($conn));
        if($o){
        echo json_encode(['status' => 'success']);
        }
        else{
            echo json_encode(['status' => 'error', 'message' => 'Failed to save OTP.']);
        }
    }
    else{
        echo json_encode(['status' => 'error', 'message' => 'Email not found']);
    }
    

}

?>