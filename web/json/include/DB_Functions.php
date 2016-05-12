<?php

class DB_Functions {
    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }
    
	public function getHistory($judul) {

        $sql = "SELECT * FROM category WHERE judul = ".$judul." ORDER BY id_category ASC";
        $result = $this->conn->query($sql);

        return $result;
    }

}

?>