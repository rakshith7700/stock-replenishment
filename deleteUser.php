<?php
require_once "config.php";

if(isset($_POST["id"])){
$userId = $_POST["id"];
$updateUser = mysqli_query($conn, "UPDATE user SET status='inactive' WHERE id='$userId'");
}
?>