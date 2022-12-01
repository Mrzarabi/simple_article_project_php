<?php

$server = 'localhost';
$user = 'root';
$password = '';
$db_name = 'php_article_project';

try {
    $connection = new PDO("mysql:host=$server;dbname=$db_name", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE `users`(
        id int NOT NULL AUTO_INCREMENT,
        first_name varchar(150) NULL,
        last_name varchar(150) NULL,
        email varchar(150),
        password varchar(50),
        created_at datetime NOT NULL,
        updated_at datetime, 
        PRIMARY KEY(id),
        UNIQUE(email)
    );";

    $statement = $connection->exec($sql);

} catch (\PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}