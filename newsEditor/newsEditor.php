<!DOCTYPE html>
<html>
    <head>   
        <link rel="stylesheet" href="newsEditor\\newsEditorStyle.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="newsEditor\\newsEditor.functions.js"></script>
    </head>
    <body>
        <?php
            require "newsEditor.functions.php";

            if(strcmp($_GET["id"], "new") == 0) {
                echo "<h2>Artikel erstellen</h2>";
                loadEditor(-1);
            }
            else{
                echo "<h2>Artikel bearbeiten</h2>" ;  
                loadEditor($_GET["id"]);
            }
        ?>
        <button type="button" onclick="saveArticle()">Speichern</button>
        
    </body>
</html>