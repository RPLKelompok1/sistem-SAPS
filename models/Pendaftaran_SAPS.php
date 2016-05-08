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

    /*status: 
      0->belum diferivikasi
      1->diterima
      2->ditolak*/

    //Buat notif untuk dosen, Tambahkan data pendaftaran SAPS
    public static function create($nomor_induk,$total_nilai) {
      $db = Db::getInstance();
      $req = $db->query("INSERT INTO `pendaftaran_saps`( `id_pendaftar` , `total_nilai` , `status`) VALUES ( '$nomor_induk' , '$total_nilai' , '0' )");
    }

    //Update data lengkap atau tidaknya pendaftaran SAPS
    public static function update($id_pendaftaran,$status) {
      $db = Db::getInstance();
      $req = $db->query("UPDATE `pendaftaran_saps` SET `status` = $status WHERE id_pendaftaran = $id_pendaftaran");
    }

    //Ambil data sertifikat yang statusnya diterima atau tidaknya masih belum ditentukan
    public static function read() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM `pendaftaran_saps` WHERE `status` = 0');

      foreach($req->fetchAll() as $post) {
        $list[] = new Pendaftaran_SAPS($post['id_pendaftaran'],$post['id_pendaftar'], $post['id_penilai'], $post['total_nilai'], $post['status'], $post['waktu']);
      }

      return $list;
    }

  }
?>