<?php
    require('connection.php');

    session_start();
    $User_ID = $_SESSION['User_ID'];

    // Retrieve title id based on user id
    $sql = "SELECT Title_ID FROM title WHERE Taken_By = '$User_ID';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $title_id = $row['Title_ID'];
    
    // Check the user have choose file or not
    if($_FILES["file"]["error"] == 4) {
        header("refresh:0; url=/Folder.php");
        exit ('<script>alert("Please choose a file to upload!")</script>');
    } else {
        // Determine file name based on different webpage
        if (isset($_POST['upload_btn'])){
            $file_name = $_FILES["file"]["name"];
            $file_description = null;

        } else {
            $filetype = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));

            $_FILES["file"]["name"]= $_POST['file_name'];
            $file_name = $_FILES["file"]["name"] . "." . $filetype;

            $file_description = $_POST['file_description'];
        }
        
        // Determine file path
        $target_dir = "upload/";
        $target_file = $target_dir . $file_name;

        // Record the current upload time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $time_stamp = date('Y-m-d');

        // Limit file size
        if($_FILES["file"]["size"] > 10000000){
            // 1000 = 1kb, 10000000 = 10000kb = 10MB
            header("refresh:0; url=/Folder.php");
            exit ('<script>alert("The file size is exceed 5MB!")</script>');
        } else{
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            
            // Upload file to database
            $sql_upload = "INSERT INTO folder(File_Name, File_Path, File_Description, File_Upload_Date, Title_ID) VALUES ('$file_name','$target_file','$file_description','$time_stamp','$title_id')";
            $result_upload = mysqli_query($conn, $sql_upload);

            if ($result_upload === TRUE){
                header("refresh:0; url=/Folder.php");
                echo "<script>alert('File uploaded successful')</script>";
            } else {
                header("refresh:0; url=/Folder.php");
                echo "<script>alert('File uploaded unsuccessful. Please try again.')</script>";
            }
        }
    }
?>