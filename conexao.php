<?php

$hostname = "localhost";
$database = "db_includeGen";
$username = "root";
$password = "";

$mysqli = new mysqli(hostname: $hostname, username: $username, password: $password, database: $database);

if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
} else {
}

$mysqli->close();
