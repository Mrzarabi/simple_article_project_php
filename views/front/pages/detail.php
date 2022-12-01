<?php 
    require_once "../../../app/Helpers/Helper.php";

    require_once "../../../DB/connect_db/pdo_connection.php";

    if(isset($_GET['id']) && $_GET['id'] !== '') {
        
        $query = "SELECT * FROM `articles` LEFT JOIN `categories` ON articles.category_id = categories.id WHERE articles.status = 'enable' AND articles.id = ?;";
        
        $statement = $connection->prepare($query);
        
        $statement->execute([$_GET['id']]);

        global $article;

        $article = $statement->fetch();
        
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href=" <?= asset('../../../assets/css/bootstrap.min.css') ?> " media="all" type="text/css">
    <link rel="stylesheet" href=" <?= asset('../../../assets/css/style.css') ?> " media="all" type="text/css">
</head>
<body>
<section id="app">

    <section class="container my-5">
        <!-- Example row of columns -->
        <section class="row">
            <section class="col-md-12">
                <h1> <?= $article->title ?> </h1>
                <h5 class="d-flex justify-content-between align-items-center">
                    <a href=" <?= url('views/front/pages/category.php/?id=') . $article->category_id ?> "> <?= $article->name ?> </a>
                    <span class="date-time"><?= $article->created_at ?></span>
                </h5>
                <article class="bg-article p-3"><img class="float-right mb-2 ml-2" style="width: 18rem;" src="" alt=""><?= $article->body ?></article>
                <?php if(!$article) { ?>
                    <section>post not found!</section>
                <?php } ?>
            </section>
        </section>
    </section>

</section>
<script src=" <?= asset('../../../assets/js/jquery.min.js') ?> "></script>
<script src=" <?= asset('../../../assets/js/bootstrap.min.js') ?> "></script>
</body>
</html>