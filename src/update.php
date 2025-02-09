<?php
    require('connection.php');

    if(isset($_POST["save"])){		

        // foreach
        foreach ($_POST['file_no'] as $key => $ori_file_no) {
        $file_no = $ori_file_no;
        $file_name = $_POST['file_name'][$key];
        $file_description = $_POST['file_desc'][$key];
        
        // Update table
        $sqlUpdate = "UPDATE folder SET File_Name='$file_name', File_Description='$file_description' WHERE File_No='$file_no'";
        $resultUpdate = mysqli_query($conn, $sqlUpdate);
        } 
    
        if ($resultUpdate === true){
            header("refresh:0; url=../Folder.php");
            echo "<script>alert('Data is successfully saved.')</script>";
        } else{
            header("refresh:0; url=../Folder.php");
            echo "<script>alert('Data is unsuccessfully saved. Please check your value is valid or not.')</script>";
        }
    
    } elseif(isset($_POST["delete"])) {
        $file_no = $_POST['file_number'];

        $sqlDelete = "DELETE FROM Folder WHERE File_No='$file_no'";
        $resultDelete = mysqli_query($conn, $sqlDelete);

        if ($resultDelete === true){
            header("refresh:0; url=../Folder.php");
            echo "<script>alert('Data is successfully deleted.')</script>";
        } else{
            header("refresh:0; url=../Folder.php");
            echo "<script>alert('Data is unsuccessfully deleted. Something is go wrong.')</script>";
        }
    } else{
        header("refresh:0; url=../Folder.php");
    }

?>
