<?php
require_once "config.php";
session_start();
$mail=$_SESSION['mail'];
echo $mail;


?>