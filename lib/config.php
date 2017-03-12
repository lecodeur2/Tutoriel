<?php
/* 
* Connexion à la base de donnée avec l'objet PDO
* Récupération des différentes erreurs
* Définition des SETATRRIBUTES
*/

$user = "root";
$passwd = "";

try{
	$db = new PDO('mysql:host=localhost;dbname=tuto', $user, $passwd, [
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
	]);
}catch (PDOException $e){
	die('Erreur: '. $e->getMessage());
}