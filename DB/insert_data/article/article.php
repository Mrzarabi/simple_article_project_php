<?php

$server = "localhost";
$user = 'root';
$password = '';
$db_name = 'php_article_project';


try {
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    $connection = new PDO("mysql:host=$server;dbname=$db_name", $user, $password);

    $sqls = [ 
        "INSERT INTO `articles` (category_id, title, body, image) VALUE (1, 'tennis', 'this is body of tennis', '/assets/images/posts/tennis.webp');",
        "INSERT INTO `articles` (category_id, title, body, image) VALUE (1, 'football', 'this is body of Football', '/assets/images/posts/football.webp');"
    ];

    foreach ($sqls as $sql) {
        $statment = $connection->exec($sql);
    }

} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}