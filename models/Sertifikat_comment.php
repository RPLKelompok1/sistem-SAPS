<?php
  class Sertifikat_comment {
    public $id_comment;
    public $id_sertifikat;
    public $id_user;
    public $isi;
    public $waktu;

    public function __construct($id_comment, $id_sertifikat, $id_user, $isi, $waktu) {
      $this->id_comment     = $id_comment;
      $this->id_sertifikat  = $id_sertifikat;
      $this->id_user        = $id_user;
      $this->isi            = $isi;
      $this->waktu          = $waktu;
    }

    public static function read($id) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM `sertifikat_comment` WHERE `id_sertifikat` = $id");
      foreach($req->fetchAll() as $post) {
        $list[] = new Sertifikat_comment($post['id_comment'],$post['id_sertifikat'], $post['id_user'], $post['isi'], $post['waktu']);
      }

      return $list;
    }

    public static function create($id_sertifikat,$nomor_induk,$isi) {
      $db = Db::getInstance();
//      $req = $db->query("SELECT * FROM sertifikat WHERE id_user = $nomor_induk");
      $req = $db->query("INSERT INTO `sertifikat_comment`( `id_sertifikat` , `id_user` , `isi`) VALUES ( '$id_sertifikat' , '$nomor_induk' , '$isi' )");
      //INSERT INTO `sertifikat_comment`(`id_comment`, `id_sertifikat`, `id_user`, `isi`, `waktu`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])

      //$coment_query = mysql_query("SELECT * FROM posting_coment WHERE id_posting = $id");

    }

    public static function mylist($nomor_induk) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM sertifikat WHERE id_user = $nomor_induk");

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Sertifikat($post['id_sertifikat'], $post['id_user'], $post['nama_file'], $post['keterangan'], $post['id_category'], $post['waktu']);
      }

      return $list;
    }

  }
?>