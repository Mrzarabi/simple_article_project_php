<?php

require_once "../../../app/Helpers/Helper.php";

require_once "../../connect_db/pdo_connection.php";

try {
    if(isset($_POST['id']) && $_POST['id'] !== '') {

        $query = "SELECT * FROM `articles` WHERE id = ?";

        $statment = $connection->prepare($query);

        $statment->execute([$_POST['id']]);

        $article = $statment->fetch();

        $status = $article->status == "enable" ? "disable" : "enable";
    
        $query = "UPDATE `articles` set status = ? WHERE id = ?";

        $statment = $connection->prepare($query);

        $statment->execute([$status, $article->id]);
    }
    redirect("views/admin/pages/article/index.php");
} catch (\PDOException $e) {
    echo "Error: " . $e->getMessage();
}