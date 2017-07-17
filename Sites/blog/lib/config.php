<?php

$user = "root";
$passwd = "nw3hu5";

try{
	$db = new PDO('mysql:host=localhost;dbname=tuto', $user, $passwd, [
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
	]);
}catch (PDOException $e){
	die('Erreur: '. $e->getMessage());
}
