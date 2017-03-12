<?php
session_start();
$filename = array('lib/config.php', 'lib/form.class.php', 'lib/flash.class.php');


foreach ($filename as $f){
	require $f;
}

$form = new form();
$session = new session();
