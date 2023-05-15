<?php
    $dsn = 'mysql:host=localhost;dbname=TireCompanyDatabase';
    $username = 'root';
    $password = 'F0rEst123';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('error.php');
        exit();
    }
?>

