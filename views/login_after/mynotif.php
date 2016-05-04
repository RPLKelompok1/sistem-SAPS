    <link href="views/css/bootstrap.min.css" rel="stylesheet">
    <link href="views/css/portfolio-item.css" rel="stylesheet">

    <!--MENU-->
    <?php
        if ($_SESSION['status'] == 0) {
          include "menu_mahasiswa.php";
        } else if ($_SESSION['status'] == 1) {
          include "menu_dosen.php";
        } else {
          include "menu_admin.php";          
        }
        ?>

    <!-- ISI -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Notifikasi
                </h1>
            </div>
        </div>

        <!-- List Notif -->
        <div class="row">
            <?php foreach($list_notif as $post) { ?>
              <!--p>
                jenis notifikasi
                  1. Pendaftaran SAPS diterima
                  2. Pendaftaran SAPS ditolak
                  3. Comment 
                  4. Pengajuan SAPS
              </p-->

              <div class="col-xs-12" style="padding-bottom:20px;">
                  <div style="background-color:#f5f5f5;border-radius:20px;height:220px">
                      <div style="padding:20px;">
                          <?php if ($post->tipe == 1) {
                          ?>
                            <h1>Pendaftaran SAPS</h1>
                            <h3 style="margin-left:30px">Pendaftaran SAPS anda diterima</h3>
                            <img src="views/img/ic_ceklis.png" style="float:right;margin-right:20px;width:80px;height:auto">          
                          <?php  
                          }  else if ($post->tipe == 2) { ?>
                            <h1>Pendaftaran SAPS</h1>
                            <h3 style="margin-left:30px">Pendaftaran SAPS anda ditolak</h3>
                            <img src="views/img/ic_silang.png" style="float:right;margin-right:20px;width:50px;height:auto">
                          <?php  
                          }  else if ($post->tipe == 3) { ?>
                            <h1>Comment</h1>
                            <h3 style="margin-left:30px">Seseorang mengomentari postingan anda</h3>
                            <a href="?controller=Sertifikat&action=ReqHalKomen&id=<?php echo "$post->isi"; ?>" style="color:#fbb254;float:right;margin-right:20px;font-size:30px">VIEW</a>
                          <?php  
                          }  else if ($post->tipe == 4) { ?>
                            <h1>Pendaftaran SAPS</h1>
                            <h3 style="margin-left:30px">Seseorang mengajukan pendaftaran SAPS</h3>
                            <a href="?controller=SAPS&action=ReqHalPendaftaran&id_pendaftaran=<?php echo "$post->isi"; ?>" style="color:#fbb254;float:right;margin-right:20px;font-size:30px">VIEW</a>
                          <?php  
                          } ?>
                      </div>
                  </div>
              </div>
            <?php } ?>
        </div>
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