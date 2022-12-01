<?php
    require_once('../../app/Helpers/Helper.php');

    require_once "../../DB/connect_db/pdo_connection.php";

    $error = '';

    if(isset($_POST['email']) && $_POST['email'] !== ''
       && isset($_POST['first_name']) && $_POST['first_name'] !== ''
       && isset($_POST['last_name']) && $_POST['last_name'] !== ''
       && isset($_POST['password']) && $_POST['password'] !== ''
       && isset($_POST['confirm']) && $_POST['confirm'] !== '') {
        // dd('asldfjaslf');
        if($_POST['password'] !== $_POST['confirm']) {
            $error = 'رمز عبور شما مطابقت ندارد';
        }

        if(strlen($_POST['password']) < 4) {
            $error = 'رمز عبور شما ضعیف است';
        }

        $query = "SELECT * FROM `users` WHERE email = ?;";

        $statment = $connection->prepare($query);

        $statment->execute([$_POST['email']]);

        $user = $statment->fetch();

        if($user) {
            $error = "قبلا با این ایمیل یک حساب کاربری ساخته شده";
        }

        if($error == '') {
            $query = "INSERT INTO `users` SET first_name = ?, last_name = ?, email = ?, password = ?, created_at = now(), updated_at = now();";
            
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $statement = $connection->prepare($query);
            
            $statement->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'], $password]);

            redirect("views/admin/pages/article/index.php");
        }

    } else {
        if(!empty($_POST)) $error = "فیلد ها الزامی هستند";
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP tutorial</title>
    <link rel="stylesheet" href="  <?= asset('assets/css/bootstrap.min.css') ?>" media="all" type="text/css">
    <link rel="stylesheet" href=" <?= asset('assets/css/style.css') ?> " media="all" type="text/css">
</head>

<body>
    <section id="app">

        <section style="height: 100vh; background-color: #138496;" class="d-flex justify-content-center align-items-center">
            <section style="width: 20rem;">
                <h1 class="bg-warning rounded-top px-2 mb-0 py-3 h5">PHP Tutorial login</h1>
                <section class="bg-light my-0 px-2">
                    <small class="text-danger">
                        <?php if($error !== '') echo $error; ?>
                    </small>
                </section>
                <form class="pt-3 pb-1 px-2 bg-light rounded-bottom" action=" <?= url('views/auth/register.php') ?> " method="post">
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email ...">
                    </section>
                    <section class="form-group">
                        <label for="first_name">First Name</label>  
                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first_name ...">
                    </section>
                    <section class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last_name ...">
                    </section>
                    <section class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password ...">
                    </section>
                    <section class="form-group">
                        <label for="confirm">Confirm</label>
                        <input type="password" class="form-control" name="confirm" id="confirm" placeholder="confirm ...">
                    </section>
                    <section class="mt-4 mb-2 d-flex justify-content-between">
                        <input type="submit" class="btn btn-success btn-sm" value="register">
                        <a class="" href="">register</a>
                    </section>
                </form>
            </section>
        </section>

    </section>
    <script src=" <?= asset('assets/js/jquery.min.js') ?> "></script>
    <script src=" <?= asset('assets/js/bootstrap.min.js') ?> "></script>
</body>

</html>