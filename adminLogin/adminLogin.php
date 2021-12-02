<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="adminLogin\\adminLoginStyle.css">
    </head>
    <body>
        <?php
            if(key_exists("admin_login_status", $_SESSION) && $_SESSION["admin_login_status"] = true){
                header("Location: index.php");
            }
        ?>

        <h2>Admin Login</h2>
        <form action="adminLogin\\loginHandler.php" method="post">
            <?php
                if(key_exists("status",$_GET)){
                    if($_GET["status"] == "unfinished"){
                        echo "<p id='error_message'>Bitte trage Nutzername und Password ein</p>";
                    }
                    elseif($_GET["status"] == "wrong"){
                        echo "<p id='error_message'>Diese Kommbination, aus Nutzername und Password existiert nicht</p>";
                    }
                }
            ?>
            <label for="username">Nutzername</label>
            <input name="username" type="text">
            <br>
            <label for="password">Password</label>
            <input name="password" type="password">
            <br>
            <input type="submit" value="Log in">
        </form>
    </body>
</html>