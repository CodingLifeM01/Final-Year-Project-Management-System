<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Folder Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/add.css">
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
                    <p>Uploading New Files In Folder</p>
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
                            $sql_titlename = "SELECT Title_Name FROM title WHERE Taken_By = '$User_ID'";
                            $result_titlename = mysqli_query($conn, $sql_titlename);

                            $row = mysqli_fetch_assoc($result_titlename);
                            $title_name = $row['Title_Name'];

                            echo $title_name;
                        ?>

                    </h3>
                    <div id="function_btn">
                        <form action="Add.php">
                            <button id="add" name="add">
                                <img src="Gallery/Add_Files_Icon.png" width="50px">
                            </button>
                        </form>

                        <form action="Modify.php">
                            <button id="modify"><img src="Gallery/Modify_File_Icon.png" width="44px"></button>
                        </form>
                    </div>
                </div>

                <div id="Add_Form">
                    <form action="src/upload.php" method="post" enctype="multipart/form-data">
                        <label>File Name:</label><br>
                        <input type="text" name="file_name"><br>
                        
                        <label>File Select:</label><br>
                        <input id="upload" type="file" name="file" accept=".doc, .docx, .pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, image/*"><br>

                        <label>File Description:</label><br>
                        <textarea name="file_description" cols="20" rows="5"></textarea><br>

                        <div>
                            <button id="upload_btn" name="upload">Upload!</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <footer>
                <p>Made by Colson Lau</p>
                <p>Only Used For Demonstration</p>
            </footer>
        </main>
    </body>
</html>