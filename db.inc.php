<?php
    try {
        $pdo = new PDO ('mysql:dbname=sozialesnetzwerk;host=localhost;charset=utf8','root', '');
        // echo "Verbindung an DB Erstellt";
    }
        catch (PDOException $e) {
            die ($e->getMessage());
        }
?>