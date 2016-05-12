<!-- CEK STATUS USER -->
<?php
  if ($_SESSION['status'] != 0 ) {
    echo"<script>alert('Anda tidak memiliki hak akses untuk halaman ini');</script><script>location.href='?controller=Sertifikat&action=ReqHalBeranda';</script>";
  }
?>

<!-- ISI -->
<div class="container">

  <!-- Portfolio Item Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">List File Sertifikat</h1>
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
              <a href="<?php echo"sertifikat/$post->nama_file" ?>" download>
                <img  src="views/img/pdf.png" alt="" style="width:50px;height:auto;margin:0px;">
              </a>                            
              <p style="color:#fbb254;padding-top:10px"><?php echo"$post->keterangan" ?></p>
            </div>

            <div style="text-align:right">
              <a href="?controller=Sertifikat&action=ReqHalKomen&id=<?php echo"".$post->id_sertifikat."" ?>"><b>Comment</b></a>    
              <a href="" data-target="#modalHapus"  data-toggle="modal" style="margin-left:10px;color:red"><b>Hapus</b></a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- /.File sertifikat -->

  <div class="modal fade" id="modalHapus" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background-color:#fbb254">
            <h4 class="modal-title" style="color:white">HAPUS</h4>
          </div>
          <div class="modal-body" style="text-align:center"><br>             
            <h3 >Anda yakin akan mengahapus file ini ?</h3><br>
            <a href="" class="btn btn-info btn-lg" style="background-color: #ed5564; border-color: #ed5564; float:right;">NO</a>
            <a href="?controller=Sertifikat&action=HapusFile&id=<?php echo"".$post->id_sertifikat."" ?>" class="btn btn-info btn-lg" style="background-color: #42cb6f;border-color: #42cb6f; float:right; margin-right:20px;">YES</a> <br><br><br>
          </div>
        </div>
      </div>
  </div>

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