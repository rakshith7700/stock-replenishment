<?php

require_once "config.php";


$roles = array();
$getRoles = mysqli_query($conn, "SELECT * from roles WHERE status='1'");
while ($allRoles = mysqli_fetch_object($getRoles)) {
 $roles[] = $allRoles;
}
echo json_encode($roles);

?>