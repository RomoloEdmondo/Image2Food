<?php
   /*
   Klasse mit Testmethoden, ob die offensichtlichen Regeln für
    das netzwerk erfüllt sind 
    */
    class Plausi {
        public function namentest($wert){
            if (preg_match("/^\w{2,30}$/", $wert)) {
                return 0;
            }else {
                return 1;
            }
        }

        public function emailtest($wert){
            $fehler=0;
            // Test notwendige E-mail struktur
            if (!preg_match("/\w+@\w+\.\w{2}/", $wert)) {
                $fehler++;
            }
            // nichtalphanumerische Zeichen - außer dem zeichen @
            if (preg_match("/\W/", $wert, $ergarray )) {
                if ($ergarray[0] != "@") 
                    $fehler++;
            }
            return $fehler;     
        }

        // Testmethode für den Captcha-Code
        public function captchatest($wert) {
        $fehler = 0;
        if ($_SESSION['captchacode'] != $wert) {
            return ++$fehler;
        }
        }
    /**
	 * Testmethode auf die Bedingungen für Userid und Passwort
	 * - maximal 20 Zeichen
	 * - minimal 8 Zeichen
	 * - Nur alphanumerische Zeichen
	 * - Mindestens 1 Großbuchstabe
	 * - Mindestens 1 Kleinbuchstabe
	 * - Mindestens 1 Zahl
	 * @return 0, wenn die Plausibilisierung keine Fehler ergab - sonst Zahl der Fehler
	 */
        public function nutzerdatentest($wert){
            $fehler=0;
            if (!preg_match("/^\w{8,20}$/", $wert)) {
                $fehler++;
            }
            // Keine Zahl
		if (!preg_match("/\d/", $wert)) {
			$fehler++;
		}
		// Kein Großbuchstabe
		if (!preg_match("/[A-Z]/", $wert)) {
			$fehler++;
		}
		// Kein Kleinbuchstabe
		if (!preg_match("/[a-z]/", $wert)) {
			$fehler++;
		}
		return $fehler;
        }
    }?>