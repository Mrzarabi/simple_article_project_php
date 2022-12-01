<?php

require_once "../../../app/Helpers/Helper.php";

require_once "../../connect_db/pdo_connection.php";

try {
    if(isset($_POST['id']) && $_POST['id'] !== '') {

        

        $query = "DELETE FROM `articles` WHERE id = ?";

        $statment = $connection->prepare($query);

        $statment->execute([$_POST['id']]);
    }
    redirect("views/admin/pages/article/index.php");
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}