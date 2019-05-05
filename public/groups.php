<?php 
    ob_start();
    if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");
    $sayfabasligi="Gruplar";
    include 'head.php';
    $groups=new groups($db);
    
    if(!empty($_POST["gadi"]) && !empty($_POST["gaciklamasi"]) && !empty($_POST["yonlendirme"]) && !empty($_POST["downh"]) && !empty($_POST["uph"])){
    
        $groups->grupekle($_POST["gadi"],$_POST["gaciklamasi"],$_POST["downh"],$_POST["uph"],$_POST["yonlendirme"]);
        
    }
    if(!empty($_GET["GrupAdi"]) && !empty($_GET["Islem"]) && $_GET["Islem"]=='GrupSil'){
        $groups->grupsil($_GET["GrupAdi"]);
        $sonuc=$_GET["GrupAdi"]. ' adlı grup ve üyeleri silindi.';
        header("Location:index.php?Sayfa=groups");
    }
    
    if(!empty($_GET["GrupAdi"]) && !empty($_GET["Islem"]) && $_GET["Islem"]=='GrupGuncelle'){
        $groups->gguncelle($_GET["GrupAdi"],$_POST["ih"],$_POST["yh"],$_POST["ya"]);
        $sonuc=$_GET["GrupAdi"]. ' adlı grup güncellendi.';
    }
    
    
