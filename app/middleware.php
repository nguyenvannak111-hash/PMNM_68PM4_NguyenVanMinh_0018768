<?php
require_once '../app/middleware.php';
session_start();
class middleware{
    function checklogin(){
        $publiPage = ['home/login'];
        if(!isset($_SESSION['username']) && !in_array($_SERVER['REQUEST_URI'], $publicPages)){
            header('Location:/home/login');
            exit();
        }
    }
}

// $sv = new sinhvien_ctrl;
// $kq=$sv->getAll();
// var_dump($kq);

?>