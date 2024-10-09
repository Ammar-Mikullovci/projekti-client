<?php
$host = "localhost"; 
$db = "projekti"; 
$charset = "utf8mb4"; 
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$username = "root"; 
$password = ""; 

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Lidhja ka dështuar: " . $e->getMessage();
}
?>
