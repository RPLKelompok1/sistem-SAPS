    <link href="views/css/bootstrap.min.css" rel="stylesheet">
    <link href="views/css/portfolio-item.css" rel="stylesheet">
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
      .oren{
        background-image: url('views/img/back.png');
        padding:20px 40px;
        background-repeat:no-repeat;
        background-size: 100% 20%;
      }
    </style>

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

    <!-- Isi -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Pendaftara SAPS 
                </h1>
            </div>
        </div>

        <!-- Nama -->
        <div class="row">
          <div class="col-sm-2" style="margin-top:20px">
            <p style="font-size:20px">Nama</p>
          </div>
          <div class="col-sm-10" style="margin-top:20px">
            <input type="text" class="form-control" value=" <?php echo"$_SESSION[nomor_induk]" ?>" disabled/>
          </div>
        </div>
        <!-- /.Nama -->

        <!-- BP -->
        <div class="row">
          <div class="col-sm-2" style="margin-top:20px">
            <p style="font-size:20px">BP</p>
          </div>
          <div class="col-sm-10" style="margin-top:20px">
            <input type="text" class="form-control"  value=" <?php echo"$_SESSION[nama]" ?>" disabled/>
          </div>
        </div>
        <!-- /.BP -->

        <!-- Fakultas -->
        <div class="row">
          <div class="col-sm-2" style="margin-top:20px">
            <p style="font-size:20px">Fakultas</p>
          </div>
          <div class="col-sm-10" style="margin-top:20px">
            <input type="text" class="form-control"  value=" <?php echo"$_SESSION[fakultas]" ?>" disabled/>
          </div>
        </div>
        <!-- /.Fakultas -->

        <!-- TTL -->
        <div class="row">
          <div class="col-sm-2" style="margin-top:20px">
            <p style="font-size:20px">TTL</p>
          </div>
          <div class="col-sm-10" style="margin-top:20px">
            <input type="text" class="form-control"  value=" <?php echo"$_SESSION[ttl]" ?>" disabled/>
          </div>
        </div>
        <!-- /.TTL -->

        <!-- Tabel nilai -->
        <div class="row">
          <br><br>
          <img src="views/img/judul1.png" style="height:50px;width:auto"> <br><br>

            <table class="table  table-bordered">
              <tr>
                <th>NO</th>
                <th>UNSUR</th>
                <th>ANGKA KREDIT</th>
                <th>BUKTI</th>
              </tr>
              <tr>
                <td>asd</td>
                <td>sd</td>
                <td>xzc</td>
                <td>as</td>
              </tr>
            </table><br>
          
          <img src="views/img/judul2.png" style="height:50px;width:auto"> <br><br>

          <img src="views/img/judul3.png" style="height:50px;width:auto"> <br><br><br>

          <p class="oren" style="margin-left:250px;margin-right:250px;padding:40px"> JUMLAH A + B + C</p>

          <form enctype="multipart/form-data" action="?controller=SAPS&action=SubmitPendaftaran" method="post" enctype="multipart/form-data" class="form-style-7">
            <input class='btn btn-primary tombol' type="submit" name="submit" value="Submit" >
            <a href="" class='btn btn-primary tombol' style="margin-right:20px">Download</a>
          </form>
        
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

    <!-- jQuery -->
    <script src="views/js/jquery.js"></script>
    <script src="views/js/bootstrap.min.js"></script>