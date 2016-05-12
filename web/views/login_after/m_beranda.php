
<!-- ISI -->
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Beranda</h1>
    </div>
  </div>

  <!-- Sertifikat di Beranda -->
  <div class="row">
    <?php foreach($sertifikat as $post) { 
      //$user = Sertifikat::readUser($post->id_user);
      //$cari = mysql_query("SELECT * FROM `user` WHERE `nomor_induk` = 1311522013 ");
      //$profil = mysql_fetch_object($cari);?>
      <div class="col-sm-3 col-xs-6" style="padding-bottom:20px;">
        <div style="background-color:#f5f5f5">
          <div style="padding:20px;">
            <?php
            //$action=;
            $controller = new Sertifikat_Controller();   
            $user=$controller->{ "ReqUser" }($post->id_user);
            //$user = User::readUser($post->id_user);
            echo"<p> $user->nama </p>" 
            ?> 
            <?php echo"$post->id_user" ?>
            <div style="text-align:center">
              <a href="<?php echo"sertifikat/$post->nama_file" ?>" download>
                  <img  src="views/img/pdf.png" alt="" style="width:50px;height:auto;margin:0px;">
              </a>                            
              <p style="color:#fbb254;padding-top:10px"><?php echo"$post->keterangan" ?></p>
            </div>

            <?php
                if ($_SESSION['status'] == 0 || $_SESSION['status'] == 1) {?>
            <div style="text-align:right">
                <a href="?controller=Sertifikat&action=ReqHalKomen&id=<?php echo"".$post->id_sertifikat."" ?>"><b>Comment</b></a>    
            </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- /.Sertifikat di Beranda -->

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