<?php
session_start();

    /**Festlegung der Untergranze für die PHP-version 
    @version: 1.0
    */
    if ( 0 > version_compare(PHP_VERSION, '7')) {  /*The die() or exit() function prints a message and terminates the current script.*/
        die ('<h1>Für diese Anwendung ' . 
        'Ist mindesten PHP 7 notwending</h1>');
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <link rel="stylesheet" href="lib/css/stil.css">
    <meta charset="UTF-8">
    <title>Image2Food –
			Sag mir, was ich daraus kochen kann – Registrierung</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="nav">
        <?php
            @include("nav.php");
            @include("plausi.inc.php");
        ?>
    </div>
    <div id="content">
        <h1>Registrierung</h1>
       
        <?php
        @include("registrieren.inc.php");
            /**
             * Image2Food
             * Das soziale Netzerk für kochideen
             * Die Registrierungsseite
             */
            class Registrierung {
                /* Registrierungsmethode 
                - Erst Eingeben des NAnwenders plausibilisieren
                - Dann in der MySQLDatenbank eintragen, wenn die plausibilirung
                 keine Fehler ergeben hat
                 */
                    public function registrieren(){
                        if ($this->plausibilisieren()) {    
                            $this->eintragen_db();
                        }
                    }
                    /* Plausibilisierungsmethode
                    Testet die enzelnen Eingabefelder des
                    Registrierungsformulars gegenüber 
                    - den Notwendigkeit in der MySQL-Datenbank und
                    - weiteren Anforderungen, die die Logik
                    des Netwerks fordert.
                    Die Eingaben stehen im globalen Array $_POST
                    zur Verfügung
                    @return true, wenn die Plausibiisierung 
                    keine Fehler ergab - sonst false
                    */
                    private function plausibilisieren(){
                        //Fehlervariable
                        $anmelden= 0;
                        $p = new Plausi();

                        $anmelden += $p-> namentest($_POST["name"]);
                        $anmelden += $p-> namentest($_POST["vorname"]);
                        $anmelden += $p-> emailtest($_POST["email"]);

                        $anmelden += $p-> nutzerdatentest($_POST['userid']);
                        $anmelden += $p-> nutzerdatentest($_POST['pw']);
                        //Kritische Zeichen auf freien Eigabe der zusatzinfo eliminieren
                        $_POST["zusatzinfos"] = 
                        preg_replace("/[<|>|$|%|&|§]/", "#",
                         $_POST['zusatzinfos']);
                        // Testausgaben für den erzeitigen Stand 
                        // des Projekts
                        echo "Die Eingaben: <hr>";
                        print_r($_POST);
                        echo "<br>Fehleranzahl: " . $anmelden . "<hr>";
                        if ($anmelden == 0) return true;
                        else return false;
                    }
                    /* Eintragen der Anmeldedaten in der Datenbank
                    Die Eingeben stehen im globalen Array $_POST zur verfügung */
                    private function eintragen_db(){
                        @include ("db.inc.php");

                        try{
                            $stmt= $pdo->prepare("INSERT INTO mitglieder ( 
                                name, vorname, email, zusatzinfos, rolle, userid, pw)
                                VALUES ( :name, :vorname, :email, :zusatzinfos, :rolle, :userid, :pw)");
                                $stmt->execute(array(
                                    ':name' => $_POST['name'],
                                    ':vorname' => $_POST['vorname'],
                                    ':email' => $_POST['email'],
                                    ':zusatzinfos' => $_POST['zusatzinfos'],
                                    ':rolle' => "Mitglied",
                                    ':userid' => $_POST['userid'],
                                    ':pw' => md5 ($_POST['pw'])
                                ));
                                $_SESSION["name"]=$_POST["userid"];
                                $_SESSION["login"]= "false";
                                $dat = "index.php";
                            }catch (PDOException $e) {
                                $dat= "regfehler.php";
                    }
                    header("Location: $dat");
            }
        }

            $regobj = new Registrierung();
            if (sizeof($_POST) > 0) {
                $regobj->registrieren();
            }
        
        ?>
    </div>
</body>
</html>