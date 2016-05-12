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

    //Ambil semua comment berdasarkan id_sertifikat
    public static function read($id) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM `sertifikat_comment` WHERE `id_sertifikat` = $id");

      foreach($req->fetchAll() as $post) {
        $list[] = new Sertifikat_comment($post['id_comment'],$post['id_sertifikat'], $post['id_user'], $post['isi'], $post['waktu']);
      }

      return $list;
    }

    //Insert comment
    public static function create($id_sertifikat,$nomor_induk,$isi) {
      $db = Db::getInstance();
      $req = $db->query("INSERT INTO `sertifikat_comment`( `id_sertifikat` , `id_user` , `isi`) VALUES ( '$id_sertifikat' , '$nomor_induk' , '$isi' )");
    }

  }
?>