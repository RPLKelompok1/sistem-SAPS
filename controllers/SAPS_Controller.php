<?php
  class SAPS_Controller {

    public function ReqHalPendaftaran() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

//      $sertifikat = Sertifikat::read();
        if ($_SESSION['status'] == 0 ) {
          require_once('views/login_after/pendaftaran.php');
        } else if(isset($_GET['id_pendaftaran']) && isset($_GET['id_pendaftar'])) {
          require_once('views/login_after/pendaftaran.php');          
        } else if(isset($_GET['id_pendaftaran'])) {
          //ambil nilai user dulu
          require_once('views/login_after/pendaftaran.php');          
        } else{
          $list_saps=Pendaftaran_SAPS::read();
          require_once('views/login_after/pendaftaran_data.php');          
        }
    }

    public function KalkulasiNilai() {
      session_start();
      require_once('views/login_after/unggah_file.php');
    }

    public function ConvertWord() {
      session_start();
      $nomor_induk = $_SESSION['nomor_induk'];
      $sertifikat = Sertifikat::mylist($nomor_induk);
      require_once('views/login_after/mylist.php');
    }

    //notif terbuat
    //Total nilai SAPS sekurang-kurangnya adalah 50, berasal dari sekurang-kurangnya 25% berasal dari Bidang penalaran, sekurang-kurangnya 45% berasal dari Bidang Minat dan Bakat dan sebanyak-banyaknya 20% berasal dari Pengabdian Masyarakat
    public function SubmitPendaftaran() {
      session_start();
      $nomor_induk 		= $_SESSION['nomor_induk'];
      $total_nilai		= $_POST['total_nilai'];
      Pendaftaran_SAPS::create($nomor_induk,$total_nilai);
      Notif::create('');
      //public static function create($nomor_induk, $isi, $tipe) {
      //$sertifikat = Sertifikat::readOne($id_sertifikat); 
      //$sertifikat_comment = Sertifikat_comment::read($id_sertifikat);
      require_once('views/login_after/pendaftaran.php');
    }

    public function UbahStatus() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();
      
      $nomor_induk 		= $_SESSION['nomor_induk'];
      $id_pendaftaran 	= $_GET['id_pendaftaran'];
      $status 	   		= $_GET['status'];
      Pendaftaran_SAPS::update($id_pendaftaran,$status);
      require_once('views/login_after/pendaftaran.php');
    }

  }
?>