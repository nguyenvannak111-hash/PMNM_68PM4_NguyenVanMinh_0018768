<?php
require_once '../app/core/App.php';
    require_once '../app/middleware.php';
    $middleware = new middleware();
    $middleware->checklogin();
    $app = new App();
?>
//bài tập về nhà
//feat<core>: add Controler + ConnectDB
//feat<model>add SinhvienModel :: getAll()
//feat :Hiển thị danh sách sinh viên

//bài tập về nhà
//feat<sinvien> :paging
//feat<sinhvien> :update sinvien
//feat<sinvien> : delete