<?php
require_once "config.php";

if (isset($_POST["id"])) {
    $machineId = $_POST["id"];
    $machine = array();
    
    
    $getMachine = mysqli_query($conn, "SELECT * FROM machines WHERE line_id='$machineId'");
    
    while ($allMachine = mysqli_fetch_object($getMachine)) {
        $machine[] = $allMachine;
    }
    
    echo json_encode($machine);
}
?>