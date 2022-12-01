<?php 
    require_once "../../../app/Helpers/Helper.php";

    require_once "../../../DB/connect_db/pdo_connection.php";

    if(isset($_GET['id']) && $_GET['id'] !== '') {
        
        $query = "SELECT * FROM `categories` WHERE id = ?";

        $statement = $connection->prepare($query);
    
        $statement->execute([$_GET['id']]);
        
        global $category;
        $category = $statement->fetch();

        if($category) {
            $query = "SELECT * FROM `articles` WHERE articles.category_id = ? AND status = 'enable';";
            
            $statement = $connection->prepare($query);
            
            $statement->execute([$_GET['id']]);
    
            global $articles;
    
            $articles = $statement->fetchAll();
        }
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
      
            <section class="row">
                <section class="col-12">
                    <h1> <?= $category->name ?> </h1>
                    <hr>
                </section>
            </section>
            <section class="row">
               <?php foreach ($articles as $article) { ?>
                    <section class="col-md-4">
                        <section class="mb-2 overflow-hidden" style="max-height: 15rem;">
                            <img class="img-fluid" src=" <?= asset($article->image) ?> " alt="" width="200"></section>
                        <h2 class="h5 text-truncate"> <?= $article->title ?> </h2>
                        <p> <?= substr($article->body, 0 , 30) ?>... </p>
                        <p><a class="btn btn-primary" href=" <?= url('views/front/pages/detail.php/?id=') . $article->id ?> " role="button">View details »</a></p>
                    </section>
                <?php } ?>
            </section>
            <?php if(!$category) { ?>
                <section class="row">
                    <section class="col-12">
                        <h1>Category not found</h1>
                    </section>
                </section>
            <?php } ?>
        </section>
    </section>

</section>
<script src=" <?= asset('../../../assets/js/jquery.min.js') ?> "></script>
<script src=" <?= asset('../../../assets/js/bootstrap.min.js') ?> "></script>
</body>
</html>