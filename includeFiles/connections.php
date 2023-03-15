<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "findmybus";
$schema="findmybus";
try {
    $pdo = new PDO("mysql:host=$servername;", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully" . "</br>";
    $pdo->query("USE findmybus");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "</br>";
}
?>