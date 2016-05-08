<?php
  function call($controller, $action) {
    require_once('controllers/Login_controller.php');
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'login':
        require_once('models/User.php');
        require_once('models/Sertifikat.php');
        $controller = new Login_Controller();
      break;
      case 'Sertifikat':
        require_once('models/User.php');
        require_once('models/Sertifikat.php');
        require_once('models/Category.php');
        require_once('models/Sertifikat_comment.php');
        require_once('models/Notif.php');
        $controller = new Sertifikat_Controller();      
        break;
      case 'Notifikasi':
        require_once('models/Notif.php');
        $controller = new Notifikasi_Controller();      
        break;
      case 'SAPS':
        require_once('models/User.php');
        require_once('models/Sertifikat.php');
        require_once('models/Pendaftaran_SAPS.php');
        require_once('models/Notif.php');
        require_once('models/Category.php');
        require_once('controllers/Sertifikat_controller.php');
        $controller = new SAPS_Controller();      
        break;
    }

    $controller->{ $action }();
  }

  call($controller, $action);
?>