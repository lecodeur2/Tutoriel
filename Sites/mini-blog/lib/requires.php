<?php
session_start();
require 'constants.php';
require 'function.php';
require 'config.php';
require 'Autoloader.class.php';

$Autoloader = new Autoloader();
$Session = new Session();
