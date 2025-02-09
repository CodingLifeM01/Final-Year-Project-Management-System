<?php
    // Destroy session
    session_start();
    unset($_SESSION);
    session_destroy();

    header("refresh:0; url=Login_1.html");
    echo "<script>alert('You have log out the system.')</script>";
?>