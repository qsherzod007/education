<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "edu";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//    echo "Bazaga ulandi!";
} catch (PDOException $e) {
    echo "Bazaga ulana olmadi: ";
}