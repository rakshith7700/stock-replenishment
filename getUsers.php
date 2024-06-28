<?php

require_once "config.php";
$uu=$_POST['plant_id'];
$users = array();
$query = "
    SELECT *
    FROM user 
    JOIN roles ON user.r_id = roles.r_id 
    WHERE user.plant_id='$uu' and user.status='active'
";

$getUsers = mysqli_query($conn, $query);
while ($allUsers = mysqli_fetch_object($getUsers)) {
    $users[] = $allUsers;
}
echo json_encode($users);

?>