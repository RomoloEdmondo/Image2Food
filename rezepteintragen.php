<?php
session_start();
class RezeptEintragen
{
    function eintragen_db($bild, $antwort)
    {
        @include("db.inc.php");
        $userid = $_SESSION["name"];
        if (
            $stmt = $pdo->prepare(
                "SELECT id_mitglied FROM mitglieder  " .
                "WHERE userid='$userid'"
            )
        ) {
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $id_antwortgeber = $row['id_mitglied'];
                break;
            }
        }
        if (
            $stmt = $pdo->prepare(
                "SELECT id_frage, id_mitglied FROM fragen " .
                "WHERE bild='$bild'"
            )
        ) {
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $id_frage = $row['id_frage'];
                $id_fragesteller = $row['id_mitglied'];
                break;
            }
        }
        if ($stmt = $pdo->prepare(
            "INSERT INTO antworten (id_fragesteller, " . 
            "id_antwortgeber, id_frage, antwort) " .
            "VALUES (:id_fragesteller, :id_antwortgeber, :id_frage, :antwort)")) {
            if ($stmt->execute(array(
                ':id_fragesteller' => $id_fragesteller,
                ':id_antwergeber' => $id_antwortgeber,
                ':id_frage' => $id_frage,
                'antwort' => $antwort
            ) )) {
            @include("wertupdater.php");
                new Wertupdate("antworten", $id_antwortgeber);
            echo "Ihre Rezeptvorschlag wurde eingetragen";
        }
        }
    }
}

if (isset($_GET['bild']) && isset($_GET['rezeptvorschlag']) )
{
    if (strlen($_GET['rezeptvorschlag']) ) {
        $obj=new RezeptEintragen();
        $obj->eintragen_db($_GET['bild'], $_GET['rezeptvorschlag']);
    }
}
?>