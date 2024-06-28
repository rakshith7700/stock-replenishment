<?php
require_once "config.php";


$machineId = $_POST["machineId"];
$deleteMachine = mysqli_query($conn, "UPDATE machines SET line_id=0 WHERE machine_id = '$machineId'");

if ($deleteMachine){
    echo "iteam deleted successfully";
}

?>