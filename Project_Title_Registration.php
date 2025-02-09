<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project Title Registration Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/registration.css">
    </head>

    <?php 
        require('src/connection.php');

        // Take user id from session
        session_start();
        $User_ID = $_SESSION['User_ID'];
        $role = $_SESSION['role'];
    ?>

    <body>
        <nav>
            <ul>
                <a href="#"><li><img src="Gallery/Main_Navigation.png" style="margin-left: 10px;" width="30px" ></li></a>
                <a href="Profile.php"><li><img src="Gallery/Profile_Navigation.png" width="50px"></li></a>
                <?php
                if($role == "Coordinator"){
                ?>
                    <a href="Approvement.php"><li><img src="Gallery/Approvement_Icon.png" style="margin: -10px 0px 0px -7px;" width="60px"></li></a>
                <?php
                }
                ?>
                <a href="Search.php"><li><img src="Gallery/Search_Navigation.png" style="margin-top: -10px;" width="50px"></li></a>
                <?php
                    $sql_check = "SELECT * FROM title WHERE Taken_By = '$User_ID'";
                    $result_check = mysqli_query($conn, $sql_check);
                    
                if($role == "Student"){
                    if(mysqli_fetch_assoc($result_check) == 0){
                ?>
                <a href="Project_Title_Registration.php"><li><img src="Gallery/Register_Icon.png"style="margin: -5px 0px 5px 7px; width: 38px;" ></li></a>
                <?php
                    } else {
                ?>
                <a href="Folder.php"><li><img src="Gallery/Folder_Navigation.png" style="margin: -10px 0px 0px 3px; width: 45px; "></li></a>
                <?php
                    }
                }
                ?>
                <a href="Notification.php"><li><img src="Gallery/Bell_Icon.png" style="margin-top: -5px; width: 50px;"></li></a>
                <a href="Logout.php"><li><img src="Gallery/LogOut_Icon.png" style="margin-top: -5px; margin-left: -4px; width: 55px;"></li></a>
            </ul>
        </nav>

        <main>
            <header>
                <h2>Final Year Project Manegament System</h2>
            </header>

            <div id="content">
                <div id="small_header">
                    <div id="block"></div>
                    <div id="block_2"></div>
                    <p>Final Year Project Title Registration</p>
                </div>

                <div>
                    <?php
                        $sql_check_registration = "SELECT * FROM approvement WHERE User_ID = '$User_ID';";
                        $result_check_registration = mysqli_query($conn, $sql_check_registration);

                        if (mysqli_num_rows($result_check_registration) != 0) {
                    ?>
                    <div id="empty">
                        <img src="Gallery/Loding_Icon.png" width="300px">
                        <p>Your project name registration request is pending.<br>Please wait for the approvement from coordinator.</p>
                    </div>
                    <?php
                        } else {
                    ?>

                    <form action="src/title_register.php" method="post">
                        <fieldset>
                            <legend><b>Registration Form</b></legend>
                        
                            <label>Final Year Project Title:</label><br>
                            <select name="fyptitle" id="fyptitle">
                                <?php
                                    $sql_title = "SELECT Title_ID, Title_Name FROM title WHERE Title_Taken = 'N'"; 
                                    $result_title = mysqli_query($conn, $sql_title);

                                    if (mysqli_num_rows($result_title) > 0) {
                                        while($row = mysqli_fetch_assoc($result_title)) {
                                            $title_id = $row['Title_ID'];
                                            $title_name= $row['Title_Name'];

                                            echo "
                                                <option value='$title_id'>$title_id. $title_name</option>
                                            ";
                                        }
                                    }
                                ?>
                            </select>

                            <br><hr><br>

                            <label>Supervisor:</label><br>
                            <select name="supervisor" id="supervisor">
                            <?php 
                                $sql_supervisor = "SELECT User_ID, User_Name FROM users WHERE Role = 'Supervisor';"; 
                                $result_supervisor = mysqli_query($conn, $sql_supervisor);
                                
                                if (mysqli_num_rows($result_supervisor) > 0) {
                                    while($row = mysqli_fetch_assoc($result_supervisor)) {
                                        $supervisor_id = $row['User_ID'];
                                        $supervisor_name= $row['User_Name'];

                                        echo "
                                            <option value='$supervisor_id'>$supervisor_id. $supervisor_name</option>
                                        ";
                                    }
                                }
                            ?>
                            </select>

                            <br>

                            <div id="register_btn">
                                <button>Register!</button>
                            </div>
                        </fieldset>
                    </form>
                    <?php
                        }
                    ?>
                </div>
            </div>

            <footer>
                <p>Made by Colson Lau</p>
                <p>Only Used For Demonstration</p>
            </footer>
        </main>
    </body>
</html>