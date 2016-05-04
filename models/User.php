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
      // we make sure $id is an integer
      $nomor_induk = intval($nomor_induk);
      $req = $db->prepare('SELECT * FROM user WHERE nomor_induk = :nomor_induk');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('nomor_induk' => $nomor_induk));
      $post = $req->fetch();

      return new User($post['nomor_induk'], $post['password'], $post['nama'], $post['fakultas'], $post['jurusan'], $post['ttl'], $post['jenis_kelamin'], $post['status']);
    }

    public static function readUser($nomor_induk) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $nomor_induk = intval($nomor_induk);
      $req = $db->prepare('SELECT * FROM user WHERE nomor_induk = :nomor_induk');
      $req->execute(array('nomor_induk' => $nomor_induk));
      $post = $req->fetch();

      return new User($post['nomor_induk'], $post['password'], $post['nama'], $post['fakultas'], $post['jurusan'], $post['ttl'], $post['jenis_kelamin'], $post['status']);
    }

    /*public static function check_pass($nomor_induk,$password) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $nomor_induk = intval($nomor_induk);
      $password = intval($password);
      $req = $db->prepare('SELECT * FROM user WHERE nomor_induk = :nomor_induk AND password =:password ');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('nomor_induk' => $nomor_induk , 'password' => $password));
      $post = $req->fetch();

      return new User($post['nomor_induk'], $post['nama'], $post['fakultas'], $post['jurusan'], $post['ttl'], $post['jenis_kelamin'], $post['status']);
    }*/

    public static function notif() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM posts');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Post($post['id'], $post['author'], $post['content']);
      }

      return $list;
    }

  }
?>