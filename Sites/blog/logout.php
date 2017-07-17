<?php
require "lib/requires.php";
$session = new Session();

if(!isset($_SESSION['Auth'])){
  $Session->setFlash("Vous devez être connecté pour vous déconnecter", "warning", "Vous devez être connecté")->redirect(WEBROOT);
}else{
  unset($_SESSION['Auth']);
  $Session->setFlash("Vous êtes maintenant déconnecter", "success", "Succes")->redirect(WEBROOT);

}
