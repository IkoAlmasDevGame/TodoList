<?php 
namespace model;

class AuthLogin {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function LoginAuth($userEmail,$password){
        $userEmail = htmlspecialchars($_POST["userEmail"]) ? htmlentities($_POST["userEmail"]) : strip_tags($_POST["userEmail"]);
        $password = htmlspecialchars($_POST["password"]) ? htmlentities($_POST["password"]) : strip_tags($_POST["password"]);
        password_verify($password, PASSWORD_DEFAULT);

        $table = "tb_users";
        $sql = "SELECT * FROM $table WHERE email = ? and password = ? || username='$userEmail' and password='$password'";
        $row = $this->db->prepare($sql);
        $row->execute(array($userEmail,$password));
        $cek = $row->rowCount();

        if($cek > 0){
            $response = array($userEmail,$password);
            $respond["tb_users"] = $response;
            if($db = $row->fetch()){
                $_SESSION["id_pengguna"] = $db["id"];
                $_SESSION["email_pengguna"] = $db["email"];
                $_SESSION["username"] = $db["username"];
                $_SESSION["nama_pengguna"] = $db["nama"];
                header("location:view/ui/header.php?page=beranda&nama=".$_SESSION["nama_pengguna"]);
            }
            $_SESSION["status"] = true;
            array_push($respond["tb_users"], $db);
            echo "<script>alert('Selamat anda sudah berhasil login.')</script>";
            die;
            exit(0);
            return true;
        }else{
            $_SESSION["status"] = false;
            echo "<script>alert('anda gagal login.')</script>";
            die;
            exit(0);
            return false;
        }
    }
    
    public function RegisterAuth($email,$username,$password,$nama){
        $email = htmlspecialchars($_POST["email"]) ? htmlentities($_POST["email"]) : strip_tags($_POST["email"]);
        $username = htmlspecialchars($_POST["username"]) ? htmlentities($_POST["username"]) : strip_tags($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]) ? htmlentities($_POST["password"]) : strip_tags($_POST["password"]);
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : strip_tags($_POST["nama"]);
        password_verify($password, PASSWORD_DEFAULT);

        $table = "tb_users";
        $sql = "INSERT INTO $table (email,username,password,nama) VALUES (?,?,?,?)";
        $row = $this->db->prepare($sql);
        if($row->execute(array($email,$username,$password,$nama)) === true){
            $_SESSION["status"] = true;
            echo "<script>
            alert('berhasil dibuat akun baru');
            document.location.href='index.php';
            </script>";
            die;
            exit(0);
            return true;
        }else{
            $_SESSION["status"] = false;
            echo "<script>
            alert('gagal membuat akun baru');
            document.location.href='index.php';
            </script>";
            die;
            exit(0);  
            return false;          
        }
    }
}

class ModelToDoList {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function table($query){
        $sql = $query;
        $row = $this->db->prepare($sql);
        $row->execute();
        return $row;
    }

    public function create($nama,$jenis,$kegiatan){
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : strip_tags($_POST["nama"]);
        $jenis = htmlspecialchars($_POST["jenis_kegiatan"]) ? htmlentities($_POST["jenis_kegiatan"]) : strip_tags($_POST["jenis_kegiatan"]);
        $kegiatan = htmlspecialchars($_POST["nama_kegiatan"]) ? htmlentities($_POST["nama_kegiatan"]) : strip_tags($_POST["nama_kegiatan"]);
        
        $table = "listtodo";
        $sql = "INSERT INTO $table (nama,jenis_kegiatan,nama_kegiatan) VALUES (?,?,?)";
        $row = $this->db->prepare($sql);

        if($row->execute(array($nama,$jenis,$kegiatan)) === true){
            echo "<script>alert('anda berhasil membuat to do list anda'); document.location.href='../ui/header.php?page=beranda&nama=$_SESSION[nama_pengguna]'</script>";
            exit();
            return true;
        }else{
            echo "<script>alert('anda gagal membuat to do list anda'); document.location.href='../ui/header.php?page=beranda&nama=$_SESSION[nama_pengguna]'</script>";
            exit();
            return false;
        }
    }

    public function update($nama,$jenis,$kegiatan,$id){
        $id = htmlspecialchars($_POST["id"]) ? htmlentities($_POST["id"]) : strip_tags($_POST["id"]);
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : strip_tags($_POST["nama"]);
        $jenis = htmlspecialchars($_POST["jenis_kegiatan"]) ? htmlentities($_POST["jenis_kegiatan"]) : strip_tags($_POST["jenis_kegiatan"]);
        $kegiatan = htmlspecialchars($_POST["nama_kegiatan"]) ? htmlentities($_POST["nama_kegiatan"]) : strip_tags($_POST["nama_kegiatan"]);
        
        $table = "listtodo";
        $sql = "UPDATE $table SET nama = ?, jenis_kegiatan = ?, nama_kegiatan = ? where id_todolist = ?";
        $row = $this->db->prepare($sql);

        if($row->execute(array($nama,$jenis,$kegiatan,$id)) === true){
            echo "<script>alert('anda berhasil mengubah to do list anda'); document.location.href='../ui/header.php?page=beranda&nama=$_SESSION[nama_pengguna]'</script>";
            exit();
            return true;
        }else{
            echo "<script>alert('anda gagal mengubah to do list anda'); document.location.href='../ui/header.php?page=beranda&nama=$_SESSION[nama_pengguna]'</script>";
            exit();
            return false;
        }
    }
    
    public function delete($id){
        $id = htmlspecialchars($_GET["id"]) ? htmlentities($_GET["id"]) : strip_tags($_GET["id"]);
        
        $table = "listtodo";
        $sql = "DELETE FROM $table WHERE id_todolist = ?";
        $row = $this->db->prepare($sql);

        if($row->execute(array($id)) === true){
            echo "<script>alert('anda berhasil hapus to do list anda'); document.location.href='../ui/header.php?page=beranda&nama=$_SESSION[nama_pengguna]'</script>";
            exit();
            return true;
        }else{
            echo "<script>alert('anda gagal hapus to do list anda'); document.location.href='../ui/header.php?page=beranda&nama=$_SESSION[nama_pengguna]'</script>";
            exit();
            return false;
        }
    }
}

?>