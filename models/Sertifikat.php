<?php
  class Sertifikat {
    public $id_sertifikat;
    public $id_user;
    public $nama_file;
    public $keterangan;
    public $id_category;
    public $waktu;

    public function __construct($id_sertifikat, $id_user, $nama_file, $keterangan, $id_category, $waktu) {
      $this->id_sertifikat  = $id_sertifikat;
      $this->id_user        = $id_user;
      $this->nama_file      = $nama_file;
      $this->keterangan     = $keterangan;
      $this->id_category    = $id_category;
      $this->waktu          = $waktu;
    }

//$coment_query = mysql_query("SELECT * FROM posting_coment WHERE id_posting = $id");
  //              while($coment = mysql_fetch_array($coment_query))


    public static function read() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM sertifikat ORDER BY id_sertifikat DESC');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $post) {
        $list[] = new Sertifikat($post['id_sertifikat'], $post['id_user'], $post['nama_file'], $post['keterangan'], $post['id_category'], $post['waktu']);
      }

      return $list;
    }

    public static function readOne($id) {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query("SELECT * FROM `sertifikat` WHERE `id_sertifikat` = $id");
      foreach($req->fetchAll() as $post) {
        $list[] = new Sertifikat($post['id_sertifikat'], $post['id_user'],  $post['nama_file'], $post['keterangan'], $post['id_category'], $post['waktu']);
      }

      return $list;
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

    public static function create($nomor_induk, $ket, $kategori, $tingkatan) {
      $db = Db::getInstance();

      //cari id_kategori dulu
        

      //upload file
        $fileName = $_FILES['file_input']['name'];    // membaca nama 
        $key = '1';
            for ($i = 0; $i < 3 ; $i++){
                $key .= rand(0,9);
            }
        $uploaddir = 'sertifikat/';
        $fileName = $nomor_induk .'_' . $key.'.pdf';
        $tmpName  = $_FILES['file_input']['tmp_name'];    // nama file temporary yang akan disimpan di server
        $fileSize = $_FILES['file_input']['size'];        // membaca ukuran file yang diupload
        $fileType = $_FILES['file_input']['type'];    // membaca jenis file yang diupload

        //'application/pdf'
        //if ($fileType == 'application/pdf'){
            $uploadfile = $uploaddir . $fileName;       // menggabungkan nama folder dan nama file      
            move_uploaded_file($tmpName, $uploadfile); 
            //baru insert
            $req = $db->query("INSERT INTO `sertifikat`( `id_user` , `nama_file` , `keterangan` , `id_category`) VALUES ( '$nomor_induk' , '$fileName' , '$ket' , '1' )");

//        }

      //INSERT INTO `sertifikat_comment`(`id_comment`, `id_sertifikat`, `id_user`, `isi`, `waktu`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])

    }

    public static function delete($id_sertifikat) {
      $db = Db::getInstance();
      $req = $db->query("DELETE FROM `sertifikat` WHERE id_sertifikat = $id_sertifikat");
    }

  }
?>