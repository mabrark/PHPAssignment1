<?php
session_start();
$_SESSION["isLoggedIn"] = true;
$_SESSION["isGuest"] = true;
$_SESSION["userName"] = "Guest";
header("Location: index.php");
exit();
?>