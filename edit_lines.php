<?php
require_once "config.php";

$machineId = $_POST["id"];
$machineName = $_POST["machine"];

$editMachineName = mysqli_query($conn, "UPDATE lines_table SET line_name = '$machineName' WHERE line_id = '$machineId'");
?>