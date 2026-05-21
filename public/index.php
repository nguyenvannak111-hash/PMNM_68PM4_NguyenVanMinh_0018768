<?php
require_once '../app/core/App.php';
require_once '../app/middleware.php';
$middleware = new midlleware();
$middleware->checklogin;
    $app = new App();
?>