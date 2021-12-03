<?php 
    session_start();

    require "../settings.php";

    $input_username = htmlspecialchars($_POST["username"]);
    $input_password = htmlspecialchars($_POST["password"]);

    if($input_username == "" || $input_password == ""){
        header("Location: \\index.php?go=admin_login&status=unfinished");
    }

    $database = mysqli_connect($db_host, $db_username, $db_pw, $db_name);

    $login_data_query = "SELECT * FROM admin_accesses";

    $result = mysqli_query($database, $login_data_query);

    while($row = mysqli_fetch_row($result)){
        $login_data[$row[1]] = $row[2];
        $admin_emails[$row[1]] = $row[3];
    }

    if(key_exists($input_username, $login_data) && strcmp($login_data[$input_username], $input_password) == 0){
        $_SESSION["admin_login_status"] = true;
        $_SESSION["admin_name"] = $input_username;
        $_SESSION["admin_email"] = $admin_emails[$input_username];
        header("Location: \\index.php");
    }
    else{
        header("Location: \\index.php?go=admin_login&status=wrong");
    }

    mysqli_close($database);

?>