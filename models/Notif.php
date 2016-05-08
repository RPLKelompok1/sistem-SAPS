<?php
  class Notif {
    public $id_notif;
    public $id_penerima;
    public $isi;
    public $tipe;
    public $waktu;

    public function __construct($id_notif, $id_penerima, $isi, $tipe, $waktu) {
      $this->id_notif    = $id_notif;
      $this->id_penerima = $id_penerima;
      $this->isi         = $isi;
      $this->tipe        = $tipe;
      $this->waktu       = $waktu;
    }

    //Ambil data notif berdasarkan id_penerimanya
    public static function read($nomor_induk) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM notif WHERE id_penerima = $nomor_induk ORDER BY waktu desc");

      foreach($req->fetchAll() as $post) {
        $list[] = new Notif($post['id_notif'], $post['id_penerima'], $post['isi'], $post['tipe'], $post['waktu']);
      }

      return $list;
    }

    /*
  1. Pendaftaran SAPS diterima
  2. Pendaftaran SAPS ditolak
  3. Comment 
  4. Pengajuan SAPS
    */

    //Buat notif baru
    public static function create($nomor_induk, $isi, $tipe) {
      $db = Db::getInstance();
      $req = $db->query("INSERT INTO `notif`( `id_penerima` , `isi` , `tipe`) VALUES ( '$nomor_induk' , '$isi' , '$tipe' )");
    }

    //Buat notif, untuk user yang telah memberikan komentar sebelumnya
    public static function createComment($nomor_induk,$id_sertifikat,$sertifikat_user) {
      $db = Db::getInstance();
      Notif::create($sertifikat_user , $id_sertifikat , '3' );
      $req = $db->query("SELECT * FROM sertifikat_comment WHERE id_user != $nomor_induk AND id_sertifikat = $id_sertifikat");

      foreach($req->fetchAll() as $post) {
        Notif::create( $post['id_user'] , $id_sertifikat , '3' );
      }
    }

    //Penghapusan notif
    public static function delete($id_notif) {
      $db = Db::getInstance();
      $req = $db->query("DELETE FROM `notif` WHERE id_notif = $id_notif");
    }

  }
?>