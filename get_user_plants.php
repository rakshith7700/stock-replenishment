<?php
require_once "config.php";
$r=$_POST['id'];
$plants = array();
$getPlants = mysqli_query($conn, "SELECT *
        FROM user u 
        JOIN all_plants p ON u.plant_id = p.plant_id 
        WHERE u.id = '$r' LIMIT 1");
        while ($allPlants = mysqli_fetch_object($getPlants)) {
 $plants[] = $allPlants;
        }
echo json_encode($plants);
?>