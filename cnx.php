<?php
$dsn ='mysql:host=voyageq123.mysql.db;dbname=voyageq123;charset=utf8';
$user='voyageq123';
$pass='Laskare1';

try {
    $cnx = new PDO ($dsn, $user, $pass);
} catch (PDOException $e) {
    echo 'Une erreur est survenue !';
}