<?php
  class User {
    public $nomor_induk;
    public $password;
    public $nama;
    public $fakultas;
    public $jurusan;
    public $ttl;
    public $jenis_kelamin;
    public $status;

    public function __construct($nomor_induk, $password, $nama, $fakultas, $jurusan, $ttl, $jenis_kelamin, $status) {
      $this->nomor_induk    = $nomor_induk;
      $this->password       = $password;
      $this->nama           = $nama;
      $this->fakultas       = $fakultas;
      $this->jurusan        = $jurusan;
      $this->ttl            = $ttl;
      $this->jenis_kelamin  = $jenis_kelamin;
      $this->status         = $status;
    }

    public static function check_pass($nomor_induk) {
      $db = Db::getInstance();
      
      //Cek apakah nomor_induk adalah int
      //$nomor_induk = intval($nomor_induk);
      $req = $db->prepare('SELECT * FROM user WHERE nomor_induk = :nomor_induk');
      $req->execute(array('nomor_induk' => $nomor_induk));
      $post = $req->fetch();

      return new User($post['nomor_induk'], $post['password'], $post['nama'], $post['fakultas'], $post['jurusan'], $post['ttl'], $post['jenis_kelamin'], $post['status']);
    }

    //Ambil data user dengan nomor induknya
    public static function readUser($nomor_induk) {
      $db = Db::getInstance();
      
      $nomor_induk = intval($nomor_induk);
      $req = $db->prepare('SELECT * FROM user WHERE nomor_induk = :nomor_induk');
      $req->execute(array('nomor_induk' => $nomor_induk));
      $post = $req->fetch();

      return new User($post['nomor_induk'], $post['password'], $post['nama'], $post['fakultas'], $post['jurusan'], $post['ttl'], $post['jenis_kelamin'], $post['status']);
    }

    public static function notif() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM posts');

      foreach($req->fetchAll() as $post) {
        $list[] = new Post($post['id'], $post['author'], $post['content']);
      }

      return $list;
    }

  }
?>