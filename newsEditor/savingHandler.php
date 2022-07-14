<?php
    session_start();
    require "..\\settings.php";

    global $db_host, $db_username, $db_pw, $db_name;

    $database = mysqli_connect($db_host, $db_username, $db_pw, $db_name);

    $id = $_POST["ID"];
    $title = $_POST["Title"];
    $content = $_POST["Content"];

    if($id == -1){
        $values = array();

        $article_count_query = "SELECT COUNT(*) FROM news";

        $result = mysqli_query($database, $article_count_query);
        $result = mysqli_fetch_row($result);

        $article_count = $result[0];

        $values[0] = $article_count + 1;
        $values[1] = $title;
        $values[2] = $content;
        $values[3] = $_SESSION["admin_name"];
        $values[4] = $_SESSION["admin_email"];
        $values[5] = strval(date("d.m.y"));
        $values[6] = strval(date("G:i:s"));

        for($n = 1; $n < 7; $n++){
            $values[$n] = "'" . $values[$n] . "'";
        }

        $query = "INSERT INTO news VALUES (" . $values[0];

        for($n = 1; $n < 7; $n++){
            $query = $query . ", " . $values[$n];
        }

        $query = $query . ")";

        $myfile = fopen("debug", "w") or die("Unable to open file!");
        fwrite($myfile, $query);
        fclose($myfile);
    }else{
        $query = "UPDATE news SET header='" . $title . "', content='" . $content . "' WHERE id=" . $id;
    }

    mysqli_query($database, $query);

    mysqli_close($database);
?>