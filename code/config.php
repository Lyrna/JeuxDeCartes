<?php

$servername = 'localhost';
$dbname = 'jeux_cartes';
$db_username = 'root';
$db_password = 'Simplon01';

try{
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
catch (PDOException $e){
    echo $e->getMessage();
}
?>