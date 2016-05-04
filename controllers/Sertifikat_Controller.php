<?php
  class Sertifikat_Controller {

    public function ReqHalBeranda() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $sertifikat = Sertifikat::read();
      require_once('views/login_after/beranda2.php');
    }

    public function ReqHalUnggah() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $category=Category::readCategory();
      require_once('views/login_after/unggah_file.php');
    }

    public function ReqListSertifikat() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      if (isset($_SESSION['nomor_induk'])) {
        $nomor_induk = $_SESSION['nomor_induk'];
        $sertifikat = Sertifikat::mylist($nomor_induk);
        require_once('views/login_after/mylist.php');
      } else {
        echo"<script>alert('Anda belum login');</script><script>location.href='?controller=login&action=ReqHalLogin';</script>";      
      }
    }

    public function ReqHalKomen() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $id_sertifikat = $_GET['id'];
      $sertifikat = Sertifikat::readOne($id_sertifikat); 
      $sertifikat_comment = Sertifikat_comment::read($id_sertifikat);
      require_once('views/login_after/coment.php');
    }

    public function ReqUser($nomor_induk) {
      $user = User::readUser($nomor_induk);
      return $user;
    }

    public function UnggahFile() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk = $_SESSION['nomor_induk'];
      $keterangan = $_POST['keterangan'];
      $kategori = $_POST['kategori'];
      $tingkatan = $_POST['tingkatan'];        

      $fileType = $_FILES['file_input']['type'];

      if ($fileType == 'application/pdf'){
        echo "<script>alert('Unggah File Berhasil')</script>";
        Sertifikat::create($nomor_induk, $keterangan, $kategori, $tingkatan);
      } else {
        echo "<script>alert('Unggah File Tidak Berhasil')</script>";
      }
      require_once('views/login_after/unggah_file.php');
    }

    public function HapusFile() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk = $_SESSION['nomor_induk'];
      $id_sertifikat = $_GET['id'];
      Sertifikat::delete($id_sertifikat);
      $sertifikat = Sertifikat::mylist($nomor_induk);
      require_once('views/login_after/mylist.php');
    }

    public function Komen() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $id_sertifikat = $_GET['id'];
      $nomor_induk = $_SESSION['nomor_induk'];
      $isi = $_POST['isi'];
      Sertifikat_comment::create($id_sertifikat,$nomor_induk,$isi);
      $sertifikat = Sertifikat::readOne($id_sertifikat); 
      $sertifikat_comment = Sertifikat_comment::read($id_sertifikat);

      //buat notif
      //cek semua id di sertifikat
      //buat komen untuk semua id tersebut kecuali untuk yang ngomen
      //Notif::create($nomor_induk,$isi,"3");
      Notif::createComment($nomor_induk,$id_sertifikat);
//    public static function create($nomor_induk, $isi, $tipe) {
      require_once('views/login_after/coment.php');
    }

  }
?>