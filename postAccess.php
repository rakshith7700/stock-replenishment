<?php
require_once "config.php";

echo  $_POST["id"];
$plantId = $_POST["id"];
$editPlant = mysqli_query($conn, "DELETE FROM all_plants WHERE plant_id = '$plantId'");
if ($editPlant){
    echo "iteam deleted successfully";
}
?>