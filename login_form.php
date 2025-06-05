<!DOCTYPE html>
<html>
    <head>
        <title>Library - Login</title>
        <link rel="stylesheet" type="text/css" href="css/main.css" />
    </head>
    <body>
        <?php include("header.php"); ?>

        <main>
            <h2>Login</h2>

            <form action="login.php" method="post" id="login_form">

                <div id="data">

                    <label for="user_name">Username:</label>
                    <input type="text" id="user_name" name="user_name" required /><br />

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required /><br />                    

                </div>

                <div id="buttons">

                    <label>&nbsp;</label>
                    <input type="submit" value="Login" /><br />

                </div>

            </form>

            <p><a href="register_book_form.php">Register</a></p>
            
        </main>

        <?php include("footer.php"); ?>
    </body>
</html>