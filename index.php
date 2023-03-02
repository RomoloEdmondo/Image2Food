<?php
//Start der Sitzung
session_start();

//setcookie "Image2Food" wert=timestamp der Gültigkeitdauer ist 120 Tage.
setcookie("Image2Food", time(), time() + 60 * 60 * 24 * 120, "/");

/**Festlegung der Untergranze für die PHP-version 
    @version: 1.0
 */
if (0 > version_compare(PHP_VERSION, '7')) {  /*The die() or exit() function prints a message and terminates the current script.*/
    die('<h1>Für diese Anwendung ' .
        'Ist mindesten PHP 7 notwending</h1>');
}
class MeineAusnahme extends Exception
{
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <link rel="stylesheet" href="lib/css/stil.css">
    <meta charset="UTF-8">
    <title>Image2Food - Sag mir was ich
        daraus kochen kann - Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="nav">

        <?php
        try {
            if (isset($_SESSION['login']) && ($_SESSION['login'] == "true")) {

                if (!@include("navmitglieder.php")) {
                    throw new MeineAusnahme('Leider gibt es ein Problem mit der Webseite. 
                        Wir arbeiten daran mit Hochdruck. 
                        Besuchen Sie uns in Kürze wieder neu');
                }
            } else {
                if (!@include("nav.php")) {
                    throw new MeineAusnahme('Leider gibt es ein Problem mit der Webseite. 
                        Wir arbeiten daran mit Hochdruck. 
                        Besuchen Sie uns in Kürze wieder neu');
                }
            }
        } catch (MeineAusnahme $e) {
            die($e->getMessage());
        }
        ?>
    </div>
    <div id="content">
        <h1>Image2Food - Sag mir was ich daraus kochen kann</h1>
        <h2>Das soziale, multimediale Netwerk für Kochideen!</h2>
        <?php
        /**
         * Das soziale Netzerk für kochideen
         * Die Einstiegsseite mit der Hauptlasse
         */
        class Index
        {
            function besucher()
            {

                if (isset($_SESSION["login"]) && $_SESSION["login"] == "true") {
                    echo
                    "<div id='indextext'> <strong> Mitgliederbereich </strong>" .
                        "<br><br>" .
                        "Sie sind angemeldet</div>";
                        @include("uploadformular.inc.php");
                    @include("vorschau.php");
                    @include("rezepteanzeigen.php");
                    @include("rezepteintragen.php");
                    @include("bemerkungen.php");
                    
                        // echo " <a href='vorschaubilder.php'" . " target='vorschau'>Vorschau</a>";
                } else if (isset($_SESSION["login"]) && $_SESSION["login"] == "false") {
                    echo
                    "<div id='indextext'>Sie können sich jetzt
                     zum Mitlgiederbereich anmelden.</div>";
                } else if (isset($_COOKIE["Image2Food"])) {
                    echo
                    "<div id='indextext'>Schön, Sie wiederzusehen. " .
                        "Melden Sie sich an, um in den geschlossenen " .
                        "Mitgliederbereich zu gelangen, " .
                        "wenn Sie sich dort schon registriert haben.</div>";
                } else {
                    echo
                    "<div id='indextext'>Willkommen " .
                        "auf unserer Webseite. " .
                        "Schauen Sie sich um. " .
                        "Sie können sich hier registrieren und dann " .
                        "in einem geschlossenen " .
                        "Mitgliederbereich anmelden</div>";
                }
            }
        }

        $obj = new Index();
        $obj->besucher();
        ?>
    </div>
</body>

</html>