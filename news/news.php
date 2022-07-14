<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="news\\newsStyle.css">
    </head>
    <body>
        <?php require "news.functions.php";
            if(key_exists("side", $_GET)){
                display_side($_GET["side"]);
            }
            elseif(key_exists("id", $_GET)){
                display_article($_GET["id"]);
            }
            else{
                display_side(1);
            }
        ?>
    </body>
</html>