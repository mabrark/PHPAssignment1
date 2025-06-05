<?php
    session_start();

    $_SESSION = []; 
    session_destroy(); 
    
    $url = "login_form.php";
    header("Location: " . $url);
    die();
?>