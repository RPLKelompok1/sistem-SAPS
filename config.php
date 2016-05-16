<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>FTI - SAPS</title>
      
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href=''>
    <link rel="stylesheet" href="web/views/css/style.css">    
    <link rel="stylesheet" href="web/views/css/reset.css">

  </head>

  <body>

    <div class="container">
      <div class="info">
        <h1>CONFIG</h1><span></span>
      </div>
    </div>
    <div class="form">
      <!--div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div-->

      <form action="config_proces.php" method="post" enctype="multipart/form-data" class="form-style-7">      
      <!--form class="login-form"-->
        <input type="text" name="dbname"  placeholder="Nama Database"/>
        <input type="text" name="username"  placeholder="Username Server"/>
        <input type="text" name="pass"  placeholder="Password Server"/>

        <input type="submit" name="submit" value="Set Up" style="background:#fbb254;color:#ffffff" >
      </form>
    </div>

    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="web/views/js/index.js"></script>
     
  </body>
</html>
