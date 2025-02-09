<?php
    require ('connection.php');

    // Get user account id and password
    $accID = $_POST['accID'];
    $pass= $_POST['pass'];
    
    // Retreive user with account id and password from previous webpage
    $sql = "SELECT `Account_ID`, `Password` FROM `account` WHERE Account_ID = '$accID' && Password = '$pass'";
    $result = mysqli_query($conn, $sql);

    // Check user is exist or not
    if(mysqli_num_rows($result) == 0){
        header("refresh:0; url=../Login_2.php");
		echo "<script>alert('Your Account ID or Password is incorrect. Please enter again.')</script>";
    } else{
        header("refresh:0; url=../Profile.php");
        echo "<script>alert('You have successfully login!')</script>";
    }

    // Store user id and role after successful login
    session_start();
    
    $sql_userID = "SELECT User_ID, Role FROM users, account WHERE account.Account_ID = users.Account_ID && users.Account_ID = '$accID';";
    $result_userID = mysqli_query($conn, $sql_userID);

    if (mysqli_num_rows($result_userID) > 0) {
        while($row = mysqli_fetch_assoc($result_userID)) {
            $User_ID = $row['User_ID'];
            $role = $row['Role'];
        }

        $_SESSION['User_ID'] = $User_ID;
        $_SESSION['role'] = $role;
    }

?>