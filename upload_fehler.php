<?php
session_start();
 if (0> version_compare(PHP_VERSION, '7')) {
    die('<h1>Für diese Anwendung ' .
    'ISt mindesten PHP 7 notwendig</h1>');	
 }

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <title>Image2Foos - 
            Sag mir, was ich daraus kochen kann - Upload </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="lib/css/stil.css" rel="stylesheet">
    </head>
    <body>
    <div id="nav">
        <?php
        @include("navmitglieder.php");
        ?>
        </div>
        <div id="content">
            <h1>Registrierungsfehler</h1>
            <?php
            class UpFehler
            {
                public function fehler()
                {
                        echo "<h4>Der Upload und die Registrierung der Datei ".
                        " im System hat eider nicht funktioniert.</h4>".
                        "<h5>Versuchen Sie es bitte erneut.</h5>";
                }
            }
            $obj= new UpFehler();
            $obj->fehler();
            ?>
            <hr><a href='index.php'>Zur Homepage</a>
        </div>       
    </body>
</html>