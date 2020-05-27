<?php
require 'vendor/autoload.php';

// Using Medoo namespace
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'drone',
    'server' => 'localhost',
    'port' => 3306,
	'username' => 'root',
	'password' => ''
 ])

?>

<!-- https://medoo.in/ -->