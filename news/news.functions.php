<?php 
    session_start();

    require "settings.php";

    function display_side($side_index){
        global $db_host, $db_username, $db_pw, $db_name, $max_articles_per_side;

        $database = mysqli_connect($db_host, $db_username, $db_pw, $db_name);

        $article_count_query = "SELECT COUNT(*) FROM news";

        $result = mysqli_query($database, $article_count_query);
        $result = mysqli_fetch_row($result);

        $article_count = $result[0];

        $side_count = floor($article_count/ $max_articles_per_side);

        if($article_count % $max_articles_per_side > 0){
            $side_count++;
        }

        $last_article_index = $article_count - ($side_index - 1) * $max_articles_per_side;
        $first_article_index = $last_article_index - $max_articles_per_side + 1;

        if($first_article_index < 1){
            $first_article_index = 1;
        }

        $articles_query = "SELECT * FROM news WHERE id BETWEEN " . strval($first_article_index) . " AND " . strval($last_article_index);

        $result = mysqli_query($database, $articles_query);

        $n = 0;
        while($row = mysqli_fetch_row($result)){
            $article_data[$n] = $row;
            $n++;
        }

        for($n = count($article_data) - 1; $n > -1; $n--){
            echo construct_article($article_data[$n], "list");
        }

        echo construct_navigation_bar($side_index, $side_count);

        if(array_key_exists("admin_login_status", $_SESSION) && $_SESSION["admin_login_status"]){
            echo "<a href='index.php?go=news_editor&id=new' id='new_link'>Neuen Artikel hinzufügen</a>";
        }

        mysqli_close($database);
    }

    function display_article($id){
        global $db_host, $db_username, $db_pw, $db_name;

        $database = mysqli_connect($db_host, $db_username, $db_pw, $db_name);

        $article_data_query = "SELECT * FROM news WHERE id = " . strval($id);

        $result = mysqli_query($database, $article_data_query);

        $article_data = mysqli_fetch_row($result);

        echo construct_article($article_data, "single"); 
        echo "<a href='index.php?go=news' id='single_article_back_link'>&laquo Zurück zu den News </a>";

        if(array_key_exists("admin_login_status", $_SESSION) && $_SESSION["admin_login_status"]){
            $edit_link = "<a href='index.php?go=news_editor&id=" . strval($id) . "' id='edit_link'>Bearbeiten</a>";
            echo $edit_link;
        }

        mysqli_close($database);
    }

    function construct_article($data, $view_mode){
        global $article_template;

        $article = $article_template;

        if(strcmp($view_mode, "single") == 0){
            $article = str_replace("<a href='index.php?go=news&id=#0' class='single_view_link'>Einzelansicht &raquo</a>","",$article);
        }

        for($n = 0; $n < count($data); $n++){
            $search_val = "#" . strval($n);
            $article = str_replace($search_val, strval($data[$n]), $article);
        }

        return $article;
    }    

    function construct_navigation_bar($side_index, $side_count){

        global $max_direct_navigation_links, $target_side;

        $navigation_bar_container = "<div id='navigation_bar_container'>Seiten: #</div>";
        $all_back_link = "<a class='navigation_link' href='". $target_side ."?go=news&side=§'>&laquo;</a>";
        $one_back_link = "<a class='navigation_link' href='". $target_side ."?go=news&side=§'>&lsaquo;</a>";
        $direct_link = "<a class='navigation_link' href='". $target_side ."?go=news&side=§'?side=§'>#</a>";
        $one_ahead_link = "<a class='navigation_link' href='". $target_side ."?go=news&side=§'?side=§'>&rsaquo;</a>";
        $all_ahead_link = "<a class='navigation_link' href='". $target_side ."?go=news&side=§'?side=§'>&raquo;</a>";
        $navigation_bar_content = "";


        if($side_index > 2){

            $all_back_link = str_replace("§", "1", $all_back_link);
            $navigation_bar_content = $navigation_bar_content . $all_back_link;
        }

        if($side_index > 1){

            $one_back_link = str_replace("§", strval($side_index - 1), $one_back_link);
            $navigation_bar_content = $navigation_bar_content . $one_back_link;
        }

        $direct_back_links_count = 0;
        for($n = 1; $n <= $max_direct_navigation_links && $side_index - $n > 0; $n++){

            $direct_back_links[$n] = str_replace("#", strval($side_index - $n), str_replace("§", strval($side_index - $n), $direct_link));
            $direct_back_links_count++;
        }

        for($n = $direct_back_links_count; $n > 0; $n--){
            $navigation_bar_content = $navigation_bar_content . $direct_back_links[$n];
        }

        $navigation_bar_content = $navigation_bar_content . strval($side_index);

        for($n = 1; ($n <= $max_direct_navigation_links && $side_index + $n <= $side_count); $n++){

            $navigation_bar_content = $navigation_bar_content . str_replace("#", strval($side_index + $n), str_replace("§", strval($side_index + $n), $direct_link));
        }

        if($side_index <= $side_count - 1){

            $one_ahead_link = str_replace("§", strval($side_index + 1), $one_ahead_link);
            $navigation_bar_content = $navigation_bar_content . $one_ahead_link;
        }

        if($side_index <= $side_count - 2){

            $all_ahead_link = str_replace("§", strval($side_count), $all_ahead_link);
            $navigation_bar_content = $navigation_bar_content . $all_ahead_link;
        }

        $navigation_bar_container = str_replace("#", $navigation_bar_content, $navigation_bar_container);

        return $navigation_bar_container;
    }

    
?>