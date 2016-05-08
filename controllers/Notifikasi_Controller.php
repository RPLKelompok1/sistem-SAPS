<?php
  class Notifikasi_Controller {

    public function ReqHalNotif() {
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk = $_SESSION['nomor_induk'];
      $list_notif = Notif::read($nomor_induk);
      require_once('views/login_after/m_notif.php');
    }

    public function notif() {
      
    }

  }
?>