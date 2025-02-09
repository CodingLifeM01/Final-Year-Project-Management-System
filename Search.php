<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/search.css">
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
                    <p>Searching Final Year Project Folder</p>
                </div>

                <?php
                // Identify user have click the search button or not
                if (isset($_POST['search'])){
                        $search_name = $_POST['search_name'];
                        $sql = "SELECT DISTINCT folder.Title_ID FROM folder INNER JOIN title ON folder.Title_ID = title.Title_ID WHERE Title_Name LIKE '%$search_name%';";
                    } else{
                        $sql = "SELECT DISTINCT Title_ID FROM folder";
                    }
                ?>

                <div id="search_bar">
                    <form action="Search.php" method="post">
                        <label>Title:</label>
                        <input name="search_name" type="text" value="<?php echo @$search_name; ?>">

                        <button name="search" style="margin-left: 20px;">Search</button>
                    </form>
                </div>

                <div id="main_container">
                    <?php
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) == 0){
                        ?>
                            <div id="empty">
                                <img src="Gallery/Finder_Icon.png" width="300px">
                                <p>No folder was searched in the system.</p>
                            </div>
                        <?php
                        } else {
                            while($row = mysqli_fetch_assoc($result)) {
                                $title_id = $row['Title_ID'];

                                $sql_file_number = "SELECT COUNT(File_No) AS File_Number FROM folder WHERE Title_ID = '$title_id ';";
                                $result_file_number = mysqli_query($conn, $sql_file_number);
                                $row = mysqli_fetch_assoc($result_file_number);

                                $file_number = $row['File_Number'];

                                // Retrieve title name and user id based on title id
                                $sql_title_name = "SELECT Title_Name, Taken_By FROM title WHERE Title_ID = '$title_id'";
                                $result_title_name = mysqli_query($conn, $sql_title_name);
                                $row = mysqli_fetch_assoc($result_title_name);

                                $title_name = $row['Title_Name'];
                                $user_ID = $row['Taken_By'];

                                // Retrieve user name based on user id
                                $sql_user_name = "SELECT User_Name FROM users WHERE User_ID = '$user_ID'";
                                $result_user_name = mysqli_query($conn, $sql_user_name);
                                $row = mysqli_fetch_assoc($result_user_name);

                                $user_name = $row['User_Name'];
                            ?>
                                <div id="file" style="background-color: #E1E9FF;">
                                    <div id="details">
                                        <img src="Gallery/Profile_Navigation.png" width="50px">
                                        <div id="text_details">
                                            <p id="name"><?php echo $user_name; ?></p>
                                        </div>
                                    </div>

                                    <p id="title"><b><?php echo $title_name; ?></b></p>
                                    
                                    <div id="text_details">
                                        <p id="files_number">Number of files: <?php echo $file_number; ?></p>
                                        <form action="Folder_Other.php" method="post">
                                            <input type="hidden" name="titleID" value="<?php echo $title_id; ?>">
                                            <input type="hidden" name="titleName" value="<?php echo $title_name; ?>">
                                            <input type="hidden" name="userID" value="<?php echo $user_ID; ?>">
                                            <input type="hidden" name="userName" value="<?php echo $user_name; ?>">
                                            <button id="view_btn">Click To View -></button>
                                        </form>
                                    </div>
                                </div>                       
                            <?php
                            }
                        }

                    ?>
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