<?php
    $conn = mysqli_connect("localhost","root","","fyp");

    if (!$conn) {
        echo "Failed to connect to MySQL: " . mysqli_connect_errno();
        exit();
    }
?>