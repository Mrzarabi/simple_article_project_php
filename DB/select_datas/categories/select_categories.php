<?php

require_once "../../../app/Helpers/Helper.php";

require_once "../../connect_db/pdo_connection.php";

try {
    $statement = $connection->prepare("SELECT * FROM `categories` ORDER BY id DESC");
    $statement->execute();

    $categories = $statement->fetchAll();

    global $categories;

    if($statement) {
        echo "done :)";
    }

} catch (\PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}