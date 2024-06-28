<?php
require_once "config.php";

$m_id=$_POST['p_id'];
$s=mysqli_query($conn,"SELECT colours from all_plants where plant_id='$m_id'");
$plant_data=array();
while($s1=mysqli_fetch_object($s)){
    $plant[]=$s1;
}
echo json_encode($plant);
?>