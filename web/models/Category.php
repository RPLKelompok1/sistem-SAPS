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

    //Ambil semua nilai category
    public static function readCategory() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM `category` GROUP BY `judul`");

      foreach($req->fetchAll() as $post) {
        $list[] = new Category($post['id_category'], $post['judul'], $post['tingkatan'], $post['nilai']);
      }

      return $list;
    }

    //Ambil nilai tingkatan berdasarkan category
    public static function readTingkatan($judul) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM category WHERE judul = $judul");

      foreach($req->fetchAll() as $post) {
        $list[] = new Category($post['id_category'], $post['judul'], $post['tingkatan'], $post['nilai']);
      }
      return $list;
    }

    //Ambil jenis category berdasarkan id nya
    public static function readCategoryById($id_category) {
      $db = Db::getInstance();
      $req = $db->prepare('SELECT * FROM category WHERE id_category = :id_category');
      $req->execute(array('id_category' => $id_category));
      $post = $req->fetch();

      return new Category($post['id_category'], $post['judul'], $post['tingkatan'], $post['nilai']);
    }

  }
?>