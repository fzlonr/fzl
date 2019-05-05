<?php 
    if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");
    $sayfabasligi="Anasayfa";
    include 'head.php';
    $datatable=true;
	$main = new main($db);
?>

  <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Actspot Yönetim Arayüzüne Hoş Geldiniz</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Ana Sayfa</a></li>
        </ul>
      </div>
	  
	  
	<div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
              <h4>Kullanıcılar</h4>
              <p><b><?=$main->ksayisi()?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
              <h4>Onay Bekleyenler</h4>
              <p><b><?=$main->obksayisi()?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x"></i>
            <div class="info">
              <h4>Gruplar</h4>
              <p><b><?=$main->gsayisi()?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-star fa-3x"></i>
            <div class="info">
              <h4>Bağlantı Kayıtları</h4>
              <p><b><?=$main->toplamoturumsayisi()?></b></p>
            </div>
          </div>
        </div>
      </div>

	  
      <div class="row">
        <div class="col-md-8">
          <div class="tile">
            <h3 class="tile-title">Çevrimiçi Kullanıcılar(<?=$main->cevrimicikullanicisayisi()?>)</h3>
            <div class="table-responsive">
              <div class="table-responsive">
              <table class="table table-hover table-bordered" id="DataTablo">
 <thead>
                                    <tr>
                                    <th>Adı Soyadı</th>
                                    <th>Durumu</th>
                                
                                    <th>Tarih</th>
                                    </tr>
                                    </thead>
                                        <tbody>
                             
							   <?php foreach($main->cevrimicikullanicilar() as $item){?>
                               
                                        <tr>
                                            <td>
                                                <i class="fa fa-user" aria-hidden="true"></i>

                                               <a href="index.php?Sayfa=userdetails&KullaniciAdi=<?=$item->username?>"><?=$item->adsoyad?></a>
                                            </td>
                                            <td><i class="mdi mdi-checkbox-blank-circle text-success"></i> Çevrimiçi</td>
                                            <td>
                                                <?=$item->acctstarttime?>
                                                <p class="m-0 text-muted font-14">Oturum Başlangıcı</p>
                                            </td>
                                            
                                        </tr>
						<?php } ?>
										
                                        </tbody>
                                    </table>
            </div>
          </div>
        </div>
      </div>
	  
	  
	  
    </main>
<?php 

    include 'foot.php';
