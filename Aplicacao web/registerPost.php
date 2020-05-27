<?php

include_once("orm.php");

$username = $_POST['username'];
$password = $_POST['password'];

$database->insert("juiz", ["username" => $username, "email" => $username, "password" => $password]);

header("Location:index.php");
