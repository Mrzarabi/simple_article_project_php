<?php 
    require_once "../../app/Helpers/Helper.php";

    require_once "../../DB/connect_db/pdo_connection.php";

    $statement = $connection->prepare("SELECT * FROM `articles` WHERE status = 'enable' ORDER BY id DESC");

    $statement->execute();

    $articles = $statement->fetchAll();

    global $articles;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href=" <?= asset('../../assets/css/bootstrap.min.css') ?> " media="all" type="text/css">
    <link rel="stylesheet" href=" <?= asset('../../assets/css/style.css') ?> " media="all" type="text/css">
</head>
<body>
<section id="app">

    <?php require_once "layouts/top-nav.php"?>

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
           <?php foreach ($articles as $article) { ?>
                <section class="col-md-4">
                    <section class="mb-2 overflow-hidden" style="max-height: 15rem;">
                        <img class="img-fluid" src=" <?= asset($article->image) ?> " alt="" width="200">
                    </section>
                    <h2 class="h5 text-truncate"><?= $article->title ?></h2>
                    <p> <?= substr($article->body, 0 , 30) ?>... </p>
                    <p><a class="btn btn-primary" href=" <?= url('views/front/pages/detail.php/?id=') . $article->id ?> " role="button">View details »</a></p>
                </section>
            <?php }  ?>
        </section>
    </section>

</section>
<script src=" <?= asset('../../assets/js/jquery.min.js') ?> "></script>
<script src=" <?= asset('../../assets/js/bootstrap.min.js') ?> "></script>
</body>
</html>