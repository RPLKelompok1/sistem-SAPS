<?php

	$localhost="localhost";
	$dbname=$_POST['dbname'];
	$username=$_POST['username'];
	$pass=$_POST['pass'];
	$isi_file = '
	<?php
	  class Db {
	    private static $instance = NULL;

	    private function __construct() {}

	    private function __clone() {}

	    public static function getInstance() {
	      if (!isset(self::$instance)) {
	        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	        self::$instance = new PDO("mysql:host='.$localhost.';dbname='.$dbname.'", "'.$username.'", "'.$pass.'", $pdo_options);
	      }
	      return self::$instance;
	    }
	  }
	?>';

	//BUAT DATABASE
	// Create connection
	$conn = new mysqli($localhost, $username, $pass);
	// Check connection
	if ($conn->connect_error) {
	    //die("Connection failed: " . $conn->connect_error);
	    echo "<script>alert('Username atau Password salah')</script>";
		echo "<script>location.href='config.php';</script>\n";
	} 

	// Create database
	$sql = "CREATE DATABASE $dbname";
	if ($conn->query($sql) === TRUE) {
		echo "<script>alert('Database berhasil dibuat');</script>";
	} else {
	    echo "Error creating database: " . $conn->error;
	}

	$conn->close();

	// BUAT TABEL
	// Create connection
	$conn = new mysqli($localhost, $username, $pass, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	// sql to create table
	$sql = "CREATE TABLE IF NOT EXISTS `category` (
	`id_category` int(11) PRIMARY KEY AUTO_INCREMENT,
	  `judul` varchar(100) DEFAULT NULL,
	  `tingkatan` varchar(100) DEFAULT NULL,
	  `nilai` int(11) DEFAULT NULL);";

	$sql1 = "CREATE TABLE IF NOT EXISTS `notif` (
	`id_notif` int(11) PRIMARY KEY AUTO_INCREMENT,
	  `id_penerima` varchar(30) DEFAULT NULL,
	  `isi` varchar(100) DEFAULT NULL,
	  `tipe` varchar(30) DEFAULT NULL,
	  `waktu` datetime DEFAULT CURRENT_TIMESTAMP);";

	$sql2 = "CREATE TABLE IF NOT EXISTS `pendaftaran_saps` (
	`id_pendaftaran` int(11) PRIMARY KEY AUTO_INCREMENT,
	  `id_pendaftar` varchar(30) DEFAULT NULL,
	  `id_penilai` varchar(30) DEFAULT NULL,
	  `komentar` varchar(400) NOT NULL,
	  `total_nilai` int(11) DEFAULT NULL,
	  `status` varchar(30) DEFAULT NULL,
	  `waktu` datetime DEFAULT CURRENT_TIMESTAMP);";

	$sql3 = "CREATE TABLE IF NOT EXISTS `sertifikat` (
	`id_sertifikat` int(11) PRIMARY KEY AUTO_INCREMENT,
	  `id_user` varchar(30) DEFAULT NULL,
	  `nama_file` varchar(100) DEFAULT NULL,
	  `keterangan` varchar(300) DEFAULT NULL,
	  `id_category` int(11) DEFAULT NULL,
	  `waktu` datetime DEFAULT CURRENT_TIMESTAMP);";

	$sql4 = "CREATE TABLE IF NOT EXISTS `sertifikat_comment` (
	`id_comment` int(11) PRIMARY KEY AUTO_INCREMENT,
	  `id_sertifikat` int(11) DEFAULT NULL,
	  `id_user` int(11) DEFAULT NULL,
	  `isi` varchar(300) DEFAULT NULL,
	  `waktu` datetime DEFAULT CURRENT_TIMESTAMP);";

	$sql5 = "CREATE TABLE IF NOT EXISTS `user` (
	  `nomor_induk` varchar(30) PRIMARY KEY,
	  `password` varchar(40) DEFAULT NULL,
	  `nama` varchar(100) DEFAULT NULL,
	  `fakultas` varchar(50) DEFAULT NULL,
	  `jurusan` varchar(50) DEFAULT NULL,
	  `ttl` date DEFAULT NULL,
	  `jenis_kelamin` varchar(20) DEFAULT NULL,
	  `status` varchar(1) DEFAULT NULL);";

	if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE && $conn->query($sql5) === TRUE) {

		//Ubah index
		$conn->query("ALTER TABLE `notif` ADD KEY `id_penerima` (`id_penerima`), ADD KEY `id_penerima_2` (`id_penerima`);");
		$conn->query("ALTER TABLE `pendaftaran_saps` ADD KEY `id_pendaftar` (`id_pendaftar`), ADD KEY `id_penilai` (`id_penilai`);");
		$conn->query("ALTER TABLE `sertifikat` ADD KEY `id_user` (`id_user`), ADD KEY `id_category` (`id_category`);");
		$conn->query("ALTER TABLE `sertifikat_comment` ADD KEY `id_sertifikat` (`id_sertifikat`), ADD KEY `id_user` (`id_user`);");

		//Foreign Key
		$conn->query("ALTER TABLE `notif` ADD CONSTRAINT `notif_ibfk_1` FOREIGN KEY (`id_penerima`) REFERENCES `user` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE;");
		$conn->query("ALTER TABLE `pendaftaran_saps` ADD CONSTRAINT `pendaftaran_saps_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `user` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE;");
		$conn->query("ALTER TABLE `sertifikat` ADD CONSTRAINT `sertifikat_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `user` (`nomor_induk`) ON DELETE CASCADE ON UPDATE CASCADE, ADD CONSTRAINT `sertifikat_ibfk_4` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;");
		$conn->query("ALTER TABLE `sertifikat_comment` ADD CONSTRAINT `sertifikat_comment_ibfk_1` FOREIGN KEY (`id_sertifikat`) REFERENCES `sertifikat` (`id_sertifikat`) ON DELETE CASCADE ON UPDATE CASCADE;");


		//Isi data category
		$conn->query(" 
		INSERT INTO `category` (`id_category`, `judul`, `tingkatan`, `nilai`) VALUES
		(1, 'Menulis karya ilmiah dalam majalah ilmiah', 'internasional', 40),
		(2, 'Menulis karya ilmiah dalam majalah ilmiah', 'Nasional', 30),
		(3, 'Menulis karya ilmiah dalam majalah ilmiah', 'Regional', 20),
		(4, 'Menulis karya ilmiah dalam majalah ilmiah', 'Universitas', 15),
		(5, 'Menulis karya ilmiah dalam majalah ilmiah', 'Fakultas', 10),
		(6, 'Menulis karya ilmiah dalam majalah ilmiah', 'Jurusan', 5),
		(7, 'Menulis karya ilmiah dalam koran/majalah populer/umum', 'Internasional', 30),
		(8, 'Menulis karya ilmiah dalam koran/majalah populer/umum', 'Nasional', 20),
		(9, 'Menulis karya ilmiah dalam koran/majalah populer/umum', 'Lokal', 10),
		(10, 'Menulis karya ilmiah dalam bentuk buku', 'Sebagai penulis', 40),
		(11, 'Menulis karya ilmiah dalam bentuk buku', 'Sebagai penulis artikel', 30),
		(12, 'Menulis karya ilmiah dalam bentuk buku', 'Sebagai editor', 20),
		(13, 'Mengikuti lomba karya ilmiah', 'Internasional', 40),
		(14, 'Mengikuti lomba karya ilmiah', 'Nasional', 25),
		(15, 'Mengikuti lomba karya ilmiah', 'Regional', 15),
		(16, 'Mengikuti lomba karya ilmiah', 'Universitas', 10),
		(17, 'Mengikuti lomba karya ilmiah', 'Fakultas', 5),
		(18, 'Mengikuti lomba karya ilmiah', 'Jurusan', 3),
		(19, 'Mendapatkan prestasi pada pertemuan/perlombaan ilmiah', 'Internasional', 60),
		(20, 'Mendapatkan prestasi pada pertemuan/perlombaan ilmiah', 'Nasional', 40),
		(21, 'Mendapatkan prestasi pada pertemuan/perlombaan ilmiah', 'Regional', 30),
		(22, 'Mendapatkan prestasi pada pertemuan/perlombaan ilmiah', 'Universitas', 25),
		(23, 'Mendapatkan prestasi pada pertemuan/perlombaan ilmiah', 'Fakultas', 15),
		(24, 'Mendapatkan prestasi pada pertemuan/perlombaan ilmiah', 'Jurusan', 10),
		(25, 'Mengikuti seminar ilmiah sebagai pemakalah', 'Internasional', 40),
		(26, 'Mengikuti seminar ilmiah sebagai pemakalah', 'Nasional', 30),
		(27, 'Mengikuti seminar ilmiah sebagai pemakalah', 'Regional', 20),
		(28, 'Mengikuti seminar ilmiah sebagai pemakalah', 'Universitas', 15),
		(29, 'Mengikuti seminar ilmiah sebagai pemakalah', 'Fakultas', 10),
		(30, 'Mengikuti seminar ilmiah sebagai pemakalah', 'Jurusan', 5),
		(31, 'Mengikuti seminar ilmiah sebagai peserta', 'Internasional', 20),
		(32, 'Mengikuti seminar ilmiah sebagai peserta', 'Nasional', 15),
		(33, 'Mengikuti seminar ilmiah sebagai peserta', 'Regional', 10),
		(34, 'Mengikuti seminar ilmiah sebagai peserta', 'Universitas', 5),
		(35, 'Mengikuti seminar ilmiah sebagai peserta', 'Fakultas', 3),
		(36, 'Mengikuti seminar ilmiah sebagai peserta', 'Jurusan', 2),
		(37, 'Menampilkan poster pada pertemuan ilmiah', 'Internasional', 30),
		(38, 'Menampilkan poster pada pertemuan ilmiah', 'Nasional', 20),
		(39, 'Menampilkan poster pada pertemuan ilmiah', 'Regional', 15),
		(40, 'Menampilkan poster pada pertemuan ilmiah', 'Universitas', 10),
		(41, 'Menampilkan poster pada pertemuan ilmiah', 'Fakultas', 5),
		(42, 'Membuat rancangan dan karya teknologi, karya seni, pertunjukan karya seni', 'Internasional', 40),
		(43, 'Membuat rancangan dan karya teknologi, karya seni, pertunjukan karya seni', 'Nasional', 25),
		(44, 'Membuat rancangan dan karya teknologi, karya seni, pertunjukan karya seni', 'Regional', 15),
		(45, 'Membuat rancangan dan karya teknologi, karya seni, pertunjukan karya seni', 'Universitas', 10),
		(46, 'Membuat rancangan dan karya teknologi, karya seni, pertunjukan karya seni', 'Fakultas', 5),
		(47, 'Berperan-serta aktif pada organisasi profesi', 'Internasional sebagai ketua/wakil/sekretaris/bendahara', 25),
		(48, 'Berperan-serta aktif pada organisasi profesi', 'Internasional sebagai pengurus', 20),
		(49, 'Berperan-serta aktif pada organisasi profesi', 'Internasional sebagai anggota', 15),
		(50, 'Berperan-serta aktif pada organisasi profesi', 'Nasional sebagai ketua/wakil/sekretaris/bendahara', 20),
		(51, 'Berperan-serta aktif pada organisasi profesi', 'Nasional sebagai pengurus', 15),
		(52, 'Berperan-serta aktif pada organisasi profesi', 'Nasional sebagai anggota', 10),
		(53, 'Berperan-serta aktif pada organisasi profesi', 'Regional sebagai ketua/wakil/sekretaris/bendahara', 15),
		(54, 'Berperan-serta aktif pada organisasi profesi', 'Regional sebagai pengurus', 10),
		(55, 'Berperan-serta aktif pada organisasi profesi', 'Regional sebagai anggota', 5),
		(56, 'Berperan-serta aktif pada organisasi profesi', 'Universitas/fakultas/jurusan sebagai ketua/wakil/sekretaris/bendahara', 10),
		(57, 'Berperan-serta aktif pada organisasi profesi', 'Universitas/fakultas/jurusan sebagai pengurus', 5),
		(58, 'Berperan-serta aktif pada organisasi profesi', 'Universitas/fakultas/jurusan sebagai anggota', 3),
		(59, 'Mengikuti pelatihan bidang keilmuan', 'Internasional', 20),
		(60, 'Mengikuti pelatihan bidang keilmuan', 'Nasional', 15),
		(61, 'Mengikuti pelatihan bidang keilmuan', 'Regional', 10),
		(62, 'Mengikuti pelatihan bidang keilmuan', 'Universitas', 5),
		(63, 'Mengikuti pelatihan bidang keilmuan', 'Fakultas', 3),
		(64, 'Menduduki jabatan pada badan kemahasiswaan', 'Universitas sebagai presiden/wakil/sekretaris/bendahara BEM UA', 25),
		(65, 'Menduduki jabatan pada badan kemahasiswaan', 'Universitas sebagai kementrian', 15),
		(66, 'Menduduki jabatan pada badan kemahasiswaan', 'Universitas sebagai anggota pengurus', 10),
		(67, 'Menduduki jabatan pada badan kemahasiswaan', 'Universitas sebagai presiden/wakil/sekretaris DLM UA', 25),
		(68, 'Menduduki jabatan pada badan kemahasiswaan', 'Fakultas sebagai gubernur/wakil/sekretaris/bendahara BEMF', 25),
		(69, 'Menduduki jabatan pada badan kemahasiswaan', 'Fakultas sebagai kepala dinas/bidang', 15),
		(70, 'Menduduki jabatan pada badan kemahasiswaan', 'Fakultas sebagai anggota pengurus', 10),
		(71, 'Menduduki jabatan pada badan kemahasiswaan', 'Fakultas sebagai ketua/wakil/sekretaris DLMF', 25),
		(72, 'Menduduki jabatan pada badan kemahasiswaan', 'Fakultas sebagai anggota DLMF', 10),
		(73, 'Mempunyai prestasi di bidang olahraga/humaniora piagam/medali penghargaan', 'Internasional', 40),
		(74, 'Mempunyai prestasi di bidang olahraga/humaniora piagam/medali penghargaan', 'Nasional', 30),
		(75, 'Mempunyai prestasi di bidang olahraga/humaniora piagam/medali penghargaan', 'Regional', 25),
		(76, 'Mempunyai prestasi di bidang olahraga/humaniora piagam/medali penghargaan', 'Universitas', 20),
		(77, 'Mempunyai prestasi di bidang olahraga/humaniora piagam/medali penghargaan', 'Fakultas/jurusan', 15),
		(78, 'Mengikuti perlombaan bidang olahraga/humaniora', 'Internasional', 30),
		(79, 'Mengikuti perlombaan bidang olahraga/humaniora', 'Nasional', 20),
		(80, 'Mengikuti perlombaan bidang olahraga/humaniora', 'Regional', 15),
		(81, 'Mengikuti perlombaan bidang olahraga/humaniora', 'Universitas', 10),
		(82, 'Mengikuti perlombaan bidang olahraga/humaniora', 'Fakultas/jurusan', 5),
		(83, 'Berperan-serta aktif dalam organisasi Olahraga/humaniora (UKM/UKMF) ', 'Sebagai ketua/wakil', 15),
		(84, 'Berperan-serta aktif dalam organisasi Olahraga/humaniora (UKM/UKMF)', 'Sebagai anggota', 10),
		(85, 'Berperan-serta aktif dalam organisasi Olahraga/humaniora (UKM/UKMF)', 'Sebagai peserta', 5),
		(86, 'Mewakili PT duduk dalam panitia antar lembaga tiap priode', 'Internasional', 20),
		(87, 'Mewakili PT duduk dalam panitia antar lembaga tiap priode', 'Nasional', 15),
		(88, 'Mewakili PT duduk dalam panitia antar lembaga tiap priode', 'Regional', 10),
		(89, 'Mengikuti pertemuan organisasi/lembaga tiap kegiatan', 'Internasional', 20),
		(90, 'Mengikuti pertemuan organisasi/lembaga tiap kegiatan', 'Nasional', 15),
		(91, 'Mengikuti pertemuan organisasi/lembaga tiap kegiatan', 'Regional', 10),
		(92, 'Berperan-serta aktif dalam ke Panitiaan tiap kegiatan', 'Internasional', 20),
		(93, 'Berperan-serta aktif dalam ke Panitiaan tiap kegiatan', 'Nasional', 15),
		(94, 'Berperan-serta aktif dalam ke Panitiaan tiap kegiatan', 'Regional', 10),
		(95, 'Berperan-serta aktif dalam ke Panitiaan tiap kegiatan', 'Universitas', 5),
		(96, 'Berperan-serta aktif dalam ke Panitiaan tiap kegiatan', 'Fakultas', 3),
		(97, 'Berperan-serta aktif dalam ke Panitiaan tiap kegiatan', 'Jurusan', 2),
		(98, 'Mengikuti pelatihan bidang minat dan bakat tiap kegiatan', 'Internasional', 20),
		(99, 'Mengikuti pelatihan bidang minat dan bakat tiap kegiatan', 'Nasional', 15),
		(100, 'Mengikuti pelatihan bidang minat dan bakat tiap kegiatan', 'Regional', 10),
		(101, 'Mengikuti pelatihan bidang minat dan bakat tiap kegiatan', 'Universitas', 5),
		(102, 'Mengikuti pelatihan bidang minat dan bakat tiap kegiatan', 'Fakultas', 3),
		(103, 'Mengikuti pelatihan bidang minat dan bakat tiap kegiatan', 'Jurusan', 2),
		(104, 'Memberikan layanan kepada masyarakat tiap kegiatan', 'Internasional', 20),
		(105, 'Memberikan layanan kepada masyarakat tiap kegiatan', 'Nasional', 15),
		(106, 'Memberikan layanan kepada masyarakat tiap kegiatan', 'Regional', 10),
		(107, 'Memberikan layanan kepada masyarakat tiap kegiatan', 'Lokal', 5),
		(108, 'Memberikan pelatihan keilmuan pada masyarakat tiap kegiatan', 'Internasional', 25),
		(109, 'Memberikan pelatihan keilmuan pada masyarakat tiap kegiatan', 'Nasional', 20),
		(110, 'Memberikan pelatihan keilmuan pada masyarakat tiap kegiatan', 'Regional', 15),
		(111, 'Memberikan pelatihan keilmuan pada masyarakat tiap kegiatan', 'Lokal', 10);
		 ");

		//Isi data category
	    /*  0. mahasiswa
	    1. dosen penilai
	    2. admin
	    */
		$conn->query(" 
		INSERT INTO `user` (`nomor_induk`, `password`, `nama`, `fakultas`, `jurusan`, `ttl`, `jenis_kelamin`, `status`) VALUES (1311522013, 123, 'Ikhwan', 'FTI', 'SI', STR_TO_DATE('22-03-1997', '%d-%m-%Y'), '', 0),(1234 , 1234, 'Dosen', 'FTI', 'SI', '', '', 1),(123, 123, 'admin', 'FTI', 'SI', '', '', 2);");

		echo "<script>alert('Configurasi berhasil dilakukan');</script>";
		echo "<script>location.href='web/';</script>\n";

	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$conn->close();

	//Buatn connction.php
	$myfile = fopen("web/connection.php", "w") or die("Unable to open file!");
	$localhost="localhost";
	$dbname=$_POST['dbname'];
	$username=$_POST['username'];
	$pass=$_POST['pass'];
	$isi_file = '
	<?php
	  class Db {
	    private static $instance = NULL;

	    private function __construct() {}

	    private function __clone() {}

	    public static function getInstance() {
	      if (!isset(self::$instance)) {
	        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	        self::$instance = new PDO("mysql:host='.$localhost.';dbname='.$dbname.'", "'.$username.'", "'.$pass.'", $pdo_options);
	      }
	      return self::$instance;
	    }
	  }
	?>
	';
	fwrite($myfile, $isi_file);
	fclose($myfile);

	//Buatn connction.php
	$myfile = fopen("web/json/include/Config.php", "w") or die("Unable to open file!");
	$localhost="localhost";
	$dbname=$_POST['dbname'];
	$username=$_POST['username'];
	$pass=$_POST['pass'];
	$isi_file = '
	<?php

	/**
	 * Database config variables
	 */
	define("DB_HOST", "'.$localhost.'");
	define("DB_USER", "'.$username.'");
	define("DB_PASSWORD", "'.$pass.'");
	define("DB_DATABASE", "'.$dbname.'");
	?>
	';
	fwrite($myfile, $isi_file);
	fclose($myfile);





?>