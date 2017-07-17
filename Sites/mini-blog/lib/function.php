<?php

function str_random($length){
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function debug($var){
    echo '<pre>' . print_r($var, true) . '</pre>';
}

function is_logged(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    if(!isset($_SESSION['Auth'])){
        $session->setFlash("Vous devez être connecté pour accéder à cette page", "warning")->redirect("index.php");
    }
}
