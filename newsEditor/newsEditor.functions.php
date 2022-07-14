<?php
    require "settings.php";

    function loadEditor ($id){
       $title = "";
       $content = "";
       
        if($id != -1){
            global $db_host, $db_username, $db_pw, $db_name;

            $database = mysqli_connect($db_host, $db_username, $db_pw, $db_name);

            $article_data_query = "SELECT * FROM news WHERE id = " . strval($id);

            $result = mysqli_query($database, $article_data_query);

            $article_data = mysqli_fetch_row($result);

            $title = strval($article_data[1]);
            $content = strval($article_data[2]);

            mysqli_close($database);
        }

        echo 
            "<article>
                <h3 id='article_header' contenteditable='true'>" . $title . "</h3>
                <div id='article_content' contenteditable='true'>" . $content . "</div>
            </article>";
    }
?>