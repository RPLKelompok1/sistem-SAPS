<!-- CEK STATUS USER -->
<?php
  if ($_SESSION['status'] != 1 ) {
    echo"<script>alert('Anda tidak memiliki hak akses untuk halaman ini');</script><script>location.href='?controller=Sertifikat&action=ReqHalBeranda';</script>";
  }
?>

<style type="text/css">
  th{
    background-color: #fbb254 !important;
    color: white;
  }
  .tombol{
    border-color:#fbb254;
    background-color:#fbb254;
    color:white;
    float:right;
    font-size:20px;
  }
  .tombol_l{
    border-color:#42cb6f;
    background-color:#42cb6f;
    color:white;
    float:right;
    font-size:20px;
    margin-right:20px
  }
  .tombol_tl{
    border-color:#ed5564;
    background-color:#ed5564;
    color:white;
    float:right;
    font-size:20px;
  }
  .oren{
    background-image: url('views/img/back.png');
    padding: 20px 30px;
    background-repeat:no-repeat;
    background-size: 100% 100%;
    color: white;
  }
</style>

<!-- Isi -->
<div class="container">
  <div class="row">
      <div class="col-lg-12">
          <h1 class="page-header">Pendaftaran SAPS 
          </h1>
      </div>
  </div>

  <!-- Nama -->
  <div class="row">
    <div class="col-sm-2" style="margin-top:20px">
      <p style="font-size:20px">Nama</p>
    </div>
    <div class="col-sm-10" style="margin-top:20px">
      <input type="text" class="form-control" value=" <?php echo"$pendaftar->nomor_induk" ?>" disabled/>
    </div>
  </div>
  <!-- /.Nama -->

  <!-- BP -->
  <div class="row">
    <div class="col-sm-2" style="margin-top:20px">
      <p style="font-size:20px">BP</p>
    </div>
    <div class="col-sm-10" style="margin-top:20px">
      <input type="text" class="form-control"  value=" <?php echo"$pendaftar->nama" ?>" disabled/>
    </div>
  </div>
  <!-- /.BP -->

  <!-- Fakultas -->
  <div class="row">
    <div class="col-sm-2" style="margin-top:20px">
      <p style="font-size:20px">Fakultas</p>
    </div>
    <div class="col-sm-10" style="margin-top:20px">
      <input type="text" class="form-control"  value=" <?php echo"$pendaftar->fakultas" ?>" disabled/>
    </div>
  </div>
  <!-- /.Fakultas -->

  <!-- TTL -->
  <div class="row">
    <div class="col-sm-2" style="margin-top:20px">
      <p style="font-size:20px">TTL</p>
    </div>
    <div class="col-sm-10" style="margin-top:20px">
      <input type="text" class="form-control"  value=" <?php echo"$pendaftar->ttl" ?>" disabled/>
    </div>
  </div>
  <!-- /.TTL -->

  <!-- Tabel nilai -->
  <div class="row">
    <br><br>
    <!-- Tabel 1 -->
    <img src="views/img/judul1.png" style="height:50px;width:auto"> <br><br>
      <table class="table  table-bordered">
        <tr>
          <th>NO</th>
          <th>UNSUR</th>
          <th>ANGKA KREDIT</th>
          <th>BUKTI</th>
        </tr>
          <?php $i=1; 
            $total_nilai_j1 = 0;
          foreach($sertifikat_j1 as $post) { 
            $category = new SAPS_Controller();
            $hasil = $category->{ "ReqCategory" }($post->id_category);
          ?>
        <tr>
          <td><h3><?php echo "$i"; ?><h3></td>
          <td><h3><?php echo "$hasil->judul"; ?><h3>
              <h4 style="margin-left:20px;">Tingkat <?php echo "$hasil->tingkatan"; ?><h4>
              <p style="margin-left:30px;"><?php echo "$post->keterangan"; ?></p></td>
          <td><h3><?php echo "$hasil->nilai"; ?><h3></td>
          <td><a href="?controller=Sertifikat&action=ReqHalKomen&id=<?php echo "$post->id_sertifikat"; ?>" class='btn btn-primary tombol' style="float:left;margin-top:10px" Target="_blank">Check</a></td>
        </tr>
          <?php 
          $total_nilai_j1 += $hasil->nilai; 
          $i++; } ?>
        <tr>
          <td></td>
          <td><h3>Jumlah A</h3></td>
          <td><h3><?php echo "$total_nilai_j1"; ?></h3></td>
          <td></td>
        </tr>
      </table><br><br><br>
    <!-- /.Tabel 1 -->
    
    <!-- Tabel 2-->
    <img src="views/img/judul2.png" style="height:50px;width:auto"> <br><br>
      <table class="table  table-bordered">
        <tr>
          <th>NO</th>
          <th>UNSUR</th>
          <th>ANGKA KREDIT</th>
          <th>BUKTI</th>
        </tr>
          <?php $i=1; 
            $total_nilai_j2 = 0;
          foreach($sertifikat_j2 as $post) { 
            $category = new SAPS_Controller();
            $hasil = $category->{ "ReqCategory" }($post->id_category);
          ?>
        <tr>
          <td><h3><?php echo "$i"; ?><h3></td>
          <td><h3><?php echo "$hasil->judul"; ?><h3>
              <h4 style="margin-left:20px;">Tingkat <?php echo "$hasil->tingkatan"; ?><h4>
              <p style="margin-left:30px;"><?php echo "$post->keterangan"; ?></p></td>
          <td><h3><?php echo "$hasil->nilai"; ?><h3></td>
          <td><a href="?controller=Sertifikat&action=ReqHalKomen&id=<?php echo "$post->id_sertifikat"; ?>" class='btn btn-primary tombol' style="float:left;margin-top:10px" Target="_blank">Check</a></td>
        </tr>
          <?php 
          $total_nilai_j2 += $hasil->nilai; 
          $i++; } ?>
        <tr>
          <td></td>
          <td><h3>Jumlah B</h3></td>
          <td><h3><?php echo "$total_nilai_j2"; ?></h3></td>
          <td></td>
        </tr>
      </table><br><br><br>
    <!-- /.Tabel 2 -->

    <!-- Tabel 3 -->
    <img src="views/img/judul3.png" style="height:50px;width:auto"> <br><br>
      <table class="table  table-bordered">
        <tr>
          <th>NO</th>
          <th>UNSUR</th>
          <th>ANGKA KREDIT</th>
          <th>BUKTI</th>
        </tr>
          <?php $i=1; 
            $total_nilai_j3 = 0;
          foreach($sertifikat_j3 as $post) { 
            $category = new SAPS_Controller();
            $hasil = $category->{ "ReqCategory" }($post->id_category);
          ?>
        <tr>
          <td><h3><?php echo "$i"; ?><h3></td>
          <td><h3><?php echo "$hasil->judul"; ?><h3>
              <h4 style="margin-left:20px;">Tingkat <?php echo "$hasil->tingkatan"; ?><h4>
              <p style="margin-left:30px;"><?php echo "$post->keterangan"; ?></p></td>
          <td><h3><?php echo "$hasil->nilai"; ?><h3></td>
          <td><a href="?controller=Sertifikat&action=ReqHalKomen&id=<?php echo "$post->id_sertifikat"; ?>" class='btn btn-primary tombol' style="float:left;margin-top:10px" Target="_blank">Check</a></td>
        </tr>
        <?php 
        $total_nilai_j3 += $hasil->nilai; 
        $i++; } 
        $total_skor=$total_nilai_j1+$total_nilai_j2+$total_nilai_j3;
        ?>
        <tr>
          <td></td>
          <td><h3>Jumlah C</h3></td>
          <td><h3><?php echo "$total_nilai_j3"; ?></h3></td>
          <td></td>
        </tr>
      </table><br><br>
    <!-- /.Tabel 3 -->

      <div class="col-md-3"></div>
      <div class="col-md-3">
        <h3 style="float:left;padding-top:20px;"> JUMLAH A + B + C</h3>
      </div>
      <div class="col-md-3">
        <h3 class="oren" style="float:left;margin-left:50px;margin-bottom2:0px;"> <?php echo "$total_skor"; ?> </h3>
      </div>
      <div class="col-md-3"></div><br>

      <?php if ($_SESSION['status'] == 1) {?>
        <form enctype="multipart/form-data" action="?controller=SAPS&action=UbahStatus" method="post" class="form-style-7" style="padding-top:100px">
          <textarea class="form-control" rows="10" name="isi"></textarea><br>
          <input type="text" name="id" value="<?php echo"$_GET[id_pendaftaran]" ?>" hidden>    
          <input type="text" name="bp" value="<?php echo"$_GET[id_pendaftar]" ?>" hidden>         
          <input class='btn btn-primary tombol_tl' type="submit" name="kelengkapan" value="Tidak Lengkap">
          <input class='btn btn-primary tombol_l' type="submit" name="kelengkapan" value="Lengkap">
          <a href="" class='btn btn-primary tombol' style="float:left" onclick="myFunction()">Download</a>
        </form>
      <?php } ?>

  
  </div>
  <!-- /.Tabel nilai -->

  <hr>
  <!-- Footer -->
  <footer>
      <div class="row">
          <div class="col-lg-12">
              <p>Copyright &copy; SAPS - Fakultas Teknologi Informasi - Universitas Andalas</p>
          </div>
      </div>
      <!-- /.row -->
  </footer>

</div>
<!-- /.container -->

<!--print-->
<script>
function myFunction() {
    window.print();
}
</script>

<!-- jQuery -->
<script src="views/js/jquery.js"></script>
<script src="views/js/bootstrap.min.js"></script>