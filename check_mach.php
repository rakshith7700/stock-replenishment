<?php
require_once "config.php";

$line_id = $_POST["line_id"];
$array = $_POST["arrr"]; 

$getMachine = mysqli_query($conn,"SELECT COUNT(*) as count FROM machines WHERE line_id='$line_id' AND status=1") or  die (mysqli_error($conn));


$q1 = mysqli_fetch_object($getMachine);

if ($q1) {
    $condition = $q1->count + count($array);  // Use count() to get the number of elements in the array

    if ($condition <= 18) {
        // Proceed to update the line_id for each machine ID in the array
        foreach ($array as $machine_id) {
            // Sanitize machine_id
            $machine_id = mysqli_real_escape_string($conn, $machine_id);

            // Prepare the UPDATE query
            $update_sql = "UPDATE machines SET line_id='$line_id' WHERE machine_id='$machine_id'";

            if (!mysqli_query($conn, $update_sql)) {
                die('Update query error: ' . mysqli_error($conn));
            }
        }
         
        echo "success";
    } else {
        echo "no";
    }
} else {
    echo "no data found";
}

mysqli_close($conn);
?>