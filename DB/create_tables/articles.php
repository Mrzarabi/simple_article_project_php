<?php

$server = 'localhost';
$user = 'root';
$password = '';
$db_name = 'php_article_project';

try {
    $connection = new PDO("mysql:host=$server;dbname=$db_name", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE `articles`(
        id int NOT NULL AUTO_INCREMENT,
        category_id int NOT NULL,
        title varchar(150),
        body text NULL,
        image varchar(255) NULL,
        created_at datetime NOT NULL,
        updated_at datetime,
        PRIMARY KEY(id),
        FOREIGN KEY(category_id) REFERENCES categories(id)
    );";

    $statement = $connection->exec($sql);

} catch (\PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}