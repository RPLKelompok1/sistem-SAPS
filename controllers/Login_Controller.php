<?php
  class Login_Controller {
    public function ReqHalLogin() {
      require_once('views/login/login.php');
    }

    public function logout() {
      session_start();
      unset($_SESSION['nomor_induk']);
      unset($_SESSION['nama']);
      unset($_SESSION['fakultas']);
      unset($_SESSION['ttl']);
      unset($_SESSION['status']);
      require_once('views/login/login.php');
    }

    public function cekLogin() {
      session_start();
      $nomor_induk    = $_POST['nomor_induk'];
      $password       = $_POST['password'];
      $user = User::check_pass($nomor_induk);
      if ($user->password == $password) {
        $_SESSION['nomor_induk'] = $nomor_induk;
        $_SESSION['nama'] = $user->nama;
        $_SESSION['fakultas'] = $user->fakultas;
        $_SESSION['ttl'] = $user->ttl;
        $_SESSION['status'] = $user->status;
        $sertifikat = Sertifikat::read();
        echo"<script>location.href='?controller=Sertifikat&action=ReqHalBeranda';</script>";      
      } else {
        echo"<script>alert('Username atau Password salah');window.history.go(-1);</script>";
      }
    }
    /*  0. mahasiswa
    1. dosen penilai
    2. admin
    */
    public function cekSession() {
      session_start();?>
      <link href="views/css/bootstrap.min.css" rel="stylesheet">
      <link href="views/css/portfolio-item.css" rel="stylesheet">
      <?php
      if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 0 ) {
          include "menu/menu_mahasiswa.php";
        } else if ($_SESSION['status'] == 1 ) {
          include "menu/menu_dosen.php";
        } else {
          include "menu/menu_admin.php";
        }
      } else {
        echo"<script>alert('Anda belum login');</script><script>location.href='?controller=login&action=ReqHalLogin';</script>";
      }
    }

    public function ReqUser($nomor_induk) {
      //Ambil nilai user
      $user = User::readUser($nomor_induk);
      return $user;
    }
    
  }
?>