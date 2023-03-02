<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Vorschau</title>
</head>
<body>
    <h1>Vorschau</h1>
    <?php
    class Thumb
    {
        function thumbnail_erstellen()
        {
            $bv = "images";
            $vb = "thumb";
            $verzeichnis = opendir($bv);
            $bilder = array();
            while (($datei = readdir($verzeichnis)) !== false) {
                if (
                    (preg_match("/\.jpe?g$/i", $datei))
                    || (preg_match("/\.png$/i", $datei))
                ) {
                    $bilder[] = $datei;
                }
            }
            closedir($verzeichnis);
            $verzeichnis = opendir($vb);

           //Schleife, bis alle Files im Verzeichnis ausgelesen wurden
			while (($datei = readdir($verzeichnis)) !== false) {
				//Oft werden auch die Standardordner . und .. ausgelesen, diese sollen ignoriert werden
				if ($datei != "." AND $datei != "..") {
					//Files vom Server entfernen
					@unlink("$vb/$datei");
				}
            }
            closedir($verzeichnis);
            foreach ($bilder as $bild) {
                if (preg_match("/\.png$/i", $bild)) {
                    $b = imagecreatefrompng("$bv/$bild");
                } else {
                    $b = imagecreatefromjpeg("$bv/$bild");
                }
                $originalbreite = imagesx($b);
                $originalhoehe = imagesy($b);
                $neubreite = 120;
                $neuehohe = floor($originalhoehe * ($neubreite / $originalbreite));
                $neuesbild = imagecreatetruecolor($neubreite, $neuehohe);
                imagecopyresampled(
                    $neuesbild,
                    $b,
                    0,
                    0,
                    0,
                    0,
                    $neubreite,
                    $neuehohe,
                    $originalbreite,
                    $originalhoehe
                );
                imagejpeg($neuesbild, "$vb/$bild");
                imagedestroy($neuesbild);

            }
        }
        function thumbnail_anzeigen()
        {
            $bv = "thumb";
            $verzeichnis = opendir($bv);
            while (($datei = readdir($verzeichnis)) !== false) {
                if ( (preg_match("/\.jpe?g$/i", $datei)) || (preg_match("/\.png$/i", $datei)) ) {
                    echo "<div class='thumb'><a class='hlink_nix' 
                    href='index.php?details=$datei'>
                    <img class='thumb_bild' src='$bv/$datei'" . 
                    "alt= 'Vorschaubild $datei'></a></div>";
                }
            }
            closedir($verzeichnis);
        }
        public function __construct()
         {
            echo '<h1>Vorschau der Zutaten</h1>' .
            '<h5>Mit einem Klick auf ein Bild erhalten Sie ' .
            'mehr Informationen und Sie können einem ' .
            'Rezeptvorschlag abgeben.</h5>' .'<div id="vorschauber">';
            $this ->thumbnail_erstellen();
            $this ->thumbnail_anzeigen();
            echo '</div><h2>Details</h2>' .
            '<div id="detailbereich"></div>';
        }
    }


    $obj = new Thumb;
    // $obj->thumbnail_erstellen();
    // $obj->thumbnail_anzeigen();
    ?>
</body>
</html>