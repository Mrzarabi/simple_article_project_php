<?php

require_once "../../../app/Helpers/Helper.php";

require_once "../../connect_db/pdo_connection.php";

try {
    $query = "ALTER TABLE `articles` ADD status enum('enalble', 'disable') DEFAULT('disable') AFTER id;";

    $statment = $connection->prepare($query);

    $statment->execute();

    redirect("views/admin/pages/article/index.php");
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}