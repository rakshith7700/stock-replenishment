<?php
require_once "config.php";

echo  $_POST["id"];
echo $_POST["value"];
$roleId = $_POST["id"];
$editValue = $_POST["value"];
$editRole = mysqli_query($conn, "UPDATE roles SET role_name = '$editValue' WHERE r_id = '$roleId'");
if ($editRole){
    echo "iteam deleted successfully";
}
?>