<?php
require_once "config.php";
$id=$_POST['id'];
$name=$_POST['name'];
$p_id=$_POST['p_id'];
$gg=mysqli_query($conn,"SELECT colours from all_plants where plant_id='$p_id'");
$g=mysqli_fetch_object($gg);
$c= $g->colours;
$gj=json_decode($c);
$color=$gj->$name;

$s=mysqli_query($conn,"UPDATE machines set fill_status='$name',fiill_color='$color' where machine_id='$id'");
if($s){
    echo "success";
}
else{
    echo "failure";
}





?>