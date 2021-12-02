<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div id="main_content">
            <?php require "settings.php";
                if(!key_exists("go", $_GET)){
                    include "start\\start.html";
                }
                else{
                    if(!key_exists($_GET["go"], $sub_side_paths)){
                        include "start\\start.html";
                    }
                    else{
                        include $sub_side_paths[$_GET["go"]];
                    }
                }
            ?>
        </div>
    </body>
</html>