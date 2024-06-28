<?php
require_once "config.php";

if (isset($_POST["id"])) {
    $machineI = $_POST["id"];
    $machin = array();
    
    
    $getMachin = mysqli_query($conn, "SELECT * FROM lines_table WHERE plant_id='$machineI'");
    
    while ($allMachin = mysqli_fetch_object($getMachin)) {
        $machin[] = $allMachin;
    }
    
    echo json_encode($machin);
}
?>