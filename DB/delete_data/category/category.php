<?php

require_once "../../../app/Helpers/Helper.php";

require_once "../../connect_db/pdo_connection.php";

try {
    if(isset($_POST['id']) && $_POST['id'] !== '') {

        $query = ("DELETE FROM `categories` WHERE id = ?");
    
        $statement = $connection->prepare($query);
    
        $statement->execute([$_POST['id']]);
    }

    redirect('views/admin/pages/category/index.php');

} catch (\PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}