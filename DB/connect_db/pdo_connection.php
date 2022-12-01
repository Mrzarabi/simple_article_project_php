<?php

global $pdo;

$server = 'localhost';
$user = 'root';
$password = '';
$db = 'php_article_project';

try {
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    );

    $connection = new PDO("mysql:host=$server;dbname=$db", $user, $password, $options);

    return $connection;


} catch (\PDOException $e) {
    echo 'Error: ' . $e;
    exit;
}