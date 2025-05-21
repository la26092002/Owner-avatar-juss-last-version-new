<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Setting up the time zone
date_default_timezone_set('Africa/Algiers');

// Host Name (Docker service name)
$dbhost = 'db';

// Database Name
$dbname = 'mydb';

// Database Username
$dbuser = 'larbi';

// Database Password
$dbpass = 'larbi123';

// Defining base url
define("BASE_URL", "");

// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname};charset=utf8mb4", $dbuser, $dbpass);
$pdo->exec("SET NAMES 'utf8mb4'");

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


}
catch(PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
