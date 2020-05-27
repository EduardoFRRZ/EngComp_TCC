<?php

include_once("orm.php");

$username = $_POST['username'];
$password = $_POST['password'];

$users = $database->select("juiz", "*", ["AND" => [
	"username" => $username, "password" => $password
]]);

if (count($users) > 0) {
	$user = $users[0];
	setcookie("login", $user['id']);
}
header("location:index.php");
