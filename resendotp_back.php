<?php
require_once 'config.php';
session_start();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $mail=$_SESSION['mail'];
    $otp=$_POST['otp'];

    $o=mysqli_query($conn,"UPDATE user SET otp='$otp' where usermail='$mail'") or die(mysqli_error($conn));
    if($o){
        echo 'success';
    }
    else{
        echo 'failed';
    }
}
else{
    echo 'something error';
}


?>