<?php

require_once "config.php";


$plants = array();
$getPlants = mysqli_query($conn, "SELECT * from all_plants WHERE status='1'");
while ($allPlants = mysqli_fetch_object($getPlants)) {
 $plants[] = $allPlants;
}
echo json_encode($plants);

?>
