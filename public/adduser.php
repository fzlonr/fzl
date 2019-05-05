<?php 
    if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");
    $sayfabasligi="Kullanıcı Ekle ";
    include 'head.php';
    if(isset($_POST["grup"]) && isset($_POST["kadi"]) && isset($_POST["sifre"]) ){
        $grup=$_POST["grup"];
        
        $adduser = new adduser($db,$grup);
        if(empty($_POST["gtarihi"])){
            $_POST["gtarihi"]="01/11/2099";
        }
        $son=$adduser->kullanıcıekle($_POST["kadi"],$_POST["sifre"],$_POST["gtarihi"],$_POST["ad"],$_POST["tc"],$_POST["tel"],null,null);
    }
    
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1>Kullanıcı Ekle</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="?Sayfa=adduser"> Kullanıcı Ekle</a></li>
        </ul>
      </div>
	  <?php if(isset($_GET["Sonuc"])){ ?>
	  <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <p><?=$_GET["Sonuc"]?></p>
              </div>
	  <?php }?>
	  <?php if(empty($tur)){ ?>
	  <div class="alert alert-dismissible alert-warning">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <h4>Dikkat !</h4>
                <p>Dikkat burdan eklediğiniz kullanıcılar için herhangi bir onay işlemi gerekmez.</p>
              </div>
	  <?php }?>

	  
    <div class="row">
        <div class="col-md-12">
                    
            <div class="tile">
            
             <div class="tile-body">
                 
                   <form role="form" action="?Sayfa=adduser" method="post">

                 <div class="col-md-12">
                      <h3> Kullanıcı detaylarını giriniz</h3>
                      <hr>
                      <div class="form-group">
                        <label class="control-label">Ad Soyad</label>
                        <input id="ad" name="ad" maxlength="100" type="text" required="required" class="form-control" placeholder="Ad Soyad giriniz">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Tc Kimlik No</label>
                        <input id="tc" name="tc" maxlength="100" type="number" required="required" class="form-control" placeholder="Tc Kimlik No giriniz">
                      </div>
                      <div class="form-group">
                        <label class="control-label">Telefon No</label>
                        <input id="tel" name="tel" maxlength="100" type="number" required="required" class="form-control" placeholder="Telefon No giriniz">
                      </div>
                </div>
                
                
                
                                <div class="col-md-12">
                          <h3> Kullanıcı bilgilerini giriniz</h3>
                          <hr>
                          <div class="form-group">
                            <label class="control-label">Kullanıcı Adı</label>
                            <input id="kadi" name="kadi" maxlength="200" type="text" required="required" class="form-control" placeholder="Kullanıcı adı giriniz.Türkçe karekter kullanmayınız!">
                          </div>
                          <div class="form-group">
                            <label class="control-label">Şifre</label>
                            <input id="sifre" name="sifre" maxlength="200" type="text" required="required" class="form-control" placeholder="Şifre  giriniz">
                          </div>
                          
                        </div>
                                
              
                         <div class="col-md-12">

        

          <div class="form-group">
            <label class="control-label">Hesap Geçerlilik</label>

                  <div class="input-group date ui-datepicker">

      
<input class="form-control" id="gtarihi" name="gtarihi" type="text" placeholder="Hesabın geçerli olacağı tarihi seçin">
                  </div>

                </div>
                
                
                
                
                
                
         <div class="form-group">
                                            <label>Kullanıcı grubu</label>
           <select id="grup" name="grup" required="required" class="form-control">
                                                                 	<?php
                                                                 	
$gruplar=$db->table('grupbilgisi')->getAll();
foreach ($gruplar as $gruptakiler) {
                $grupsec = $gruptakiler->grupadi;
                $gaciklamasi = $gruptakiler->gaciklamasi;

echo"
                                           <option value='$grupsec'>$gaciklamasi [$grupsec}</option>



                                       ";


   }
?>
 </select>
                                        </div>
        </div>
                        
                     <div class="col-md-12">

        
<button class="btn btn-primary" type="submit">Kaydet</button>
</form>
        </div>   
             </div>
          </div>
          
    
                    
        </div>
      </div>

</main>

<?php 

    include 'foot.php';
