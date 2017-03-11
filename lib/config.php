<?php
/* 
* Connexion à la base de donnée avec l'objet PDO
* Récupération des différentes erreurs
* Définition des SETATRRIBUTES
*/

$user = "root";
$passwd = "";

try{
	$db = new PDO('mysql:host=localhost;dbname=tuto', $user, $passwd);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);  
}catch (PDOException $e){
	die('Erreur: '. $e->getMessage());
}