if(empty($_GET["GrupAdi"])){ ?>
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1> Kullanıcı Grupları</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="?"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="#">Gruplar</a></li>
        </ul>
      </div>
	  <?php if(isset($_GET["Islem"]) && $_GET["Islem"]=="GrupEkle"){ ?>
	  <div class="row">
        <div class="col-md-12">
            <div class="tile">
              <div class="tile-body">
        <h3> Grup Ekle</h3>
        <hr>
         <form role="form" action="?Sayfa=groups" method="post">
                                        <div class="form-group">
                                            <label>Grup İsmi</label>
                                            <input id="gadi" name="gadi" required="required"  class="form-control">
                                            <p class="help-block">Gurup ismi giriniz.(Türkçe karekter içeremez)</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Grup Açıklaması</label>
                                            <input id="gaciklamasi" name="gaciklamasi" required="required"  class="form-control">
                                            <p class="help-block">Grup açıklaması giriniz.</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Yönlendirilecek Url</label>
                                            <input id="yonlendirme" name="yonlendirme"  class="form-control">
                                            <p class="help-block">http://vuydak.com</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Download Hızı</label>

                                            <input id="downh" required="required"  name="downh" type="text" class="form-control" id="inputSuccess">
                                            <p class="help-block">Download Hızı Mbit cinsinden giriniz.(4)</p>
                                        </div>
                                           <div class="form-group">
                                            <label>Upload Hızı</label>
                                            <input id="uph" name="uph" required="required"  class="form-control">
                                            <p class="help-block">Upload Hızı  Mbit cinsinden giriniz.(1)</p>
                                        </div>
                                          <button type="submit" class="btn btn-default">Kaydet</button>
		 </form>
                </div>
            </div>
        </div>
      </div>
      <?php } ?>
	  <div class="row">
        <div class="col-md-12">
       <?php if(!empty($sonuc)){ ?>
       <div class="alert alert-dismissible alert-info">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <h4>Sonuç !</h4>
                <p><?=$sonuc?></p>
              </div>
        <?php }?>
          <div class="tile">
            <div class="table-responsive">
             
              <table class="table">
                <thead>
                  <tr>
                    <th>Grup Adı</th>
                    <th>Grup Açıklaması</th>
                    <th>İndirme Hızı</th>
                    <th>Yükleme Hızı</th>
                    <th>Açılış sayfası</th>
                    <th>İşlem</th>
                  </tr>
                </thead>
                <tbody>
              <?php     foreach($groups->gruplistesi() as $item){  ?>
  
                  <tr>
                    <td><?=$item->grupadi?></td>
                    <td><?=$item->gaciklamasi?></td>
                    <td><?=$item->indirmehizi?></td>
                    <td><?=$item->yuklemehizi?></td>
                    <td><?=$item->yonlendirme?></td>
                    <td>
                    <a class="btn btn-primary waves-effect waves-light" href="index.php?Sayfa=groups&amp;GrupAdi=<?=$item->grupadi?>" role="button"> Detay</a>
                    <a class="btn btn-warning waves-effect waves-light" href="index.php?Sayfa=groups&amp;GrupAdi=<?=$item->grupadi?>&amp;Islem=GrupSil" role="button"> Sil</a></td>
                  </tr>
              <?php } ?>
                </tbody>
              </table>
              <a class="btn btn-primary icon-btn" href="?Sayfa=groups&Islem=GrupEkle"><i class="fa fa-plus"></i>Grup Ekle	</a>
            </div>
          </div>
        </div>
      </div>

    </main>
    
<?php } if(!empty($_GET["GrupAdi"])){ ?>
  <main class="app-content">
      <div class="app-title">
        <div>
          <h1> <?=$_GET["GrupAdi"]?> grup detayı</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><a href="?"><i class="fa fa-home fa-lg"></i></a></li>
          <li class="breadcrumb-item"><a href="?Sayfa=groups&">Gruplar</a></li>
          <li class="breadcrumb-item"><a href="?Sayfa=groups&GrupAdi=<?=$_GET["GrupAdi"]?>"><?=$_GET["GrupAdi"]?> grup</a></li>
        </ul>
      </div>
       <?php if(!empty($sonuc)){ ?>
       <div class="alert alert-dismissible alert-info">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <h4>Sonuç !</h4>
                <p><?=$sonuc?></p>
              </div>
        <?php }?>
      <?php $grupbilgisi=$groups->gbgetir($_GET["GrupAdi"]); ?>
      <div class="tile user-settings">
      <form role="form" action="?Sayfa=groups&GrupAdi=<?=$_GET["GrupAdi"]?>&Islem=GrupGuncelle" method="post">

                <h4 class="line-head">Grup detayları</h4>
                 <div class="row">
                   <div class="clearfix"></div>
                    <div class="col-md-3 mb-4">
                      <label>İnidrme Hızı (Mbit cinsinden)</label>
                      <input class="form-control" value="<?=$grupbilgisi->indirmehizi?>" name="ih" type="text"> 
                    </div>

                    <div class="col-md-3 mb-4">
                      <label>Yükleme hızı (Mbit cinsinden)</label>
                      <input class="form-control" value="<?=$grupbilgisi->yuklemehizi?>" name="yh" type="text">
                    </div>

                    <div class="col-md-3 mb-4">
                      <label>Yönlendirme (https kullanmayınız)</label>
                      <input class="form-control" value="<?=$grupbilgisi->yonlendirme?>" name="ya" type="text">
                    </div>
                    <div class="col-md-3 mb-4">
                      <label>İşlem</label><br>
                    <button type="submit" class="btn btn-default">Kaydet</button>
                                        </div>
                </form>
                  </div>
                 
              </div>
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
                                    <th>İşlem</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                           <?php foreach ($groups->okgetir($_GET["GrupAdi"]) as $item){ ?>
        
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
                    <td>
                    <a class="btn btn-primary waves-effect waves-light" href="index.php?Sayfa=userdetails&KullaniciAdi=<?=$item->kullaniciadi?>" role="button"> Detay</a>
                    <a class="btn btn-warning waves-effect waves-light" href="index.php?Sayfa=users&KullaniciAdi=<?=$item->kullaniciadi?>&Islem=Sil" role="button"> Sil</a></td>                
                    
                </tr>
                <?php } ?>
                                    
                                    
                                    </tbody>
                                </table>  
              
            </div>
          </div>
    </main>
<?php }?>
<?php 

    include 'foot.php';
 
