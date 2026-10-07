<?php


try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=kelly_portfolio;charset=utf8mb4;",
        "root",
        "",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
//        echo "Connected successfully";

} catch (PDOException $e) {
    echo "failed: " . $e->getMessage();
}



