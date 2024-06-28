<?php
require_once "config.php";

$role = $_POST["role"];
$id=$_POST['plant_id'];

$insertRole = mysqli_query($conn, "INSERT INTO roles (role_name,plant_id) VALUES ('$role',$id)");


?>