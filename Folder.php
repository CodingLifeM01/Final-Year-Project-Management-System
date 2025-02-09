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

        // Take user id from session
        session_start();
        $User_ID = $_SESSION['User_ID'];
        $role = $_SESSION['role'];

        // Retrieve user name from database based on user id
        $sql = "SELECT User_Name FROM users WHERE User_ID = '$User_ID';";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);
        $user_name = $row['User_Name'];
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

                <?php 
                    $sql_titleid = "SELECT Title_ID FROM title WHERE Taken_By = '$User_ID';";
                    $result_titleid = mysqli_query($conn, $sql_titleid);
                    $row = mysqli_fetch_assoc($result_titleid);
                
                    $title_id = @$row['Title_ID'];

                    // Check the user have folder or not
                    $sql_foldercheck = "SELECT File_No, File_Name, File_Path, File_Description, File_Upload_Date, Title_ID FROM folder WHERE Title_ID = '$title_id';";
                    $result_foldercheck = mysqli_query($conn, $sql_foldercheck);

                    if (mysqli_num_rows($result_foldercheck) == 0){
                ?>
                    <div id="empty_folder">
                        <img src="Gallery/Folder_Navigation.png" width="300px">
                        <p>Seem like you haven't create your folder yet.<br>Click the button below to choose your file and upload!</p>

                        <form action="src/upload.php" method="post" enctype="multipart/form-data">
                            <input id="upload" type="file" name="file" accept=".doc, .docx, .pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*">
                            <button id="upload_btn" name="upload_btn">Upload!</button>
                        </form>
                    </div>
                <?php
                    } else{
                ?>
                <div id="title">
                    <h3>
                        <?php
                            $sql_titlename = "SELECT Title_Name FROM title WHERE Taken_By = '$User_ID'";
                            $result_titlename = mysqli_query($conn, $sql_titlename);

                            $row = mysqli_fetch_assoc($result_titlename);
                            $title_name = $row['Title_Name'];

                            echo $title_name;
                        ?>

                    </h3>
                    <div id="function_btn">
                        <form action="Add.php">
                            <button id="add">
                                <img src="Gallery/Add_Files_Icon.png" width="50px">
                            </button>
                        </form>

                        <form action="Modify.php">
                            <button id="modify"><img src="Gallery/Modify_File_Icon.png" width="44px"></button>
                        </form>
                    </div>
                </div>

                </div>
                <?php
                        // If folder exist, print out the all the files
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

                        if(mysqli_num_rows($result_comment) == 0){

                        } else{

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
                                    <p id="name"><b><?php echo $writer_name ?></b></p>
                                    <p id="comment"><?php echo $content ?></p>
                                </div>
                            </div>
                      <?php      
                        }
                    }
                    ?>
                    </div>

                    <div id="comment_bar">
                        <form action="src/comment.php" method="post">
                            <input type="hidden" name="title_id" value="<?php echo $title_id; ?>;">
                            <input type="text" name="comment" placeholder="Enter Your Text Here...">
                            <button name="comment_submit"><img src="Gallery/Send_Icon.png"></button>
                        </form>
                    </div>
                </div>
                <?php
            }
                ?>
            </div>
            <footer>
                <p>Made by Colson Lau</p>
                <p>Only Used For Demonstration</p>
            </footer>
        </main>
    </body>
</html>