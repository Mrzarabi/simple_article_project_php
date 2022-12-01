<?php



$server = 'localhost';
$user = 'root';
$password = '';

try {
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    $connection = new PDO("mysql:host=$server", $user, $password, $option);

    $sql = "CREATE DATABASE `php_article_project`";

    $statement = $connection->exec($sql);

} catch (\PDOException $e) {
    echo 'Error: ' . $e;
}