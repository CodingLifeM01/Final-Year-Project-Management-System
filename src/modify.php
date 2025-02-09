<?php
    require('connection.php');

    if(isset($_POST["submit_btn"])){

        session_start();
        $user_id = $_SESSION['User_ID'];

        $phone = $_POST['phone'];
        $email = $_POST['email'];

        // Update the profile details
        $sqlModify = "UPDATE users SET Phone='$phone', Email='$email' WHERE User_ID='$user_id'";
        $resultModify = mysqli_query($conn, $sqlModify);

        if ($resultModify === true){
            header("refresh:0; url=/Profile.php");
            echo "<script>alert('Data was successfully updated.')</script>";
        } else{
            header("refresh:0; url=/Folder.php");
            echo "<script>alert('Data was updated failed. Please check your value is valid or not.')</script>";
        }
    } else{
        header("refresh:0; url=/Profile.php");
    }

?>