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

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">List File Sertifikat
                </h1>
            </div>
        </div>
        <!-- /.row -->

        <!-- File sertifikat -->
        <div class="row">
            <?php foreach($sertifikat as $post) { ?>
              <div class="col-sm-3 col-xs-6" style="padding-bottom:20px;">
                  <div style="background-color:#f5f5f5">
                      <div style="padding:20px;">
                          <?php echo"<p> $_SESSION[nama] </p>" ?> 
                          <?php echo"$post->id_user" ?>
                          <div style="text-align:center">
                              <a href="#" >
                                  <img  src="views/img/pdf.png" alt="" style="width:50px;height:auto;margin:0px;">
                              </a>                            
                              <p style="color:#fbb254;padding-top:10px"><?php echo"$post->keterangan" ?></p>
                          </div>

                          <div style="text-align:right">
                              <a href="?controller=Sertifikat&action=ReqHalKomen&id=<?php echo"".$post->id_sertifikat."" ?>"><b>Comment</b></a>    
                              <a href="?controller=Sertifikat&action=HapusFile&id=<?php echo"".$post->id_sertifikat."" ?>" style="margin-left:10px;color:red"><b>Hapus</b></a>
                          </div>
                      </div>
                  </div>
              </div>
            <?php } ?>
        </div>
        <!-- /.File sertifikat -->

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