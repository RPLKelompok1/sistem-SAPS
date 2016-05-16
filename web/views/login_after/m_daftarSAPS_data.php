<!-- CEK STATUS USER -->
<?php
  if ($_SESSION['status'] == 0 ) {
    echo"<script>alert('Anda tidak memiliki hak akses untuk halaman ini');</script><script>location.href='?controller=Sertifikat&action=ReqHalBeranda';</script>";
  }
?>

<!-- ISI -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Data Pendaftar SAPS</h1>
    </div>
  </div>

  <!-- List Notif -->
  <?php foreach($list_saps as $post) { ?>
  <div class="row">
    <!--
      jenis notifikasi
        1. Pendaftaran SAPS diterima
        2. Pendaftaran SAPS ditolak
        3. Comment 
        4. Pengajuan SAPS
    -->
    <div class="col-xs-2"></div>
    <div class="col-xs-8" style="padding-bottom:20px;">
      <div style="background-image:url('views/img/daftar.png');background-repeat:no-repeat;background-size:100% 100%;border-radius:20px;height:180px;width:100%">
        <div style="padding:20px;">
          <?php
          //$action=;
          $controller = new Login_Controller();   
          $user=$controller->{ "ReqUser" }($post->id_pendaftar);
          //$user = User::readUser($post->id_user);
          echo"<h3 style='margin-left:30px'> $user->nama </h3>" 
          ?> 
          <h3 style="margin-left:30px"><?php echo "$post->id_pendaftar"; ?></h3>
          <a href="?controller=SAPS&action=ReqHalPendaftaran&id_pendaftaran=<?php echo "$post->id_pendaftaran"; ?>&id_pendaftar=<?php echo "$post->id_pendaftar"; ?>" style="color:#fbb254;float:right;margin-right:20px;font-size:30px">VIEW</a>
        </div>
      </div>
    </div>
    <div class="col-xs-2"></div>
  </div>
  <?php } ?>
  <!-- /.List Notif -->

  <hr>
  <!-- Footer -->
  <footer>
    <div class="row">
      <div class="col-lg-12">
        <p>Copyright &copy; SAPS - Fakultas Teknologi Informasi - Universitas Andalas</p>
      </div>
    </div>
  </footer>
</div>
<!-- /.container -->

<!-- jQuery -->
<script src="views/js/jquery.js"></script>
<script src="views/js/bootstrap.min.js"></script>