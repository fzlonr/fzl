 <?php 
    ob_start();
    if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");
    $sayfabasligi="Kullanıcı detayı";
    include 'head.php';
    $kadi=$_GET["KullaniciAdi"];
    $userdetails = new userdetails($db);
    $user=$userdetails->kdetayi($kadi);
    if(isset($_GET["Islem"]) && $_GET["Islem"]=="SifreDegistir" && !empty($_POST["Ysifre"])){
        
        $userdetails->sifredegis($kadi,$_POST["Ysifre"]);
        $sonuc="Şifre değiştirildi.";
    
    
    }
?>

  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><?=$kadi?> adlı kullanıcı profili (<?=$user[0]["grupadi"]?> grup üyesidir.)</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="index.php?Sayfa=userdetails&KullaniciAdi=<?=$kadi?>"><?=$kadi?> Kullanıcılar</a></li>
        </ul>
      </div>
	  
	  

	  <?php if(isset($sonuc)){ ?>
	  <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <p><?=$sonuc?></p>
              </div>
	  <?php }?>
	  
<div class="row user">
        
        <div class="col-md-3">
          <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
              <li class="nav-item"><a class="nav-link active show" href="#user-settings" data-toggle="tab">Detaylar</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-password" data-toggle="tab">Şifre Değiştir</a></li>
              <li class="nav-item"><a class="nav-link" href="#user-log" data-toggle="tab">Oturum Kayitlari</a></li>
            </ul>
          </div>
        </div>
       
        
        <div class="col-md-9">
         
          <div class="tab-content">
            <div class="tab-pane active show" id="user-settings">
              
               <div class="tile user-settings">
                <h4 class="line-head">Detaylar</h4>
                 <div class="row">
                   <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Adı Soyadı</label>
                      <input class="form-control" value="<?=$user[0]["adsoyad"]?>" type="text"> 
                    </div>
                  </div>
                  
                  <div class="row">
                   <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>TC Kimlik No</label>
                      <input class="form-control" value="<?=$user[0]["tcno"]?>" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Mobil No</label>
                      <input class="form-control" value="<?=$user[0]["mobilno"]?>" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Geçerlilik Tarihi</label>
                      <input class="form-control" value="<?=$user[0]["gtarihi"]?>" type="text">
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Kayit Türü</label>
                      <input class="form-control" value="<?=$user[0]["kayitturu"]?>" type="text">
                    </div>
                  </div>
                 
              </div>
              
            </div>
            
             <div class="tab-pane fade" id="user-password">
              
               <div class="tile user-password">
                <h4 class="line-head">Şifre Değiştir</h4>
                  <form action="index.php?Sayfa=userdetails&KullaniciAdi=<?=$kadi?>&Islem=SifreDegistir" class="form-horizontal" method="POST">
                  
                  <div class="row">
                   <div class="clearfix"></div>
                    <div class="col-md-8 mb-4">
                      <label>Yeni Şifre</label>
                    <input type="hidden" name="kullanici" id="kullanici" value="<?=$kadi?>"  />
                    <input type="text" name="Ysifre" id="Ysifre" class="form-control" />
                    </div>
                  </div>
                  <div class="row mb-10">
                    <div class="col-md-12">
                      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Kaydet</button>
                    </div>
                  </div>
                  <form>
              
                  </div>
             
              
            </div>
            <div class="tab-pane fade" id="user-log">
              <div class="tile user-log">
                   <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>İp Adresi</th>
                                        <th>Oturum Başlangıç</th>
                                        <th>Oturum Bitiş</th>
                                        <th>Oturum Sonlandırılma Sebebi</th>
                                        <th>MAC Adresi Bilgisi</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                              <?php 
                                              
                                        foreach($userdetails->oturumdetaylari($kadi) as $item){
                                              if($item->acctstoptime=='')
                                                $class=' style="background-color:#ffbb44"';
                                              else  
                                                $class=null;
                                              ?>
                                              
                                      
                                    <tr<?=$class?>>
                                        <td><?=$item->framedipaddress?></td>
                                        <td><?=$item->acctstarttime?></td>
                                        <td><?=$item->acctstoptime?></td>
                                        <td><?=$item->acctterminatecause?></td>
                                        <td><?=$item->callingstationid?></td>
                                       
                                    </tr>
                                  
                                   
                                
                                <?php } ?>
                                 </tbody>
                                </table>
              <div>
            </div>
          </div>
        </div>
      </div>
	  
	  
	  
    </main>
<?php 

    include 'foot.php';

