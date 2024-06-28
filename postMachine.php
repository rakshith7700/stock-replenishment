<?php
require_once "config.php";

if (isset($_POST["id"])) {
    $lineId = $_POST["id"];
    $lines = array();
        
    $getMachine = mysqli_query($conn, "SELECT * FROM machines WHERE line_id='$lineId' and status=1");
    
    while ($allLines = mysqli_fetch_object($getMachine)) {
        $lines[] = $allLines;
    }
    
    header('Content-Type: application/json');
    echo json_encode($lines);
} else {
    echo json_encode(array('error' => 'No ID provided'));
}
?>