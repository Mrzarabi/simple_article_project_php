<?php

require_once "../../../app/Helpers/Helper.php";

$server = 'localhost';
$user = 'root';
$password = '';
$db_name = 'php_article_project';


try {
    $connection = new PDO("mysql:host=$server;dbname=$db_name", $user, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sqls = [
        "INSERT INTO `categories` (name) values('sport');",
        "INSERT INTO `categories` (name) values('learn');",
        "INSERT INTO `categories` (name) values('mental');"
    ];

    foreach ($sqls as $sql) {
        $statement = $connection->exec($sql);
    }

    if($statement) {
        echo "done :)";
    }

} catch (\PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}