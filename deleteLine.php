<?php
require_once "config.php";


$machineId = $_POST["lineId"];
$a=mysqli_query($conn,"SELECT COUNT(*) as count from machines where line_id='$machineId' and status=1");
$b=mysqli_fetch_object($a);
if($b->count==0){
$deleteMachine = mysqli_query($conn, "DELETE  from lines_table  WHERE line_id = '$machineId'");

if ($deleteMachine){
    echo "success";
}
}
else{
    echo json_encode($b);
}


?>