<?php

require_once "config.php";


    $id = $_POST['id'];
    $checkboxes = $_POST['checkboxes'];
    $dashboard = $_POST['dashboard'];
    $part_assignment = $_POST['part_assignment'];
    $line = $_POST['line'];
    $machines = $_POST['machine'];
    $part_alloc = $_POST['part_alloc'];

    $updateRole = mysqli_query($conn, "UPDATE roles SET checkbox='$checkboxes', dash_board='$dashboard', part_assignment='$part_assignment', line='$line', machines='$machines', access='$part_alloc' WHERE r_id=$id");


?>