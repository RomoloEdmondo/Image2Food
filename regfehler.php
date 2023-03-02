<?php
    session_start();
    if (0 > version_compare(PHP_VERSION, '7')) {
        die('<h1>Für diese Anwendung ' . 'ist mindestens PHP 7 notwendig</h1>');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fehler</title>
</head>
<body>
    <div id="nav">
    <?php
        @include("nav.php");
    ?>
    </div>
    <div id="content">

        <h1>Registrierungsfehler</h1>
        <?php
            @include("registrieren.inc.php");
            class Regfehler {
                public function fehler()
                {
                echo "<h4> Die Registrierung hat leider" . " nicht funktioniert,</h4>" .
                "<h5>Wählen Sie eine andere Userid und " . "versuchen Sie es erneut.</h5>";
                }
            }
            $regobj= new RegFehler();
            $regobj->fehler();
        ?>
    </div>
    
</body>
</html>