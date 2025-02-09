<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modify Profile Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/profile.css">
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
                <?php   
                    // Retrieve all the necessary data from database according to user's role
                    if ($role == "Student"){
                        // Check if the student has taken the title
                        if(mysqli_fetch_assoc($result_check) == 0){
                            $sql = "SELECT users.User_Name, programme.Programme_Name, users.Email, users.Phone, users.Role, users.Birth FROM users INNER JOIN programme ON programme.Programme_ID = users.Programme WHERE User_ID = '$User_ID';";
                        } else{
                            $sql = "SELECT users.User_Name, programme.Programme_Name, users.Email, users.Phone, users.Role, users.Birth, title.Title_Name FROM ((users INNER JOIN programme ON programme.Programme_ID= users.Programme) INNER JOIN title ON title.Taken_By = users.User_ID) WHERE User_ID = '$User_ID';";
                        }
                    } else {
                        $sql = "SELECT User_Name, Email, Phone, Role, Birth FROM users WHERE User_ID = '$User_ID'";
                    }

                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $user_name = @$row['User_Name'];
                    $programme = @$row['Programme_Name'];
                    $email = @$row['Email'] ?? "-";
                    $phone = @$row['Phone'] ?? "-";
                    $role = @$row['Role'];
                    $birth = @$row['Birth'] ?? "-";
                    $title_name = @$row['Title_Name']

                ?>
                <div id="small_header">
                    <div id="block"></div>
                    <div id="block_2"></div>
                    <p>Profile</p>
                </div>

                <div id="profile_container">
                    <div id="profile_content">
                        <div id="profile_header">
                            <div style="display: flex;">
                                <img src="Gallery/Profile_Navigation.png" style="width: 150px; border: 1px solid black;">
                                <div id="profile_detail_1">
                                    <p><?php echo $user_name; ?></p>
                                    <?php 
                                    if($role == "Student"){
                                    ?>
                                    <p><?php echo $programme; ?></p>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            <div>
                                <?php 
                                    if($role == "Student"){
                                ?>
                                    <a href="profile_modify.php"><img src="Gallery/Modify_File_Icon.png" width="40px"></a>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                        
                        <div id="hr"></div>

                        <div id="profile_detail_2">
                            <form action="src/modify.php" method="post">
                                <p>Role</p>
                                <p><?php echo $role; ?></p>

                                <p>Birth</p>
                                <p><?php echo $birth; ?></p>

                                <p>Phone Number</p><br>
                                <input name="phone" value="<?php echo $phone; ?>"><br>

                                <p>Email</p><br>
                                <input name="email" value="<?php echo $email; ?>"><br>

                                <?php 
                                    if($role == "Student" && mysqli_fetch_assoc($result_check) != 0){
                                ?>
                                    <p>Final Year Project Title</p>
                                    <p><?php echo $title_name; ?><br>
                                        <span style="color: rgb(224, 211, 29);" ><b>In progess</b></span>
                                    </p>
                                <?php
                                    }
                                ?>

                                <div id="submit_btn">
                                    <button name="submit_btn">Submit</button>
                                </div>
                            </form>
                        </div>
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