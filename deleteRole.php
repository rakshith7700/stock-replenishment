<?php
require_once "config.php";

if(isset($_POST["id"])){
$roleId = $_POST["id"];
$updateRole = mysqli_query($conn, "UPDATE roles SET status='0' WHERE r_id='$roleId'");
}
?>