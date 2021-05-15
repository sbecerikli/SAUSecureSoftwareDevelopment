<?php
$servername = "localhost:3306";
$uname = "root";
$pword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=secure_ticket", $uname, $pword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
