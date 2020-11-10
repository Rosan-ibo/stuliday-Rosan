<?php

    $servername = 'localhost';
    $dbname = 'stuliday';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host={$servername};dbname={$dbname}", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        session_start();
    } catch (PDOException $e) {
        echo 'Erreur : '.$e->getMessage();
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        header('Location: index.php');
    }
