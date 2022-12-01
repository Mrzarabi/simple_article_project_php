<?php
    require_once "../../../../app/Helpers/Helper.php";

    require_once('../../../../app/Helpers/CheckLogin.php'); 
    
    require_once "../../../../DB/connect_db/pdo_connection.php";

    // base_path('/DB/connect_db/pdo_connection.php');
    
    // base_path('DB/select_datas/categories/select_categories.php');
    // dd($connection);
    try {
        $statement = $connection->prepare("SELECT * FROM `articles` ORDER BY id DESC");

        $statement->execute();
    
        $articles = $statement->fetchAll();
    
        global $articles;

        foreach ($articles as $article) {
            
        }
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
    <link rel="stylesheet" href=" <?= asset('assets/css/bootstrap.min.css') ?> " media="all" type="text/css">
    <link rel="stylesheet" href=" <?= asset('assets/css/style.css') ?> " media="all" type="text/css">
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
                    <h2 class="h4">Articles</h2>
                    <a href=" <?= url('views/admin/pages/article/create.php') ?> " class="btn btn-sm btn-success">Create</a>
                </section>

                <section class="table-responsive">
                    <table class="table table-striped table-">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>image</th>
                            <th>title</th>
                            <th>cat_id</th>
                            <th>body</th>
                            <th>status</th>
                            <th>setting</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $key => $article) {?>
                            <tr>
                                <td> <?= ++$key ?> </td>
                                <td><img style="width: 90px;" src=" <?= $article->image ?> "></td>
                                <td> <?= $article->title ?> </td>
                                <?php 
                                    $statement_category = $connection->prepare("SELECT * FROM `categories` WHERE id = ?");
            
                                    $statement_category->execute([$article->category_id]);
                                        
                                    $category = $statement_category->fetch(); 
                                ?>
                                <td> <?= $category->name ?> </td>
                                <td> <?= $article->body ?> </td>
                                <td>
                                    <span <?php $article->status === "enable" ? "class='text-success'" : "class='text-success'" ?> >
                                        <?= $article->status === "enable" ? "enable" : "disable" ?>
                                    </span>
                                </td>
                                <td class="d-flex justify-content-start">
                                    <form action=" <?= url('DB/update_data/article/article.php') ?> " method="post" >
                                        <input type="hidden" name="id" value="<?= $article->id ?>">
                                        <button type="submit" class="btn btn-warning btn-sm">Change status</button>
                                    </form>
                                    <a href=" <?= url('views/admin/pages/article/edit.php/?id=') . $article->id ?> " class="btn btn-info btn-sm ml-2">Edit</a>
                                    <form action=" <?= url('DB/delete_data/article/article.php') ?> " method="post" class="ml-2">
                                        <input type="hidden" name="id" value="<?= $article->id ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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

<script src=" <?= asset('assets/js/jquery.min.js') ?> "></script>
<script src=" <?= asset('assets/js/bootstrap.min.js') ?> "></script>
</body>
</html>