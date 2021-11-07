<?php 
include_once('lib/PdoClass.php');
use lib\PdoClass;
$database=[
		'host' => '127.0.0.1',
		'port' => '3307',
		'database' => 'flower',
		'username' => 'root',
		'password' => 'root'
	];
	
	$pdo = new PdoClass($database);
 ?>