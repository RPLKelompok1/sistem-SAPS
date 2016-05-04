<?php
  class Notifikasi_Controller {

    public function ReqHalNotif() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();

      $nomor_induk = $_SESSION['nomor_induk'];
      $list_notif = Notif::read($nomor_induk);
      require_once('views/login_after/mynotif.php');

    }

    public function notif() {
      session_start();
      $controller_se = new Login_Controller();  
      $user=$controller_se->{ "cekSession" }();
      
      $nomor_induk = $_SESSION['nomor_induk'];
      $list_notif = Notif::mynotif($nomor_induk);
      require_once('views/login_after/mynotif.php');
    }

  }
?>