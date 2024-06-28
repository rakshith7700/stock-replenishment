<?php
require_once "config.php";
$d=$_POST['id'];
$q=mysqli_query($conn,"SELECT * from roles where plant_id='$d'");
$roles=[];
while($qq=mysqli_fetch_object($q)){
    $roles[]=$qq;
}
echo json_encode($roles);

?>