<?php
    require_once "../../../../app/Helpers/Helper.php";

    require_once('../../../../app/Helpers/CheckLogin.php'); 
    
    require_once "../../../../DB/connect_db/pdo_connection.php";

    // base_path('/DB/connect_db/pdo_connection.php');
    
    // base_path('DB/select_datas/categories/select_categories.php');
    // dd($connection);
    try {
        $statement = $connection->prepare("SELECT * FROM `categories` ORDER BY id DESC");
        $statement->execute();
    
        $categories = $statement->fetchAll();
    
        global $categories;
        
    } catch (\PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP panel</title>
    <link rel="stylesheet" href="<?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>" media="all" type="text/css">
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

                <section class="mb-2 d-flex justify-content-between align-items-center">
                    <h2 class="h4">Categories</h2>
                    <a href=" <?= url('views/admin/pages/category/create.php') ?> " class="btn btn-sm btn-success">Create</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>name</th>
                                <th>setting</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $loop => $category) { ?>                            
                                <tr>
                                    <td> <?= ++$loop ?> </td>
                                    <td> <?= $category->name ?> </td>
                                    <td class="d-flex">
                                        <a href=" <?= url('views/admin/pages/category/edit.php/?id=') . $category->id ?>" class="btn btn-info btn-sm mr-2">Edit</a>

                                        <form action=" <?= url('DB/delete_data/category/category.php') ?> " method="post">
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            <input type="hidden" name="id" value=" <?= $category->id ?> ">
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </section>
            </section>
        </section>
    </section>
</section>

<script src="<?= asset('assets/js/jquery.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
</body>
</html>