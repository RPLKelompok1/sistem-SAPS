<?php
  class SAPS_Controller {

    public function ReqHalPendaftaran() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

//      $sertifikat = Sertifikat::read();
        // 0 -> mahasiswa
        // 1 -> dosen
        // 2 -> admin
        if ($_SESSION['status'] == 0) {
          //bagi jadi 3 bagian panjang jenis sertifikat
          $nomor_induk = $_SESSION['nomor_induk'];
          $sertifikat_j1 = Sertifikat::mylist($nomor_induk);
          $sertifikat_j2 = Sertifikat::mylist($nomor_induk);
          $sertifikat_j3 = Sertifikat::mylist($nomor_induk);
          require_once('views/login_after/m_daftarSAPS.php');
        } else if ($_SESSION['status'] == 1) {
          if(isset($_GET['id_pendaftaran']) && isset($_GET['id_pendaftar'])) {
            $nomor_induk = $_GET['id_pendaftar'];
            $pendaftar=$controller_se->{ "ReqUser" }($nomor_induk);
            $sertifikat_j1 = Sertifikat::mylist($nomor_induk);
            $sertifikat_j2 = Sertifikat::mylist($nomor_induk);
            $sertifikat_j3 = Sertifikat::mylist($nomor_induk);
            require_once('views/login_after/m_daftarSAPS_penilaian.php');          
          } else if(isset($_GET['id_pendaftaran'])) {
            //ambil nilai user dulu
            require_once('views/login_after/m_daftarSAPS.php');          
          } else {
            $list_saps=Pendaftaran_SAPS::read();
            require_once('views/login_after/m_daftarSAPS_data.php');          
          }
        } else{
          if(isset($_GET['id_pendaftaran']) && isset($_GET['id_pendaftar'])) {
            $nomor_induk = $_GET['id_pendaftar'];
            $pendaftar=$controller_se->{ "ReqUser" }($nomor_induk);
            $sertifikat_j1 = Sertifikat::mylist($nomor_induk);
            $sertifikat_j2 = Sertifikat::mylist($nomor_induk);
            $sertifikat_j3 = Sertifikat::mylist($nomor_induk);
            require_once('views/login_after/m_daftarSAPS_penilaian.php');          
          }else{
            $list_saps=Pendaftaran_SAPS::read();
            require_once('views/login_after/m_daftarSAPS_data.php');            
          }
        }

    }

    public function KalkulasiNilai() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk = $_SESSION['nomor_induk'];
      $sertifikat = Sertifikat::mylist($nomor_induk);
      require_once('views/login_after/unggah_file.php');
    }

    public function ReqCategory($id_category) {
      $Category = Category::readCategoryById($id_category);
      return $Category;
    }

    public function ConvertWord() {

    }

    //notif terbuat
    //Total nilai SAPS sekurang-kurangnya adalah 50, berasal dari sekurang-kurangnya 25% berasal dari Bidang penalaran, sekurang-kurangnya 45% berasal dari Bidang Minat dan Bakat dan sebanyak-banyaknya 20% berasal dari Pengabdian Masyarakat
    public function SubmitPendaftaran() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk 		= $_SESSION['nomor_induk'];
      $total_nilai		= $_POST['total_nilai'];
      Pendaftaran_SAPS::create($nomor_induk,$total_nilai);
      //Notif::create('');
      //public static function create($nomor_induk, $isi, $tipe) {
      //$sertifikat = Sertifikat::readOne($id_sertifikat); 
      //$sertifikat_comment = Sertifikat_comment::read($id_sertifikat);
      //require_once('views/login_after/pendaftaran.php');
      SAPS_Controller::ReqHalPendaftaran();
    }

    //fungsi tombol lengkap atau tidak untuk admin
    //ubah status dan buat notifnya
    public function UbahStatus() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();
      
      $nomor_induk 		= $_SESSION['nomor_induk'];
      $id_pendaftaran = $_GET['id_pendaftaran'];
      $status 	   		= $_GET['status'];
      Pendaftaran_SAPS::update($id_pendaftaran,$status);
      require_once('views/login_after/m_daftarSAPS.php');
    }

  }
?>