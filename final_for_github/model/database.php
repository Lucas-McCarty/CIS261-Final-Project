<?php
    // connect to database
    $dsn = 'mysql:host=localhost;dbname=cis261_final';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo '<p>Error message: $error_message </p>';
    }