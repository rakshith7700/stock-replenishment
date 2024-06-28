<?php

require_once "config.php";
$plantid=$_POST['p_id'];

$machines = array();
$selectmachines = mysqli_query($conn, "SELECT * from machines WHERE plant_id='$plantid' and line_id=0");
while ($freemachines = mysqli_fetch_object($selectmachines)) {
 $machines[] = $freemachines;
}
echo json_encode($machines);

?>