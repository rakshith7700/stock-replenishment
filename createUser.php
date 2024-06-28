<?php
require_once "config.php";

// Retrieve POST data
$plant_id = $_POST["plant_id"];
$name = $_POST["name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$role = $_POST["role"];

// Fetch the role ID
$selectRoleIdQuery = "SELECT r_id FROM roles WHERE role_name = ? and plant_id='$plant_id'";
if ($stmt = $conn->prepare($selectRoleIdQuery)) {
    $stmt->bind_param("s", $role);
    $stmt->execute();
    $stmt->bind_result($role_id);
    $stmt->fetch();
    $stmt->close();
} else {
    echo json_encode(array("error" => "Error preparing role selection query: " . $conn->error));
    exit();
}

// Check if role ID was found
if (empty($role_id)) {
    echo json_encode(array("error" => "Invalid role specified."));
    exit();
}

// Insert the user into the database
$insertUserQuery = "INSERT INTO user (username, usermail, password, plant_id, r_id) VALUES (?, ?, ?, ?, ?)";
if ($stmt = $conn->prepare($insertUserQuery)) {
    $stmt->bind_param("sssii", $name, $mail, $password, $plant_id, $role_id);
    if ($stmt->execute()) {
        echo json_encode(array("success" => "User created successfully."));
    } else {
        echo json_encode(array("error" => "Error executing user insertion query: " . $stmt->error));
    }
    $stmt->close();
} else {
    echo json_encode(array("error" => "Error preparing user insertion query: " . $conn->error));
}

$conn->close();
?>