<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Folder Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/folder.css">
    </head>

    <?php 
        require('src/connection.php');

        // Take current user id from session
        session_start();
        $User_ID = $_SESSION['User_ID'];
        $role = $_SESSION['role'];

        $title_id = $_POST['titleID'];
        $title_name = $_POST['titleName'];
        $owner_id = $_POST['userID']; // Folder owner id
        $user_name = $_POST['userName'];

        // If the user is the folder owner, link to his own folder
        if($User_ID == $owner_id){
            header("refresh:0; url=Folder.php");
        }
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
                    <p>Final Year Project Folder</p>
                </div>

                <div id="document_detail_1">
                    <img src="Gallery/Profile_Navigation.png" width="80px">
                    <div id="document_text_details">
                        <p id="name"><b><?php echo $user_name; ?>'s Final Year Project Folder</b></p>
                    </div>
                </div>

                <div id="hr"></div>
                
                    <div id="title">
                        <h3>
                            <?php
                                echo $title_name;
                            ?>

                        </h3>
                    </div>

                <?php
                    $sql_file = "SELECT File_Name, File_Path, File_Description, File_Upload_Date FROM folder WHERE Title_ID = '$title_id';";
                    $result_file = mysqli_query($conn, $sql_file);

                    if(mysqli_num_rows($result_file) > 0){

                        echo "
                        <table>
                            <tr>
                                <th>File No</th>
                                <th>File</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        ";

                        $no = 1;

                        while($row = mysqli_fetch_assoc($result_file)) {
                            $file_name = $row['File_Name'];
                            $file_path = $row['File_Path'];
                            $file_description = $row['File_Description'];
                            $file_date = $row['File_Upload_Date'];

                            echo "
                            <tr>
                                <td>$no</td>
                                <td><a href='src/$file_path' download>$file_name</a></td>
                                <td>$file_description</td>
                                <td>$file_date</td>
                            </tr>
                            ";

                            $no++;
                        }                    
                    }
                ?>
                    </table>
            </div>

            <div id="comment_container">
                <div id="comment_header">
                    <img src="Gallery/Comment_Icon.png" width="40px">
                    <h3>Comment:</h3>
                </div>

                <div id="comment_content">
                    <div id="user_comment">
                    <?php
                        $sql_comment = "SELECT Content, Written_By FROM comments WHERE Title_ID = '$title_id'";
                        $result_comment = mysqli_query($conn, $sql_comment);

                        if(mysqli_num_rows($result_comment) != 0){
                        
                        while($row = mysqli_fetch_assoc($result_comment)) {
                            $content = $row['Content'];
                            $writer = $row['Written_By']; // Retrieve user id as writer

                            // Retrieve writer name based on user id
                            $sql_writer = "SELECT User_Name FROM users WHERE User_ID = '$writer'";
                            $result_writer = mysqli_query($conn, $sql_writer);
                            $row = mysqli_fetch_assoc($result_writer);

                            $writer_name = $row['User_Name'];
                        ?>
                            <div id="user">
                                <img src="Gallery/Profile_Navigation.png" width="80px">
                                <div>
                                    <p id="name"><b><?php echo $writer_name; ?></b></p>
                                    <p id="comment"><?php echo $content; ?></p>
                                </div>
                            </div>
                      <?php      
                            }
                        }
                            $sql_check_super = "SELECT * FROM users WHERE Supervisor_ID = '$User_ID' AND User_ID = '$owner_id';";
                            $result_check_super = mysqli_query($conn, $sql_check_super);

                            if (mysqli_num_rows($result_check_super) != 0) {
                    ?>
                            <div id="comment_bar">
                                <form action="src/comment.php" method="post">
                                    <input type="hidden" name="title_id" value="<?php echo $title_id; ?>;">
                                    <input type="text" name="comment" placeholder="Enter Your Text Here...">
                                    <button name="comment_submit"><img src="Gallery/Send_Icon.png"></button>
                                </form>
                            </div>
                    <?php
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