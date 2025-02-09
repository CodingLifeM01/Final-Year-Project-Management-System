<?php

    require('connection.php');

    if (isset($_POST["comment_submit"])){
        session_start();
        $User_ID = $_SESSION['User_ID'];
        $role = $_SESSION['role'];
    
        $title_id = $_POST['title_id'];
        $comment = $_POST['comment'];

        $sql_upload = "INSERT INTO comments(Content, Written_By, Title_ID) VALUES ('$comment','$User_ID','$title_id ')";
        $result_upload = mysqli_query($conn, $sql_upload);

        if ($result_upload === true){
            if ($role == "Student"){
                header("refresh:0; url=../Folder.php");
            } else{
                header("refresh:0; url=../Search.php");
            }
            
            echo "<script>alert('Comment is successfully uploaded.')</script>";
        } else{
            if ($role == "Student"){
                header("refresh:0; url=../Folder.php");
            } else{
                header("refresh:0; url=../Search.php");
            }
            echo "<script>alert('Comment is failed to upload.')</script>";
        }
    } else {
        header("refresh:0; url=../Folder.php");
    }

?>