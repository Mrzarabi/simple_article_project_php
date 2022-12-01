<?php 

require_once "Helper.php";

session_start();

if(!isset($_SESSION['user'])) {
    redirect('views/auth/login.php');
} 