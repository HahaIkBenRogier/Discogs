<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

$host = 'localhost';
$dbname = 'discogs';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connected to $dbname at $host successfully.";
    $conn = null;
} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
}
?>
