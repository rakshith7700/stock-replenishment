<?php
require_once "config.php";

// Retrieve POST data
$userId = $_POST["id"];
$userName = $_POST["name"];
$userMail = $_POST["mail"];
$userStatus = $_POST["status"];
$userRole = $_POST["role"];

// Fetch the role ID
$selectRoleIdQuery = "SELECT r_id FROM roles WHERE role_name = ?";
if ($stmt = $conn->prepare($selectRoleIdQuery)) {
    $stmt->bind_param("s", $userRole);
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

// Update the user in the database
$updateUserQuery = "UPDATE user SET username = ?, usermail = ?, status = ?, r_id = ? WHERE id = ?";
if ($stmt = $conn->prepare($updateUserQuery)) {
    $stmt->bind_param("sssii", $userName, $userMail, $userStatus, $role_id, $userId);
    if ($stmt->execute()) {
        echo json_encode(array("success" => "User updated successfully."));
    } else {
        echo json_encode(array("error" => "Error executing user update query: " . $stmt->error));
    }
    $stmt->close();
} else {
    echo json_encode(array("error" => "Error preparing user update query: " . $conn->error));
}

$conn->close();
?>