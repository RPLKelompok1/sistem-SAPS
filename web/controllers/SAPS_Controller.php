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
          $sertifikat_j1 = Sertifikat::mylist_pendaftaran($nomor_induk,"1");
          $sertifikat_j2 = Sertifikat::mylist_pendaftaran($nomor_induk,"2");
          $sertifikat_j3 = Sertifikat::mylist_pendaftaran($nomor_induk,"3");
          require_once('views/login_after/m_daftarSAPS.php');
        } else if ($_SESSION['status'] == 1) {
          if(isset($_GET['id_pendaftaran']) && isset($_GET['id_pendaftar'])) {
            $nomor_induk = $_GET['id_pendaftar'];
            $pendaftar=$controller_se->{ "ReqUser" }($nomor_induk);
            $sertifikat_j1 = Sertifikat::mylist_pendaftaran($nomor_induk,"1");
            $sertifikat_j2 = Sertifikat::mylist_pendaftaran($nomor_induk,"2");
            $sertifikat_j3 = Sertifikat::mylist_pendaftaran($nomor_induk,"3");
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
            $sertifikat_j1 = Sertifikat::mylist_pendaftaran($nomor_induk,"1");
            $sertifikat_j2 = Sertifikat::mylist_pendaftaran($nomor_induk,"2");
            $sertifikat_j3 = Sertifikat::mylist_pendaftaran($nomor_induk,"3");
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


    }

    public function ReqCategory($id_category) {
      $Category = Category::readCategoryById($id_category);
      return $Category;
    }

    public function ConvertWord() {

    }

    //notif terbuat
    //Total nilai SAPS sekurang-kurangnya adalah 50, 
    //Berasal dari sekurang-kurangnya 25% berasal dari Bidang penalaran, sekurang-kurangnya 45% berasal dari Bidang Minat dan Bakat dan sebanyak-banyaknya 20% berasal dari Pengabdian Masyarakat
    public function SubmitPendaftaran() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk 		= $_SESSION['nomor_induk'];
      $total_nilai		= $_POST['total_nilai'];

      //Kalkulasi
        $sertifikat_j1 = Sertifikat::mylist_pendaftaran($nomor_induk,"1");
        $sertifikat_j2 = Sertifikat::mylist_pendaftaran($nomor_induk,"2");
        $sertifikat_j3 = Sertifikat::mylist_pendaftaran($nomor_induk,"3"); 
        $total_nilai_j1 = 0;
        $total_nilai_j2 = 0;
        $total_nilai_j3 = 0;
        foreach($sertifikat_j1 as $post) { 
          $hasil=SAPS_Controller::ReqCategory($post->id_category);
          $total_nilai_j1 += $hasil->nilai; 
        } 
        foreach($sertifikat_j2 as $post) { 
          $hasil=SAPS_Controller::ReqCategory($post->id_category);
          $total_nilai_j2 += $hasil->nilai; 
        } 
        foreach($sertifikat_j3 as $post) { 
          $hasil=SAPS_Controller::ReqCategory($post->id_category);
          $total_nilai_j3 += $hasil->nilai; 
        } 
        $total_nilai = $total_nilai_j1 + $total_nilai_j2 + $total_nilai_j3;
        if ( $total_nilai >= 50 /*&& 0.25 * $total_nilai <= $total_nilai_j1 && 0.45 * $total_nilai <= $total_nilai_j2  && 0.2 * $total_nilai <= $total_nilai_j3*/ ) {

          //Pendaftaran sukses  
            Pendaftaran_SAPS::create($nomor_induk,$total_nilai);

          //Pembuatan Notif untuk semua dosen penilai
            $dosen = User::readDosen();
            require_once('controllers/Notifikasi_controller.php');
            $controller_notif = new Notifikasi_Controller();  
            foreach($dosen as $post) { 
              $controller_notif->{ "create" }($post->nomor_induk,"","4");
            }
          //request halaman pendaftaran
            echo "<script>alert('Pendaftaran SAPS Berhasil')</script>";
        } else {
          echo "<script>alert('Pendaftaran SAPS Gagal Dilakukan, Nilai anda tidak mencukupi syarat')</script>";          
        }

        $nomor_induk = $_SESSION['nomor_induk'];
        $sertifikat_j1 = Sertifikat::mylist_pendaftaran($nomor_induk,"1");
        $sertifikat_j2 = Sertifikat::mylist_pendaftaran($nomor_induk,"2");
        $sertifikat_j3 = Sertifikat::mylist_pendaftaran($nomor_induk,"3");
        require_once('views/login_after/m_daftarSAPS.php');
    }

    //fungsi tombol lengkap atau tidak untuk admin
    //ubah status dan buat notifnya
    public function UbahStatus() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();
      
      //Update status pendaftaran
        $id_pendaftaran = $_POST['id'];
        $isi            = $_POST['isi'];
        $status         = $_POST['kelengkapan'];
        $bp             = $_POST['bp'];
        if ($status == "Tidak Lengkap") {
          $status = "2";
        } else { 
          $status = "1"; 
        }
        
        Pendaftaran_SAPS::update($id_pendaftaran,$isi,$status);
        echo "<script>alert('Status pendaftaran berhasil diubah')</script>";

      //Buat notif
      require_once('controllers/Notifikasi_controller.php');
      $controller_notif = new Notifikasi_Controller();  
      $controller_notif->{ "create" }($bp,$isi,$status); 

      echo "<script>location.href='?controller=SAPS&action=ReqHalPendaftaran';</script>\n";
    }

  }
?>