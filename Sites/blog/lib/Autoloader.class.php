<?php

class Autoloader{

    public function __construct(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public function autoload($class){
        //echo 'Try to call  ' . $class . '.php inside ' . __METHOD__ . '<br>';
        require 'classes/' . $class . '.class.php';
    }
}
