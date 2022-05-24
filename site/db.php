<?php 
$hostdb = 'localhost';
$namedb = 'iot';
$userdb = 'root';
$passdb = '';
$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
?>