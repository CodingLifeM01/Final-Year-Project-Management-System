<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Approvement Page</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/approvement.css">
    </head>
    <?php 
        require('src/connection.php');

        // Take user id from session
        session_start();
        $User_ID = $_SESSION['User_ID'];
        $role = $_SESSION['role'];

        if ($role != "Coordinator"){
            header("refresh:0; url=/Profile.php");
            echo "<script>alert('You are not a coordinator. You are denied to access this page')</script>";
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
                    <p>Approvement for Student's Project Title Registration</p>
                </div>

                <div>
                    <form action="src/approvement.php" method="post">                    
                        <?php 
                            $sql = "SELECT approvement.Title_ID, title.Title_Name, approvement.User_ID, users.User_Name, approvement.Supervisor_ID FROM ((users INNER JOIN approvement ON users.User_ID = approvement.User_ID) INNER JOIN title ON title.Title_ID = approvement.Title_ID)"; 
                            $result = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($result) > 0) {
                                $no = 1;
                    
                                while($row = mysqli_fetch_assoc($result)) {
                                    $title_id = $row['Title_ID'];
                                    $title_name = $row['Title_Name'];
                                    $supervisor_id = $row['Supervisor_ID'];
                                    $user_id = $row['User_ID'];
                                    $user_name= $row['User_Name'];

                                    // Retrieve supervisor name
                                    $sql_supervisor = "SELECT User_Name FROM users WHERE User_ID = '$supervisor_id'";
                                    $result_supervisor = mysqli_query($conn, $sql_supervisor);
                                    $row = mysqli_fetch_assoc($result_supervisor);
                                    $supervisor_name = $row['User_Name'];
                                    
                                    echo "
                                        <fieldset>
                                            <legend><b>Project Title Registration Request No. $no</b></legend>

                                            <label>Final Year Project Title:</label>
                                            <input name=titleid type=hidden value=$title_id>
                                            <p>$title_id. $title_name</p>

                                            <br><hr><br>

                                            <label>Supervisor:</label>
                                            <input name=supervisorid type=hidden value=$supervisor_id>
                                            <p>$supervisor_id. $supervisor_name</p>

                                            <br><hr><br>

                                            <label>Register By:</label>
                                            <input name=userid type=hidden value=$user_id>
                                            <p>$user_id. $user_name</p>

                                            <div id='btn'>
                                                <button name='approve' id='approve'>Approve</button>
                                                <button name='refuse' id='refuse'>Refuse</button>
                                            </div> 
                                        </fieldset>
                                    ";

                                    $no++;
                                }
                        ?>
                    </form>
                        <?php
                            } else {
                                echo "
                                    <div id='empty'>
                                        <img src='Gallery/Finder_Icon.png' width='300px'>
                                        <p>There is no registration request was searched in the system.</p>
                                    </div>
                                ";
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