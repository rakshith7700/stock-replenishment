<?php
require_once "config.php";

$machineId = $_POST["id"];
$machineName = $_POST["machine"];

$editMachineName = mysqli_query($conn, "UPDATE machines SET machine_name = '$machineName' WHERE machine_id = '$machineId'");
?>