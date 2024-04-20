<?php 
require_once("ui/header.php");

if($_SESSION["status"] == ""){
    header("location:../index.php");
    exit(0);
}?>
<header class="col-md-12 col-lg-12">
    <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container-fluid">
            <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>" aria-current="page"
                class="navbar-brand text-black hover">Dashboard To Do List</a>
        </div>
    </nav>
</header>
<div class="container-fluid py-5 p-5 bg-secondary rounded-1" style="height: 90dvh; max-height: 90dvh;">
    <div class="container-fluid py-4 bg-light rounded-1" style="height: 70dvh; max-height: 70dvh;">
        <div class="d-flex justify-content-around align-items-start flex-wrap gap-1">
            <?php
                if(isset($_GET["edit"])){
                    if($_GET["edit"] == "yes"){
                        $id = htmlentities($_GET["id"]) ? htmlspecialchars($_GET["id"]) : strip_tags($_GET["id"]);
                        $hasil = $controller->Tables("SELECT * FROM listtodo WHERE id_todolist = '$id'");
                        foreach ($hasil as $i) {
            ?>
            <div class="card" style="max-height: 560px; width:420px;">
                <div class="card-header">
                    <h4 class="card-title display-4 fs-5 fw-normal">To Do List Hari Ini</h4>
                </div>
                <div class="card-body">
                    <form action="?aksi=update" method="post">
                        <input type="hidden" name="id" value="<?=$i["id_todolist"]?>">
                        <input type="hidden" name="nama" value="<?=$_SESSION["nama_pengguna"]?>">
                        <table class="table table-striped">
                            <tr>
                                <td class="fs-5">Jenis Kegiatan</td>
                                <td>
                                    <input type="text" value="<?=$i["jenis_kegiatan"]?>" name="jenis_kegiatan" id=""
                                        class="form-control" aria-required="true" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="fs-5">Nama Kegiatan</td>
                                <td>
                                    <input type="text" value="<?=$i["nama_kegiatan"]?>" name="nama_kegiatan" id=""
                                        class="form-control" aria-required="true" required>
                                </td>
                            </tr>
                        </table>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-danger">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                    }
                }
            }else{
            ?>
            <div class="card" style="max-height: 560px; width:420px;">
                <div class="card-header">
                    <h4 class="card-title display-4 fs-5 fw-normal">To Do List Hari Ini</h4>
                </div>
                <div class="card-body">
                    <form action="?aksi=create" method="post">
                        <input type="hidden" name="nama" value="<?=$_SESSION["nama_pengguna"]?>">
                        <table class="table table-striped">
                            <tr>
                                <td class="fs-5">Jenis Kegiatan</td>
                                <td>
                                    <input type="text" name="jenis_kegiatan" id="" class="form-control"
                                        aria-required="true" required>
                                </td>
                            </tr>
                            <tr>
                                <td class="fs-5">Nama Kegiatan</td>
                                <td>
                                    <input type="text" name="nama_kegiatan" id="" class="form-control"
                                        aria-required="true" required>
                                </td>
                            </tr>
                        </table>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            <button type="reset" class="btn btn-danger">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
                }
            ?>
            <div class="card" style="max-width: 720px; width:720px;">
                <div class="card-header d-flex justify-content-between align-items-start flex-wrap">
                    <div class="card-header-form">
                        <h4 class="card-title display-4 fs-5 fw-normal">To Do List
                            <?php echo "<br>".ucfirst($_SESSION["nama_pengguna"])."" ?></h4>
                    </div>
                    <div class="dropdown">
                        <a href="" role="button" class="nav-link dropdown-toggle bg-transparent"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Options
                        </a>
                        <ul class="dropdown-menu bg-transparent border border-0">
                            <li class="dropdown-item-list">
                                <a href="?page=keluar&nama=<?=$_SESSION['nama_pengguna']?>"
                                    onclick="return confirm('Apakah anda ingin keluar ?')" aria-current="page"
                                    class="dropdown-item bg-transparent nav-item">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-md table-responsive-lg">
                        <table class="table table-striped" id="example1">
                            <thead>
                                <tr>
                                    <th class="fw-normal fst-normal">No</th>
                                    <th class="fw-normal fst-normal">Jenis Kegiatan</th>
                                    <th class="fw-normal fst-normal">Nama Kegiatan</th>
                                    <th class="fw-normal fst-normal">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $hasil = $controller->Tables("SELECT * FROM listtodo where nama = '$_SESSION[nama_pengguna]' order by id_todolist asc");
                                    foreach ($hasil as $isi) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi["jenis_kegiatan"]; ?></td>
                                    <td><?php echo $isi["nama_kegiatan"]; ?></td>
                                    <td>
                                        <a href="?page=beranda&nama=<?=$_SESSION["nama_pengguna"]?>&edit=yes&id=<?=$isi["id_todolist"]?>"
                                            aria-current="page" class="btn btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="?aksi=delete&id=<?=$isi["id_todolist"]?>" aria-current="page"
                                            class="btn btn-danger"
                                            onclick="return confirm('Apakah anda ingin menghapus to do list ini ?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
require_once("ui/footer.php");
?>