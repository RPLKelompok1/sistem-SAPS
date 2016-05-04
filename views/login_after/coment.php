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
                <h1 class="page-header">Comment
                </h1>
            </div>
        </div>

        <!-- File sertifikat -->
        <div class="row">
            <?php foreach($sertifikat as $post) { ?>
              <div class="col-sm-4"></div>
              <div class="col-sm-4" style="padding-bottom:20px;">
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
                              <a href="#" >
                                <img  src="views/img/pdf.png" alt="" style="width:50px;height:auto;margin:0px;">
                              </a>                            
                              <p style="color:#fbb254;padding-top:10px"><?php echo"$post->keterangan" ?></p>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-4"></div>
            <?php } ?>
        </div>
        <!-- /.File sertifikat -->

        <!-- Komen yang telah ada -->
        <div class="row">
            <?php foreach($sertifikat_comment as $comment) { ?>
              <div class="col-sm-12" style="padding-bottom:20px;">
                  <div style="background-color:#f5f5f5;border-radius:20px;">
                      <div style="padding:20px;">
                          <?php
                          $controller = new Sertifikat_Controller();   
                          $user=$controller->{ "ReqUser" }($comment->id_user);
                          echo"<p style='color:#fbb254'> $user->nama </p>" ;
                          echo"<p style='color:#fbb254'> $comment->id_user </p>"; 
                          echo"<p style='padding-top:10px;margin-left:20px'> $comment->isi </p>";
                          ?>
                      </div>
                  </div>
              </div>
            <?php } ?>
        </div>
        <!-- /.Komen yang telah ada -->

        <!-- Form komentar -->
        <div class="row">
            <h3 style="color:#fbb254">WRITE YOUR COMMENT</h3>
              <div class="col-sm-12" style="padding-bottom:20px;">
                  <div>
                    <form action="?controller=Sertifikat&action=Komen&id=<?php echo"".$post->id_sertifikat."" ?>" method="POST">
                        <div class="form-group">
                            <textarea class="form-control" rows="10" name="isi"  style="border-color: #fbb254;background-color: #f5f5f5"></textarea>
                        </div>
                        <input type="submit" class="btn btn-default" value="Comment" style="float:right;font-size:20px;color:white;border-radius:10px;background-color: #fbb254">
                    </form>
                  </div>
              </div>
        </div>
        <!-- /.Form komentar -->

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