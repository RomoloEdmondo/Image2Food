<?php
session_start();
class RezepteAnzeigen
{
    function anzeigen_db($bild)
    {
        $rezeptvorschlaege = "";
        @include("db.inc.php");
        if (
            $stmt = $pdo->prepare(
                "SELECT id_frage FROM fragen " .
                "WHERE bild='$bild'"
            )
        ) {
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $id_frage = $row['id_frage'];
                break;
            }
        }
        if (
            $stmt = $pdo->prepare("SELECT id_antwortgeber, antwort FROM antworten " .
                "WHERE id_frage='$id_frage'")
        ) {
            $stmt->execute();
            while ($stmt->fetch()) {
                $rezeptvorschlaege .=
                    "<div class='vorschauinfos'>Vorschlag vom Mitglied mit der ID " .
                    $row['id_antwortgeber'] . ":<br>" .
                    $row['antwort'] . "</div>";
            }
        }
        if($rezeptvorschlaege != "") {
            echo "<h5>Rezeptideen</h5>" .
                $rezeptvorschlaege;
        } else {
            "<h5>Rezeptideen</h5>" .
                "<div class='vorschauinfos'>" .
                "Es gibt noch keine Vorschläge</div>";
        }
    }
}
if (isset($_GET['rezepte'])) {
    $obj = new RezepteAnzeigen();
    $obj->anzeigen_db($_GET['rezepte']);
}
?>