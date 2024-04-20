<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard To Do List</title>
        <?php 
            session_start();
            require_once("../../configs/auth.php");
            require_once("../../configs/config.php");
            require_once("../../database/koneksi.php");
            require_once("../../controller/controller.php");
            require_once("../../model/model.php");

            $controller = new controller\ToDoList($config);
            
            if(!isset($_GET["page"])){
                require_once("../index.php");
            }else{
                switch ($_GET["page"]) {
                    case 'beranda':
                        $title = "beranda";
                        require_once("../index.php");
                        break;

                    case 'keluar':
                        if(isset($_SESSION['status'])){
                            unset($_SESSION['status']);
                            session_unset();
                            session_destroy();
                            $_SESSION = array();
                        }
                        header("location:../../index.php");
                        exit(0);
                    break;

                    
                    default:
                        require_once("../index.php");
                        break;
                }
            }

            if(!isset($_GET["aksi"])){
                require_once("../../controller/controller.php");
                require_once("../../model/model.php");
            }else{
                switch($_GET["aksi"]){
                    case 'create':
                        $controller->membuat();
                    break;
                    
                    case 'update':
                        $controller->ubah();
                    break;

                    case 'delete':
                        $controller->hapus();
                    break;
                    
                    default:
                        require_once("../../controller/controller.php");
                        require_once("../../model/model.php");
                    break;
                }
            }
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    </head>

    <body>