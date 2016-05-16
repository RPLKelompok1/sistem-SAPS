<?php
  class Sertifikat_Controller {

    public function ReqHalBeranda() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      //Ambil semua sertifikat di database
      $sertifikat = Sertifikat::read();
      require_once('views/login_after/m_beranda.php');
    }

    public function ReqHalUnggah() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      //Ambil semua category untuk pengisian nilai
      $category=Category::readCategory();
      require_once('views/login_after/m_unggahFile.php');
    }

    public function ReqHalKomen() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      //Ambil nilai satu sertifikat, dan semua komentar pada sertifikat tersebut
      $id_sertifikat = $_GET['id'];
      $sertifikat = Sertifikat::readOne($id_sertifikat); 
      $sertifikat_comment = Sertifikat_comment::read($id_sertifikat);
      require_once('views/login_after/m_sub_coment.php');
    }

    public function ReqListSertifikat() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      //Ambil semua sertifikat untuk user yang sedang login
      $nomor_induk = $_SESSION['nomor_induk'];
      $sertifikat = Sertifikat::mylist($nomor_induk);
      require_once('views/login_after/m_mylist.php');
    }

    public function UnggahFile() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk = $_SESSION['nomor_induk'];
      $keterangan = $_POST['keterangan'];
      $kategori = $_POST['kategori'];
      $tingkatan = $_POST['tingkatan'];        

      //Cek tipe data file yang diupload
      $fileType = $_FILES['file_input']['type'];
      if ($fileType == 'application/pdf'){
        echo "<script>alert('Unggah File Berhasil')</script>";
        Sertifikat::create($nomor_induk, $keterangan, $kategori, $tingkatan);
      } else {
        echo "<script>alert('Unggah File Tidak Berhasil, Unggah file dengan format PDF')</script>";
      }

      //Ambil semua category untuk pengisian nilai
      $category=Category::readCategory();
      require_once('views/login_after/m_unggahFile.php');
    }

    public function HapusFile() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      //Hapus file
      $nomor_induk = $_SESSION['nomor_induk'];
      $id_sertifikat = $_GET['id'];
      $file = Sertifikat::readOne($id_sertifikat);
      unlink("sertifikat/$file->nama_file");
      Sertifikat::delete($id_sertifikat);

      //Hapus Notif
      require_once('controllers/Notifikasi_controller.php');
      $controller_notif = new Notifikasi_Controller();  
      $controller_notif->{ "delete" }($id_sertifikat);

      //Menampilkan tampilan list sertifkat user yang sedang login
      $sertifikat = Sertifikat::mylist($nomor_induk);
      require_once('views/login_after/m_mylist.php');
    }

    public function Komen() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $id_sertifikat = $_GET['id'];
      $nomor_induk = $_SESSION['nomor_induk'];
      $isi = $_POST['isi'];
      Sertifikat_comment::create($id_sertifikat,$nomor_induk,$isi);
      $sertifikat = Sertifikat::readOne($id_sertifikat); 
      $sertifikat_comment = Sertifikat_comment::read($id_sertifikat);

      //cek semua id di sertifikat
      //buat notif untuk semua id tersebut kecuali untuk yang ngomen
      require_once('controllers/Notifikasi_controller.php');
      $controller_notif = new Notifikasi_Controller();  
      $controller_notif->{ "notif" }($nomor_induk,$id_sertifikat,$sertifikat->id_user);  

      require_once('views/login_after/m_sub_coment.php');
    }

  }
?>