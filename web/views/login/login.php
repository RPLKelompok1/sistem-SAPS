    <!--STYLE-->
    <link rel="stylesheet" type="text/css" href="views/css/style.css">

      <div class="container">
      <div class="info">
        <h1>FTI - SAPS</h1><span></span>
      </div>
    </div>
    <div class="form">
      <!--div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div-->

      <form action="index.php?controller=login&action=cekLogin" method="post" enctype="multipart/form-data" class="form-style-7">      
      <!--form class="login-form"-->
        <input type="text" name="nomor_induk"  placeholder="BP / NIP"/>
        <input type="password"name="password" placeholder="PASSWORD"/>
        <!--button>login</button-->
        <input type="submit" name="submit" value="Log In" style="background:#fbb254;color:#ffffff" >
      </form>
    </div>
    <video id="video" autoplay="autoplay" loop="loop" poster="polina.jpg">
      <source src="http://andytran.me/A%20peaceful%20nature%20timelapse%20video.mp4" type="video/mp4"/>
    </video>

    <script src="js/index.js"></script>