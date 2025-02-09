<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modify Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/modify.css">

        <script>
			function DeleteConfirm(){
			let warning = "Are you sure you want to delete this file?\nThis may cause the file to be permanently lost!";
			if (!confirm(warning)) {
				return false;
			}
			}
		</script>

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
                    <p>Modifying Final Year Project Files</p>
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
                <?php 
                    $sql_titleid = "SELECT Title_ID FROM title WHERE Taken_By = '$User_ID';";
                    $result_titleid = mysqli_query($conn, $sql_titleid);
                    $row = mysqli_fetch_assoc($result_titleid);
                
                    $title_id = $row['Title_ID'];
                ?>
                </div>
                <?php
                    // If folder exist, print out the all the files
                    $sql_file = "SELECT File_No, File_Name, File_Description FROM folder WHERE Title_ID = '$title_id';";
                    $result_file = mysqli_query($conn, $sql_file);

                    if(mysqli_num_rows($result_file) > 0){

                        echo "
                        <table>
                            <tr>
                                <th>File No</th>
                                <th>File</th>
                                <th>Description</th>
                                <th colspan='2'>Function Button</th>
                            </tr>
                        ";
                    ?>
                <form method=post action=src/update.php>
                    <?php
                        $no = 1;

                        while($row = mysqli_fetch_assoc($result_file)) {
                            $file_no = $row['File_No'];
                            $file_name = $row['File_Name'];
                            $file_description = $row['File_Description'];
                        ?>
                            <tr>
                                <td><?php echo $no?></td>
                                <input type=hidden name="file_no[]" value="<?php echo $file_no ?>"></td> <!-- For modify -->
                                <input type=hidden name="file_number" value="<?php echo $file_no ?>"></td> <!-- For delete -->
                                <td><input type=text name="file_name[]" value="<?php echo $file_name ?>"></td>
                                <td><input type=text name="file_desc[]" value="<?php echo $file_description ?>"></td>
                                <td><button onclick="return DeleteConfirm()" id="delete" name="delete">Delete</button></td>
                                <td><button id="save" name="save">Save</button></td>
                            </tr>
                        <?php
                            $no++;
                        }
                    }
                ?>
                    </table>
                    
                </form>
            </div>
            <footer>
                <p>Made by Colson Lau</p>
                <p>Only Used For Demonstration</p>
            </footer>
        </main>
    </body>
</html>