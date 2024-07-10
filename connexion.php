<?php
$host = "localhost";
$base = "salon_coiffure";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
}
?>
