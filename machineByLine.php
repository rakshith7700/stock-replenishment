<?php
require_once "config.php";

if (isset($_POST["p_id"])) {
    $machineId = $_POST["p_id"];
    // $machineId = 1;

    $machine = array();
        
    $getMachine = mysqli_query($conn, "SELECT * FROM machines WHERE plant_id='$machineId' and status='1'");
    
    while ($allMachine = mysqli_fetch_object($getMachine)) {
        $machine[] = $allMachine;
    }
    
    echo json_encode($machine);
}
?>