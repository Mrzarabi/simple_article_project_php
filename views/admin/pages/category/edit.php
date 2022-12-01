<?php
    require_once "../../../../app/Helpers/Helper.php";

    require_once('../../../../app/Helpers/CheckLogin.php'); 
    
    require_once "../../../../DB/connect_db/pdo_connection.php";

    if(isset($_GET['id']) && $_GET['id']) {
        try {
            $query = "SELECT * FROM `categories` WHERE id = ?";
    
            $statement = $connection->prepare($query);
            
            $statement->execute([$_GET['id']]);
            
            $category = $statement->fetch();

            if(!$category) {
                redirect('views/admin/pages/category/index.php');
            }

        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        redirect('views/admin/pages/category/index.php');
    }

    if(isset($_POST['id']) && $_POST['id']) {
        try {
            $query = "UPDATE `categories` SET name = ? WHERE id = ?";
    
            $statement = $connection->prepare($query);
            
            $statement->execute([$_POST['name'], $_POST['id']]);
        
            redirect('views/admin/pages/category/index.php');
            
        } catch (\PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href=" <?= asset('assets/css/bootstrap.min.css') ?> " media="all" type="text/css">
    <link rel="stylesheet" href=" <?= asset('assets/css/style.css') ?>" media="all" type="text/css">
</head>
<body>
<section id="app">
    <?php require_once '../../layouts/top-nav.php'; ?>
    <section class="container-fluid">
        <section class="row">
            <section class="col-md-2 p-0">
                <?php require_once './../../layouts/sidebar.php'; ?>
            </section>
            <section class="col-md-10 pt-3">

                <form action=" <?= url('views/admin/pages/category/edit.php') ?> " method="post">
                    <section class="form-group">
                        <label for="name">Name</label>
                        <?php if(isset($_GET['id']) && $_GET['id']) { ?>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name ..." value=" <?= $category->name ?> ">
                            <input type="hidden" class="form-control" name="id" value=" <?= $category->id ?> ">
                        <?php } ?>
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </section>
                </form>

            </section>
        </section>
    </section>

</section>
<script src="<?= asset('assets/js/jquery.min.js') ?>" ></script>
<script src= "<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>