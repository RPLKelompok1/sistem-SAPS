<?php
  class Pendaftaran_SAPS {
    public $id_pendaftaran;
    public $id_pendaftar;
    public $id_penilai;
    public $total_nilai;
    public $status;
    public $waktu;

    public function __construct($id_pendaftaran,$id_pendaftar, $id_penilai,  $total_nilai, $status, $waktu) {
      $this->id_pendaftaran  = $id_pendaftaran;
      $this->id_pendaftar    = $id_pendaftar;
      $this->id_penilai      = $id_penilai;
      $this->total_nilai     = $total_nilai;
      $this->status          = $status;
      $this->waktu           = $waktu;
    }
    /*
    status: 0->belum diferivikasi
      1->diterima
      2->ditolak*/
    public static function create($nomor_induk,$total_nilai) {
      $db = Db::getInstance();
      $req = $db->query("INSERT INTO `pendaftaran_saps`( `id_pendaftar` , `total_nilai` , `status`) VALUES ( '$nomor_induk' , '$total_nilai' , '0' )");
    }

    public static function update($id_pendaftaran,$status) {
      $db = Db::getInstance();
      $req = $db->query("UPDATE `pendaftaran_saps` SET `status` = $status WHERE id_pendaftaran = $id_pendaftaran");
      //UPDATE `pendaftaran_saps` SET `id_pendaftaran`=[value-1],`id_pendaftar`=[value-2],`id_penilai`=[value-3],`total_nilai`=[value-4],`status`=[value-5],`waktu`=[value-6] WHERE 1
    }

    public static function read() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM `pendaftaran_saps` WHERE `status` = 0');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Pendaftaran_SAPS($post['id_pendaftaran'],$post['id_pendaftar'], $post['id_penilai'], $post['total_nilai'], $post['status'], $post['waktu']);
      }

      return $list;
    }

  }
?>