<?php

    require('connection.php');

    session_start();
    $User_ID = $_SESSION['User_ID'];

    $title_id = $_POST['fyptitle'];
    $supervisor_id = $_POST['supervisor'];

    $sql = "INSERT INTO approvement (Title_ID, Supervisor_ID, User_ID) VALUES ('$title_id','$supervisor_id','$User_ID')";
    $result = mysqli_query($conn, $sql);

    if ($result === true){
        header("refresh:0; url=/Project_Title_Registration.php");
        echo "<script>alert('You have successfully register the title! Please wait for the approvement.')</script>";
    } else{
        header("refresh:0; url=/Project_Title_Registration.php");
        echo "<script>alert('You have failed to register the title. Something is going wrong.')</script>";
    }
?>