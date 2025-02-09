<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Notification Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/notification.css">
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
                    <p>Notification</p>
                </div>

                <div id="notification_container">
                    <div>
                        <div id="notification_header">
                            <img src="Gallery/Bell_Icon.png" width="45px">
                            <p id="name">You have a message from System (2023/12/20) !</p>
                        </div>

                        <div id="notification_content">
                            <p>Your registrarion request has been send to coordinator.</p>
                        </div>
                
                        <br>
                    </div>

                    <br>

                    <div>
                        <div id="notification_header">
                            <img src="Gallery/Bell_Icon.png" width="45px">
                            <p id="name">You have a message from System (2023/12/25) !</p>
                        </div>

                        <div id="notification_content">
                            <p>Your registrarion request has been approved! Upload your first file now!</p>
                        </div>
                
                        <br>
                    </div>

                    <br>

                    <div>
                        <div id="notification_header">
                            <img src="Gallery/Bell_Icon.png" width="45px">
                            <p id="name">You have a message from System (2023/12/31) !</p>
                        </div>

                        <div id="notification_content">
                            <p>Your file (FYP report) has been modify.</p>
                        </div>
                
                        <br>
                    </div>
                </div>
            </div>

            <footer>
                <p>Made by Colson Lau</p>
                <p>Only Used For Demonstration</p>
            </footer>
        </main>
    </body>
</html>