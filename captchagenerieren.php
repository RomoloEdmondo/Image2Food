<?php
session_start();
unset($_SESSION['captchacode']);

// Simboli che il Captcha puo contenere
$moeglicheZeichen = "abcdefghiklmnpqrstuvwxy123456789" . "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
// Numero max di caratteri ch il Captcha deve avere
$anzahlZeichen = 4;
// Captcha-Variable
$captchacode = "";
    // riempire il Captchacode con un li numero di caratteri max permessi CASUALI
for ($i = 0; $i < $anzahlZeichen; $i ++) {
    $captchacode .= substr($moeglicheZeichen, (rand() % (strlen($moeglicheZeichen))), 1);
}

// Schreiben des Captchacodes in die Session
$_SESSION['captchacode'] = $captchacode;
header('Content-type: image/jpg');

$image = imagecreate(350, 130);
$farben = array();
for ($i = 0; $i < $anzahlZeichen; $i ++) {
    $farben[$i] = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
}
$bgc = imagecolorallocate($image, 230, 230, 230);
imagefill($image, 0, 0, $bgc);
for ($i = 0; $i < $anzahlZeichen; $i ++) {
    ImageTTFText($image, rand(20, 80), rand(- 20, 60), 50 + ($i * 50), rand(80, 120), $farben[rand(0, $anzahlZeichen - 1)], "fonts/Anorexia.ttf", $captchacode[$i]);
}
for ($i = 0; $i < $anzahlZeichen; $i ++) {
    imageline($image, rand(0, 10), rand(0, 150), rand(330, 340), rand(0, 150), $farben[$i]);
}
imagejpeg($image);
imagedestroy($image);

?>

