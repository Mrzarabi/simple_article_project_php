<?php
    require_once "../../app/Helpers/Helper.php";

    require_once "../../DB/connect_db/pdo_connection.php";

    session_start();

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

<nav class="navbar navbar-expand-lg navbar-dark bg-blue ">

    <a class="navbar-brand " href=" ">PHP tutorial</a>
    <button class="navbar-toggler " type="button " data-toggle="collapse " data-target="#navbarSupportedContent " aria-controls="navbarSupportedContent " aria-expanded="false " aria-label="Toggle navigation ">
        <span class="navbar-toggler-icon "></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent ">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item active ">
                <a class="nav-link " href=" <?= url('views/front/index.php') ?> ">Home <span class="sr-only ">(current)</span></a>
            </li>
            <?php foreach ($categories as $category) {?>
                <li class="nav-item ">
                    <a class="nav-link " href=" <?=  url('views/front/pages/category.php/?id=') . $category->id ?>"> <?= $category->name ?> </a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <section class="d-inline ">
        <?php if(isset($_SESSION['user'])) { ?>
            <a class="text-decoration-none text-white px-2 " href=" <?= url('views/auth/logout.php') ?> ">logout</a>
        <?php } else { ?>
            <a class="text-decoration-none text-white px-2 " href=" <?= url('views/auth/register.php') ?> ">register</a>
            <a class="text-decoration-none text-white " href=" <?= url('views/auth/login.php') ?> ">login</a>
        <?php } ?>

    </section>
</nav>