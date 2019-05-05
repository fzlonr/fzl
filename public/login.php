<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Giriş Yap - ACTSPOT</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>ACTSPOT</h1>
      </div><?php if(!empty($giris_hata_mesaji)) { ?>
            <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Dur!</strong>  Kullanıcı Adı veya Şifre Hatalı.
              </div>
            <?php } ?>
      <div class="login-box">
        <form class="login-form" action="index.php?Sayfa=login" method="post">
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Giriş Yap</h3>
            
          <div class="form-group">
            <label class="control-label">Kullanıcı Adı</label>
                    <input type="text" name="username" class="form-control"/>
          </div>
          <div class="form-group">
            <label class="control-label">Şifre</label>
                    <input type="password" name="userpassword" class="form-control"/>
          </div>
         
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Giriş Yap</button>
          </div>
        </form>
        
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
   
  </body>
</html> 
