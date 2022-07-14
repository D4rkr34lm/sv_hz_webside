<?php
    #database
    $db_host = "localhost";
    $db_username = "root";
    $db_pw = "manu12";
    $db_name = "sv_hz";

    #side display
    $max_articles_per_side = 10;
    $article_template = "
    <article class='article_container'>
        <h3 class='article_header'>#1</h3>
        <div class='article_content'>#2</div>
        <p class='article_metadata'>Geschrieben von <a href='mailto:#4'>#3</a> am #5 um #6 <a href='index.php?go=news&id=#0' class='single_view_link'>Einzelansicht &raquo</a></p>
    </article>"; 
    $max_direct_navigation_links = 3; 
    $target_side = "index.php";
    
    #navigation
    $sub_side_paths = array(
        "news" => "news\\news.php",
        "news_editor" => "newsEditor\\newsEditor.php",
        "admin_login" => "adminLogin\\adminLogin.php",
        "start" => "start\\start.html"
    );
?>