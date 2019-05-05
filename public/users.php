<?php 
    ob_start();

    if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");
    $tur=$_GET["Tur"];
    $sayfabasligi="$tur Kullanıcılar";
    include 'head.php';
    $datatable=true;
	$users = new users($db,$tur);
    if(isset($_GET["Islem"])  && isset($_GET["KullaniciAdi"])){
        if($_GET["Islem"]=='Sil'){
            
            $users->kbsil($_GET["KullaniciAdi"]);
            $users->radsil($_GET["KullaniciAdi"]);
            header("Location:index.php?Sayfa=users&Sonuc=Kullanici silindi.");
        }
        if($_GET["Islem"]=='Onayla'){

           $users->konayla($_GET["KullaniciAdi"]); 
            header("Location:index.php?Sayfa=users&Tur=Onaysız&Sonuc=Kullanici onaylandı.");
        }
    }
?>

  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><?=$tur?> Kullanıcılar</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="index.php?Sayfa=<?=$sayfa?>&Tur=<?=$tur?>"><?=$tur?> Kullanıcılar</a></li>
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
                <p>Hangi kullanıcıları görüntülemek istemiştiniz lütfen menüden seçin.</p>
              </div>
	  <?php }?>

	  
      <div class="row">
        <div class="col-md-12">
          <?php if($tur=='Onaylı'){ ?>
          
            <div class="tile">
            <div class="tile-title-w-btn">
              <h3 class="title"> </h3>
              <p><a class="btn btn-primary icon-btn" href="?Sayfa=adduser"><i class="fa fa-plus"></i>Kullanıcı Ekle	</a></p>
            </div>
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="DataTablo">
                                    <thead>
                                    <tr>
                                    <th>Adı Soyadı</th>
                                    <th>Kullanıcı Adı</th>
                                    <th>Durumu</th>
                                    <th>Grup</th>
                                    <th>İşlem</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                           <?php foreach ($users->okgetir(null) as $item){ ?>
        
                            <tr>
                            
                    <td>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <?=$item->adsoyad?>
                                            </td>
                    <td><?=$item->kullaniciadi?></td>
                    <td>
                    
                    <i class="mdi mdi-checkbox-blank-circle text-success"></i> Onaylanmış
                    <p class="m-0 text-muted font-14"><?php if(!empty($item->gtarihi)){?>
                                                <?=$item->gtarihi?>
                                                <?php }else{ ?>
                                                Süresiz
                                                <?php }?></p>
                    
                    </td>
                    <td><?=$item->grupadi?></td>
                    <td>
                    <a class="btn btn-primary waves-effect waves-light" href="index.php?Sayfa=userdetails&KullaniciAdi=<?=$item->kullaniciadi?>" role="button"> Detay</a>
                    <a class="btn btn-warning waves-effect waves-light" href="index.php?Sayfa=users&KullaniciAdi=<?=$item->kullaniciadi?>&Islem=Sil" role="button"> Sil</a></td>                
                    
                </tr>
                <?php } ?>
                                    
                                    
                                    </tbody>
                                </table>  
              
            </div>
          </div>
          
          <?php } ?>

          <?php if($tur=='Onaysız'){ ?>
          
            <div class="tile">
            
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="DataTablo">
                                    <thead>
                                    <tr>
                                    <th>Adı Soyadı</th>
                                    <th>Kullanıcı Adı</th>
                                    <th>Grup</th>
                                    <th>İşlem</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                           <?php foreach ($users->obkgetir() as $item){ ?>
        
                            <tr>
                            
                    <td><i class="fa fa-user" aria-hidden="true"></i><?=$item->adsoyad?></td>
                    <td><?=$item->kullaniciadi?></td>
                    <td><?=$item->grupadi?></td>
                    <td>
                    <a class="btn btn-success waves-effect waves-light" href="index.php?Sayfa=users&Tur=Onaysız&KullaniciAdi=<?=$item->kullaniciadi?>&Islem=Onayla" role="button"> Onayla</a>
                    <a class="btn btn-danger waves-effect waves-light" href="index.php?Sayfa=users&KullaniciAdi=<?=$item->kullaniciadi?>&Islem=Sil" role="button"> Sil</a>
                    </td>                
                    
                </tr>
                <?php } ?>
                                    
                                    
                                    </tbody>
                                </table>  
              
            </div>
          </div>
          
          <?php } ?>          
        </div>
      </div>
	  
	  
	  
    </main>
<?php 

    include 'foot.php';
 ob_end_flush();

