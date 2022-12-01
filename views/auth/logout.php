<?php

require_once('../../app/Helpers/Helper.php');

session_start();

if(isset($_SESSION['user'])) {
    session_destroy();

    redirect('views/auth/login.php');
}