<?php
    require_once "../../../../app/Helpers/Helper.php";

    require_once('../../../../app/Helpers/CheckLogin.php'); 
    
    require_once "../../../../DB/connect_db/pdo_connection.php";
    
    if(isset($_POST['title']) && $_POST['title'] !== ''
       && isset($_FILES['image']) && $_FILES['image'] !== ''
       && isset($_POST['category_id']) && $_POST['category_id'] !== ''
       && isset($_POST['body']) && $_POST['body'] !== '') {
        
        $query = "SELECT * FROM `categories` WHERE id = ?";

        $statement_category = $connection->prepare($query);

        $statement_category->execute([$_POST['category_id']]);

        $category = $statement_category->fetch();

        $valid_types = ['jpg', 'png', 'jpeg', 'gif'];
        $file_type = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        if(! in_array($file_type, $valid_types)) {
            redirect('views/admin/pages/article/index.php');
        }

        $image = "../../../../assets/images/articles/" . date('Y_m_d_H_i_s') . '.' . $file_type;
        $image_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $image);
        
        if($image_uploaded && $category) {
            $query = "INSERT INTO `articles` SET title = ?, image = ?, category_id = ?, body = ?, created_at = now(), updated_at = now();";

            $statement = $connection->prepare($query);
            
            $statement->execute([$_POST['title'], $image, $category->id, $_POST['body']]);
           
        }

        redirect('views/admin/pages/article/index.php');
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

                <form action=" <?= url('views/admin/pages/article/create.php') ?> " method="post" enctype="multipart/form-data">
                    <section class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="title ...">
                    </section>
                    <section class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </section>
                    <section class="form-group">
                        <label for="cat_id">Category</label>
                        <?php 
                            $query = "SELECT * FROM `categories`";

                            $statement_categories = $connection->prepare($query);

                            $statement_categories->execute();

                            $categories = $statement_categories->fetchAll();
                        ?>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select category</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value=" <?= $category->id ?> "> <?= $category->name ?> </option>
                            <?php } ?>
                        </select>
                    </section>
                    <section class="form-group">
                        <label for="body">Body</label>
                        <textarea class="form-control" name="body" id="body" rows="5" placeholder="body ..."></textarea>
                    </section>
                    <section class="form-group">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </section>
                </form>

            </section>
        </section>
    </section>

</section>

    <script src=" <?= asset('assets/js/jquery.min.js') ?> "></script>
    <script src=" <?= asset('assets/js/bootstrap.min.js') ?> "></script>
</body>
</html>