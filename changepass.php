<?php

require_once "config.php";
session_start();
if (!isset($_SESSION["mail"])) {
    header("location: loginmain.php");
    exit();
}

$userEmail = $_SESSION["mail"];

if (isset($_POST["submit"])) {
    $password = $_POST["password"];
    $confirm = $_POST["confirmPassword"];

    if (!empty($password) && !empty($confirm)) {
        if ($password === $confirm) {
            $getData = mysqli_query($conn, "SELECT * FROM user WHERE usermail='$userEmail'") or die(mysqli_error($conn));
            $checkPass = mysqli_fetch_object($getData);

            if ($checkPass->password != $password) {
                $updatePass = mysqli_query($conn, "UPDATE user SET password='$password' WHERE usermail='$userEmail'") or die(mysqli_error($conn));
              
                // Destroy the session
                session_destroy();
                
                // Include SweetAlert script
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                
                // Display SweetAlert and redirect after a delay
                echo "<script>
                    window.onload = function() {
                        swal({
                            title: 'Success',
                            text: 'Password changed successfully',
                            icon: 'success'
                        }).then(function() {
                            // Redirect to loginmain.php after the alert is closed
                            window.location.href = 'loginmain.php';
                        });
                    };
                </script>";
                
                
                
                exit();
            }else{
                  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                  echo "<script>
                    window.onload = function() {
                        swal({
                            title: 'Error',
                            text: 'The new password should not match the previous password.',
                            icon: 'error'
                        });
                    };
                </script>";
           }
        } else{
          echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
          echo "<script>
            window.onload = function() {
                swal({
                    title: 'Error',
                    text: 'Both passwords do not match.',
                    icon: 'error'
                });
            };
        </script>";
         }
    } else{
      echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
      echo "<script>
        window.onload = function() {
            swal({
                title: 'Error',
                text: 'Both password fields are required.',
                icon: 'error'
            });
        };
    </script>";
     }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New password</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-container">
  <div class="brand-section d-none d-md-block">
    <img src="images/cy4logo.png" class="cy4 img-fluid" alt="Cy4 Logo">
  </div>
  <div class="login-section">
    <form id="newPasswordForm" method="post">
      <div class="w-100 mb-4 text-center">
        <img src="images/roop-polymer-logo.png" alt="Roop Logo">
      </div>
      <div class="w-100 mb-5 text-center">
        <h5 class="hd">CREATE NEW PASSWORD</h5>
      </div>
      <div class="input-container mb-3">
        <i class='ri ri-lock-2-line'></i>
        <input type="password" id="password" name="password" placeholder="Enter password">
      </div>
      <div class="input-container mb-3">
        <i class="ri ri-lock-2-line"></i>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-Enter Password">
      </div>
      <div id="error-message" class="text-danger mb-3" style="display: none; font-size:14px;"></div>
      <button type="submit" name="submit" class="btn1 mt-5">SAVE</button></a>
    </form>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>