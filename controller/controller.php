<?php 
namespace controller;

use model\AuthLogin;
class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new AuthLogin($konfig);
    }

    public function Login(){
        session_start();
        $userEmail = htmlspecialchars($_POST["userEmail"]) ? htmlentities($_POST["userEmail"]) : strip_tags($_POST["userEmail"]);
        $password = htmlspecialchars($_POST["password"]) ? htmlentities($_POST["password"]) : strip_tags($_POST["password"]);
        $this->konfig->LoginAuth($userEmail,$password);
    }

    public function Register(){
        $email = htmlspecialchars($_POST["email"]) ? htmlentities($_POST["email"]) : strip_tags($_POST["email"]);
        $username = htmlspecialchars($_POST["username"]) ? htmlentities($_POST["username"]) : strip_tags($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]) ? htmlentities($_POST["password"]) : strip_tags($_POST["password"]);
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : strip_tags($_POST["nama"]);
        $this->konfig->RegisterAuth($email,$username,$password,$nama);
    }
}

use model\ModelToDoList;
class ToDoList {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new ModelToDoList($konfig);
    }

    public function Tables($query){
        $row = $this->konfig->table($query);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function membuat(){
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : strip_tags($_POST["nama"]);
        $jenis = htmlspecialchars($_POST["jenis_kegiatan"]) ? htmlentities($_POST["jenis_kegiatan"]) : strip_tags($_POST["jenis_kegiatan"]);
        $kegiatan = htmlspecialchars($_POST["nama_kegiatan"]) ? htmlentities($_POST["nama_kegiatan"]) : strip_tags($_POST["nama_kegiatan"]);
        $this->konfig->create($nama,$jenis,$kegiatan);
    }

    public function ubah(){
        $id = htmlspecialchars($_POST["id"]) ? htmlentities($_POST["id"]) : strip_tags($_POST["id"]);
        $nama = htmlspecialchars($_POST["nama"]) ? htmlentities($_POST["nama"]) : strip_tags($_POST["nama"]);
        $jenis = htmlspecialchars($_POST["jenis_kegiatan"]) ? htmlentities($_POST["jenis_kegiatan"]) : strip_tags($_POST["jenis_kegiatan"]);
        $kegiatan = htmlspecialchars($_POST["nama_kegiatan"]) ? htmlentities($_POST["nama_kegiatan"]) : strip_tags($_POST["nama_kegiatan"]);
        $this->konfig->update($nama,$jenis,$kegiatan,$id);
    }
    
    public function hapus(){
        $id = htmlspecialchars($_GET["id"]) ? htmlentities($_GET["id"]) : strip_tags($_GET["id"]);
        $this->konfig->delete($id);
    }
}

?>