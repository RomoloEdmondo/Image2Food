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
    <title>Image2Food – 
        Sag mir, was ich daraus kochen kann – Login</title>
</head>
<body>
    <div id="nav">
        <?php
            @include ("nav.php");
        ?>
    </div>
    <div id="content">
        <h1>Anmeldfehler</h1>
        <?php 
            @include ("login.php");
            class LoginFehler {
                public function fehler() {
                    echo
                    "<h4>Die Anmeldedaten waren leider falsch</h4>" .
                    "<a href ='login.php'>Neu anmelden</a>";
                }
            }
            $loginobj = new LoginFehler();
            $loginobj->fehler();
        ?>
    </div>
</body>
</html>