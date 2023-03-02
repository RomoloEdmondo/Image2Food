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
    <title>Image2Food - Sag mir was ich
         daraus kochen kann - Index</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div id="nav">
        <?php
            @include ("nav.php");
            @include ("plausi.inc.php");
        ?>
    </div>
    <div id="content">
        <h1>Login</h1>
       <?php
           @include ("login.inc.php");
       ?>
        <?php
            /**
             * Das soziale Netzerk für kochideen
             * Die Einstiegsseite mit der Hauptlasse
             */
            class Login {

                private function anmelden_db(){
                    $vorhanden = false;
                    @include ("db.inc.php");
                    if ($stmt= $pdo->prepare(
                        "SELECT userid, pw FROM mitglieder")) 
                    {
                        $stmt->execute();
                        while ($row= $stmt->fetch()) {
                            if (isset($_POST["userid"]) 
                            && $_POST["userid"]==$row["userid"]
                            && md5($_POST["pw"])==$row["pw"]) 
                            {
                                $vorhanden= true;
                                break;
                            }
                    }
                }
                if ($vorhanden) {
                    $_SESSION["name"] = $_POST["userid"];
                    $_SESSION["login"] = "true";
                    $dat= "index.php";
                } else {
                    $dat= "loginfehler.php";
                }
                header ("Location: $dat");
            }

                public function _login() {
					if ($this -> plausibilisieren()) {
						$this -> anmelden_db();
					}
				}
                private function plausibilisieren() {
					// Fehlervariable
					$anmelden = 0;
					$p = new Plausi();

					$anmelden += $p -> nutzerdatentest($_POST['userid']);
					$anmelden += $p -> nutzerdatentest($_POST['pw']);
                    $anmelden += $p -> captchatest($_POST['captcha']);

					// Testausgaben für den derzeitigen Stand des Projekts
					echo "Die Eingaben: <hr>";
					print_r($_POST);
					echo "<br>Fehleranzahl: " . $anmelden . "<hr>";
					if ($anmelden == 0)
						return true;
					else
						return false;
				}
            }//Class Ende 
            
            $logobj = new Login();
            if (sizeof($_POST) > 0) {
                $logobj-> _login();
            }
        ?>
    </div>
</body>
</html>