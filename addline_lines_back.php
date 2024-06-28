<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $line = $_POST['line'];
    $plant = $_POST['plant_id'];

    $s = mysqli_query($conn, "INSERT INTO lines_table (line_name, plant_id, status) VALUES ('$line', '$plant', 1)") or die(mysqli_error($conn));
    
    $l_id = mysqli_query($conn, "SELECT line_id FROM lines_table WHERE line_name='$line' AND plant_id='$plant'") or die(mysqli_error($conn));
    $l_id1 = mysqli_fetch_object($l_id);
    $line_id = $l_id1->line_id;

    $response = array(
        'success' => true,
        'line_id' => $line_id
    );
    
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    $response = array(
        'success' => false,
        'message' => 'Invalid request method'
    );
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
