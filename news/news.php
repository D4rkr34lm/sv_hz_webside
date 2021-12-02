<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="news\\newsStyle.css">
    </head>
    <body>
        <h2>Nachrichten</h2>
        <?php include "news.functions.php";
            if(key_exists("side", $_GET)){
                display_side($_GET["side"]);
            }
            else{
                display_side(1);
            }
        ?>
    </body>
</html>