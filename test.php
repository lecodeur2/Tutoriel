<?php
$filename = "lib/config.php";
require "lib/form.class.php";

if(file_exists($filename)){
	require $filename;
}else{
	echo "Le fichier est manquant";
	exit();
}

$select = $db->query("SELECT * FROM news");
$news = $select->fetchAll();
foreach ($news as $n) {
	echo $n->name;
}