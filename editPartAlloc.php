<?php
require_once "config.php";

$machineId = $_POST["id"];
$editMachine = $_POST["machine"];
$editPartNumber = $_POST["partNumber"];
$editPartName = $_POST["partName"];

$editMachine = mysqli_query($conn, "UPDATE machines SET machine_name = '$editMachine', part_number = '$editPartNumber', part_name = '$editPartName' WHERE machine_id = '$machineId'");
if($editMachine){
    echo "success";

}
else{
    echo "failure";
}
?>