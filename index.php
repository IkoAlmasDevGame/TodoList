<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To Do List</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <?php 
            require_once("database/koneksi.php");
            require_once("model/model.php");
            require_once("controller/controller.php");
            $controller = new controller\Authentication($config);

            if(!isset($_GET["aksi"])){
                require_once("index.php");
            }else{
                switch ($_GET["aksi"]) {
                    case 'login':
                        $controller->Login();
                        break;
                        
                    case 'register':
                        $controller->Register();
                        break;
                    
                    default:
                        require_once("index.php");
                        break;
                }
            }
        ?>
    </head>

    <body>
        <div class="app">
            <div class="layout">
                <header class="col-md-12 col-lg-12">
                    <nav class="navbar navbar-expand-lg bg-secondary">
                        <div class="container-fluid">
                            <a href="index.php" aria-current="page" class="navbar-brand text-light">To Do List</a>
                            <button type="button" class="navbar-toggler" data-bs-target="#navbarToggleSupport"
                                data-bs-toggle="collapse" aria-controls="navbarToggleSupport" aria-expanded="false"
                                aria-label="navbar Toggle Support">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <aside class="collapse navbar-collapse" id="navbarToggleSupport">
                                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a href="index.php" aria-current="page"
                                            class="nav-link hover text-light">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" aria-current="page" data-bs-target="#ModalUpLogin"
                                            data-bs-toggle="modal" class="nav-link hover text-light">Login</a>
                                    </li>
                                </ul>
                            </aside>
                        </div>
                    </nav>
                </header>

                <section class="d-flex justify-content-center align-items-center">
                    <div class="container-fluid py-5 bg-light">
                        <div class="container-fluid py-4 bg-secondary" style="height:80dvh; max-height: 80dvh;">
                            <h4 class="display-4 fst-normal fw-normal
                             text-light hover text-center">To Do List</h4>
                            <h4 class="display-4 fst-normal fw-normal
                             text-light hover text-center">By IkoAlmasDevGame</h4>
                        </div>
                    </div>
                </section>

                <div class="modal fade" id="ModalUpLogin" tabindex="-1" aria-expanded="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title fs-4 display-4 fst-normal">Login To Do List</h4>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="?aksi=login" method="post">
                                    <div class="modal-group">
                                        <table class="table table-striped">
                                            <tr>
                                                <td class="fs-5">Email / Username</td>
                                                <td>
                                                    <input type="text" name="userEmail" id="InputUserEmail"
                                                        class="form-control" aria-required="true" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fs-5">Password</td>
                                                <td>
                                                    <input type="password" name="password" id="InputPassword"
                                                        class="form-control" aria-required="true" required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-sign-in-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-default" aria-expanded="false"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="text-center">
                                        <a href="#" role="button" aria-current="page" data-bs-target="#ModalUpRegister"
                                            data-bs-toggle="modal" aria-expanded="false"
                                            class="text-decoration-none text-primary hover">Buat Akun</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalUpRegister" tabindex="-1" aria-expanded="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title fs-4 display-4 fst-normal">Register Akun To Do List</h4>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="?aksi=register" method="post">
                                    <div class="modal-group">
                                        <table class="table table-striped">
                                            <tr>
                                                <td class="fs-5">Email</td>
                                                <td>
                                                    <input type="email" name="email" id="InputEmail"
                                                        placeholder="masukkan email baru" class="form-control"
                                                        aria-required="true" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fs-5">Username</td>
                                                <td>
                                                    <input type="text" name="username" id="InputUsername"
                                                        placeholder="masukkan username baru" class="form-control"
                                                        aria-required="true" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fs-5">Password</td>
                                                <td>
                                                    <input type="password" name="password" id="InputPassword"
                                                        placeholder="masukkan password baru" class="form-control"
                                                        aria-required="true" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fs-5">nama</td>
                                                <td>
                                                    <input type="text" name="nama" placeholder="masukkan nama anda"
                                                        id="InputNama" class="form-control" aria-required="true"
                                                        required>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                        </button>
                                        <button type="button" class="btn btn-default" aria-expanded="false"
                                            data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    </body>

</html>