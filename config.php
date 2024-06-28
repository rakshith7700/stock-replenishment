<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "stock_replinishment";



$conn = new mysqli($servername, $username, $password, $database);

if($conn){
   // echo  "success";
}
else{
   // echo "error";
}


?>