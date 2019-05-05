 <?php 
    if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");
    $sayfabasligi="Ayarlar";
    include 'head.php';
    
    
    if( !empty($_POST["tcgrup"]) && !empty($_POST["tconay"]) ){
        $tcgrup=$_POST["tcgrup"];
        if($_POST["kayitsecenek"]=='tckimlik'){
            $tckimlikdurum='acik';
        }else{
            $tckimlikdurum='hayir';
        }
        $tckmlikonay=$_POST["tconay"];
        $data=["tckimlikgrup"=>"$tcgrup","tckmlikonay"=>"$tckmlikonay","tckimlikdurum"=>"$tckimlikdurum"];
        $db->table('ayarlar')->where("id",1)->update($data);
        $sonuc="Ayarlar güncellendi.";
    }
    $settings=$db->table('ayarlar')->get();
?>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1> Actspot Portal Ayarları</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Ayarlar</a></li>
        </ul>
      </div>
	  
	  <div class="col-md-12">
	  <?php if(isset($sonuc)){ ?>
	  <div class="alert alert-dismissible alert-success">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <p><?=$sonuc?></p>
              </div>
	  <?php }?>
          <div class="tile">
            <h3 class="tile-title">Portal Ayarları</h3>
            <div class="tile-body">
              <form class="row" method="post" action="?Sayfa=settings">
                <div class="form-group col-md-12">
              <p>Kullanılabilir kayıt seçenekleri</p>
              <div class="animated-checkbox">
              <label>
                <input type="checkbox" name="kayitsecenek" value="tckimlik" <?php if($settings->tckimlikdurum == 'acik') echo 'checked';?>><span class="label-text">TC Kimlik</span>
              </label>
            </div>
              
                  </div>
              
                <div class="form-group col-md-6">
                    <label for="exampleSelect1">TC Kimlik ile üye olan kullanıcıların ekleneceği grup.</label>
                    <select class="form-control" name="tcgrup">
                                                                                       	<?php
                                                                 	
$gruplar=$db->table('grupbilgisi')->getAll();
foreach ($gruplar as $gruptakiler) {
                $grupsec = $gruptakiler->grupadi;
                $gaciklamasi = $gruptakiler->gaciklamasi;
                $ok=null;
                if($settings->tckimlikgrup==$grupsec){
                    $ok='selected';
                }

echo "
                                           <option value='$grupsec' $ok>$gaciklamasi [$grupsec}</option>



                                       ";


   }
?>
                    </select>
                  </div>
                <div class="form-group col-md-6">
                    <label for="exampleSelect1">TC Kimlik ile üye olan kullanıcılar onay gerektirsin mi ?</label>
                    <select class="form-control" name="tconay">
                    <?php if($settings->tckmlikonay=='evet'){ ?>
                      <option value="evet" selected>Evet</option>
                      <option value="hayir">Hayir</option>
                      <?php }else{ ?>
                      <option value="evet" >Evet</option>
                      <option value="hayir" selected>Hayir</option>
                      <?php } ?>
                    </select>
                  </div>
               <div class="col-md-12">

        
                    <button class="btn btn-primary" type="submit">Kaydet</button>

                </div>
              </form>
            </div>
          </div>
        </div>
        

      
</main>
<?php 

    include 'foot.php';

