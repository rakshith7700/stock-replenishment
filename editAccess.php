<?php
require_once "config.php";

echo  $_POST["id"];

$plantId = $_POST["id"];
$editValue = $_POST["plantName"];
$colo=$_POST['colors'];
$editPlant = mysqli_query($conn, "UPDATE all_plants SET plant_name = '$editValue',colours= '$colo' WHERE plant_id = '$plantId'");
if ($editPlant){
    echo "iteam deleted successfully";
}
?>