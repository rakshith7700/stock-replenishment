<?php
session_start();
require_once "config.php";


$username = $_POST['username'];
$password = $_POST['password'];
$s=mysqli_query($conn,"SELECT * FROM user where usermail='$username' and password='$password'") or die(mysqli_error($conn));
$admin=mysqli_query($conn,"SELECT * from admin where admin_mail='$username' and admin_pass='$password'") or die(mysqli_error($conn));
if(mysqli_num_rows($s)>0){
    $s1=mysqli_fetch_object($s);
    $_SESSION['u']=$s1;
    echo "Login Successfull";
    // echo $_SESSION['u'];
   
}
elseif(mysqli_num_rows($admin)>0){
    $a1=mysqli_fetch_object($admin);
    $_SESSION['u']=$a1;
    echo "Login Successfull";
}
else{
    echo "Check your credentials";
}

       
   

?>