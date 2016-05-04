    <link href="views/css/bootstrap.min.css" rel="stylesheet">
    <link href="views/css/portfolio-item.css" rel="stylesheet">
    <script src="views/index.js"></script>
    <style type="text/css">

    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    </style>

    <script type="text/javascript">

    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready( function() {
        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
            console.log(numFiles);
            console.log(label);
        });
    });

</script>

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
                <h1 class="page-header">Unggah File Sertifikat
                </h1>
            </div>
        </div>

        <!-- Form unggah file -->
        <div class="row">
            <div class="col-md-12">
                <form enctype="multipart/form-data" action="?controller=Sertifikat&action=UnggahFile" method="post" enctype="multipart/form-data" class="form-style-7">

                    <div style="position:relative;">
                        <a class='btn btn-primary' href='javascript:;'>
                            Choose File...
                            <input name="file_input" type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' size="40"  onchange='$("#upload-file-info").html($(this).val());'accept="application/pdf" >
                        </a>
                        &nbsp;
                        <span class='label label-info' id="upload-file-info"></span>
                    </div><br>

                    <div class="form-group">
                        <label for="pwd">Keterangan</label>
                        <textarea class="form-control" rows="10" name="keterangan"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="cat">Pilih Kategori</label>
                        <select id="pilih_category" class="form-control" name="kategori">
                            <option value="0" hidden>Pilih Kategori</option>
                            <?php foreach($category as $post) { 
                                echo "<option value='$post->judul'>$post->judul</option>'";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pwd">Pilih Tingkatan</label>
                        <select id="pilih_tingkatan" class="form-control" name="tingkatan">
                            <option value="0" hidden>Pilih Tingkatan</option>
                        </select>
                    </div>
                    <br>

                    <input class='btn btn-primary' type="submit" style='border-color:#fbb254;background-color:#fbb254;color:white;' name="submit" value="Send This">
                </form>
            </div>

        </div>
        <!-- /.Form unggah file -->

        <hr>
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; SAPS - Fakultas Teknologi Informasi - Universitas Andalas</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

        </div>
    <!-- jQuery -->
    <script src="views/js/jquery.js"></script>
    <script src="views/js/bootstrap.min.js"></script>


