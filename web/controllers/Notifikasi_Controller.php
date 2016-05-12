<?php
  class Notifikasi_Controller {

    public function ReqHalNotif() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk = $_SESSION['nomor_induk'];
      $list_notif = Notif::read($nomor_induk);
      require_once('views/login_after/m_notif.php');
    }

    public function create($nomor_induk, $isi, $tipe) {
      require_once('models/Notif.php');    
      Notif::create($nomor_induk, $isi, $tipe);      
    }

    public function notif($nomor_induk,$id_sertifikat,$id_user) {
      require_once('models/Notif.php');    
      Notif::createComment($nomor_induk,$id_sertifikat,$id_user);      
    }

    public function delete($id_sertifikat) {
      require_once('models/Notif.php');
      Notif::delete($id_sertifikat);      
    }

  }
?>