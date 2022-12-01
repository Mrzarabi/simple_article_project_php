<?php

$server = 'localhost';
$user = 'root';
$password = '';
$db_name = 'php_article_project';

try {
    $connection = new PDO("mysql:host=$server;dbname=$db_name", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE `categories`(
        id int NOT NULL AUTO_INCREMENT,
        name varchar(150),
        created_at datetime NOT NULL,
        updated_at datetime, 
        PRIMARY KEY(id)
    );";

    $statement = $connection->exec($sql);

} catch (\PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}