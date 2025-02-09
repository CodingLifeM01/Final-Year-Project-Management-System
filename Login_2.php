<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="css/login_2.css">
    </head>

    <body>
        <div id="Logo">
            <img src="Gallery/NU_Logo.png" alt="" width="200px">
        </div>

        <main>
            <header>
                <h1>
                    You select your role as <?php echo @$_POST['role']; ?>.
                </h1>

                <h1>
                    Please enter your account ID and password to login:
                </h1>
            </header>

            <form id="login_2" action="src/login.php" method="post">
                <div id="form_input">
                    <label>Account ID:</label>
                    <input name="accID" type="text">
                </div>

                <hr>
                
                <div id="form_input">
                    <label>Password:</label>
                    <input name="pass" type="password">
                </div>

                <br>

                <div id="btn">
                    <button style="background-color: rgb(255, 128, 128);" formaction="Login_1.html">Back To Select Role</button>
                    <button style="background-color: rgb(120, 208, 255);">Login</button>
                </div>
                
            </form>
        </main>
    </body>
</html>