<?php
    Class Wertupdate {
        
        // la funzione prima legge il $wert..
    public function __construct($feld, $id_mitglied)
    {

        try {

            @include("db.inc.php");
            $sql1 = "SELECT $feld FROM mitglieder " .
                "WHERE id_mitglied = $id_mitglied";
            if ($stmt = $pdo->prepare($sql1)) {
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    $wert = $row[$feld];
                }
            }
            // ..e gli aggiunge 1
            $wert += 1;

            // aggiorna $wert con il nuovo valore sul database
            $sql2 = "UPDATE mitglieder SET $feld = $wert " .
                "WHERE id_mitglied = $id_mitglied";
            if ($stmt = $pdo->prepare($sql2)) {
                $stmt->execute();
            }
        } catch (PDOException $e) {
            die($e->getMessage());
}

}
}
?>