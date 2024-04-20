<?php 
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

try {
    $config = new PDO("mysql:host=localhost; dbname=ToDoList;", "root", "");
} catch (Exception $e){
    die("Database anda gagal terkoneksi !" . $e->getMessage());
    exit(0);
}

$model = "../model/model.php";
$controller = "../controller/controller.php";
?>