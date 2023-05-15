<?php
    //set database name to what ever the desired name is
    $dbname = "your database name";
    // connect to database
    $dsn = 'mysql:host=localhost;dbname={$dbname}';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo '<p>Error message: $error_message </p>';
    }
