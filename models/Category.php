<?php
  class Category {
    public $id_category;
    public $judul;
    public $tingkatan;
    public $nilai;

    public function __construct($id_category, $judul, $tingkatan, $nilai) {
      $this->id_category    = $id_category;
      $this->judul          = $judul;
      $this->tingkatan      = $tingkatan;
      $this->nilai          = $nilai;
    }

    public static function readCategory() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM `category` GROUP BY `judul`");

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Category($post['id_category'], $post['judul'], $post['tingkatan'], $post['nilai']);
      }

      return $list;
    }

    public static function readTingkatan($judul) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM category WHERE judul = $judul");

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Category($post['id_category'], $post['judul'], $post['tingkatan'], $post['nilai']);
      }
      return $list;
    }

  }
?>