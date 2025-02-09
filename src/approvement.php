<?php
    require('connection.php');

    session_start();
    $role = $_SESSION['role'];

    // Identify the user is coordinator or not
    if ($role == "Coordinator"){

        $title_id = $_POST['titleid'];
        $supervisor_id = $_POST['supervisorid'];
        $user_id = $_POST['userid'];

        if (isset($_POST['approve'])){    
            $sql = "UPDATE title SET Title_Taken ='Y',Taken_By= '$user_id' WHERE Title_ID = '$title_id';";
            $result = mysqli_query($conn, $sql);
            
            $sql_supervisor = "UPDATE users SET Supervisor_ID ='$supervisor_id' WHERE User_ID = '$user_id';";
            $result_supervisor = mysqli_query($conn, $sql_supervisor);

            $sql_delete = "DELETE FROM approvement WHERE Title_ID = '$title_id' AND User_ID = '$user_id' AND Supervisor_ID = '$supervisor_id'";
            $result_delete = mysqli_query($conn, $sql_delete);

            if ($result === true && $result_supervisor === true && $result_delete === true){
                header("refresh:0; url=../Approvement.php");
                echo "<script>alert('The registration request has been sucessfully approved.')</script>";
            } else{
                header("refresh:0; url=../Approvement.php");
                echo "<script>alert('The registration request has been failed to approved.')</script>";
            }
        } else {
            $sql_delete = "DELETE FROM approvement WHERE Title_ID = '$title_id' AND User_ID = '$user_id' AND Supervisor_ID = '$supervisor_id'";
            $result_delete = mysqli_query($conn, $sql_delete);
    
            if ($result_delete === true){
                header("refresh:0; url=../Approvement.php");
                echo "<script>alert('You have reject a registration request.')</script>";
            } else{
                header("refresh:0; url=../Approvement.php");
                echo "<script>alert('You have failed to reject a registration request.')</script>";
            }
        }
    } else{
        header("refresh:0; url=../Profile.php");
        echo "<script>alert('You are not a coordinator. You are denied to access this page')</script>";
    }

?>