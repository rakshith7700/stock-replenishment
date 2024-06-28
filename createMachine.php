<?php
require_once "config.php";

$plant = $_POST["plant"];
// $line = $_POST["line"];
$machine = $_POST["machine"];


$createMachine = mysqli_query($conn, "INSERT INTO machines (machine_name, plant_id) VALUES ('$machine', '$plant')");
if($createMachine){
    echo "success";
}
else{
    echo "failed";
}


?>