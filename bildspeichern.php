<?php
/**
 * Start der Session
 */
session_start();
?>
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title>Bild speichern </title>
		<meta name="viewport" content=
		"width=device-width, initial-scale=1.0">
        <link href="lib/css/stil.css" rel="stylesheet">
	</head>
<body>
<?php
class Bildspeichern {
    public function datup()
    {
        if (isset($_FILES['datei'])) {
            if (($_FILES['datei']['size'] > 100000) || (filesize($_FILES['datei']['tmp_name']) > 100000)) {
                echo "Die Dateigröße ist auf " .
                    "100.000 Byte beschränkt.<br>" .
                    "Verkleinern Sie das Bild bitte mit " .
                    "einem geeignet Grefikprogramm.<br>";

            } elseif (
                ($_FILES['datei']['type'] != "image/png")
                && ($_FILES['datei']['type'] != "image/pjpeg")
                && ($_FILES['datei']['type'] != "image/jpeg")
            ) {
                echo "Es durfen nur Bilddateien von Typ" .
                    " Png oder JPEG hochgeladen werden.<br>";
            } elseif (!empty($_FILES['datei']['name'])) {
                $dateiname = $_SESSION["name"] . time();
                if ($_FILES['datei']['type'] != "image/png") {
                    $dateiname .= ".jpg";
                } else {
                    $dateiname .= ".png";
                }
                $_SESSION['dateiname'] = $dateiname;
                if (move_uploaded_file($_FILES['datei']['tmp_name'], 'images/' . $dateiname)) {

                    @include("db.inc.php");
                    if (
                        $stmt = $pdo->prepare(
                            "SELECT userid, id_mitglied FROM mitglieder")) {
                        $stmt->execute();
                        while ($row = $stmt->fetch()) {
                            if ($_SESSION["name"] == $row["userid"]) {
                                $_SESSION["id_mitglied"] = $row["id_mitglied"];
                                break;
                            }
                        }
                    }
                    if ($stmt = $pdo->prepare(
                            "INSERT INTO fragen" . 
                            " (bild, zusatzinfo, id_mitglied) " .
                            " VALUES (:bild, :zusatzinfo, :userid)")) {
                        if ($stmt->execute(
                                array(
                                    ':bild' => $_SESSION["dateiname"],
                                    ':zusatzinfo' => $_POST["zusatzinfos"],
                                    ':userid' => $_SESSION["id_mitglied"]))) {
                            $dat = "upload_ok.php";
                            $_SESSION['upload'] = "Der Dateiupload war ok";
                            @include("wertupdate.php");
                            new Wertupdate("fragen", $_SESSION['id_mitglied']); // per aggiornare contatore 
                        } else {
                            $dat = "upload_fehler.php";
                        }
                        header("Location: $dat");
                    }
                }
            }
            echo "<hr><a href='index.php'>Zur Homepage</a>";
        }
    }
}

$obj = new Bildspeichern();
$obj->datup();
?>
</body>
</html>