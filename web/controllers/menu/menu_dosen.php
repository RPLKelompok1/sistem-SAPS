    <!-- Navigation Menu -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="?controller=Sertifikat&action=ReqHalBeranda">Beranda</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <li>
                      <a href="?controller=SAPS&action=ReqHalPendaftaran" >Data Pendaftaran SAPS</a>
                  </li>
                  <li>
                      <a href="?controller=Notifikasi&action=ReqHalNotif" >Notification</a>
                  </li>
                  <li>
                      <a href="" data-target="#modalLogOut" data-toggle="modal">Logout</a>
                  </li>
              </ul>
          </div>
        </div>
        <!-- /.container -->
    </nav>

    <div class="modal fade" id="modalLogOut" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color:#fbb254">
              <h4 class="modal-title" style="color:white">Log Out</h4>
            </div>
            <div class="modal-body" style="text-align:center"><br>
              <a href="" class="btn btn-info btn-lg" style="background-color: #ed5564;border-color: #ed5564; float:right;">NO</a>
              <a href="?controller=login&action=logout" class="btn btn-info btn-lg" style="background-color: #42cb6f;border-color: #42cb6f; float:right; margin-right:20px;">YES</a> <br><br><br>
            </div>
          </div>
        </div>
    </div>
