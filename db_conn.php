<?php
include "settings.php";
// database connection
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
$user = "postgres";
$password = "12345";
$pdo = new PDO($dsn, $user, $password);
