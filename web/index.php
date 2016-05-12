<?php

	//1 berarti file connection.php ada
	if (file_exists("connection.php") == 1) {
	  require_once('connection.php');
	} else {
		echo "<script>location.href='../config.php';</script>\n";
	}

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'login';
    $action     = 'ReqHalLogin';
  }

  require_once('views/layout.php');
?>