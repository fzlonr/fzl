<?php
/*
*
* @ Author: Ali Can Tellioğlu / @alitelli <alicantellioglu@makinemuh.com>
* @ Web: http://makinemuh.com
* @ Licence: All right reserved.
*
*/ 


date_default_timezone_set('Europe/Istanbul');


ob_start();
session_start();
$giris_hata_mesaji=null;

if ($_SESSION['girisyaptimi'] == 'evet') {

      header("Location:index.php");
 
}

if(!empty($_POST["username"]) && !empty($_POST["userpassword"]) ){

    require_once 'db.php';

    $kullaniciadi=$_POST["username"];
    $sifre=$_POST["userpassword"];
    
    if($kullaniciadi=='' || $sifre =='' ){
        $giris_hata_mesaji='Kullanici adi veya Şifre boş olamaz !! || ŞAMPİYON TRABZONSPOR';
        
    }else{
    $k=$db->table('kullanicilar')->where("kullaniciadi",$kullaniciadi)->where("sifre",$sifre)->where("durum","aktif")->get();
    $c=$db->numRows();
        if( $c == 1 ){
            
    //           echo '<meta http-equiv="refresh" content="0;URL=xindex.php">';

            $_SESSION["girisyaptimi"] = "evet";
            $_SESSION["kullaniciadi"] = $kullaniciadi;
            $_SESSION["rutbe"] = $k->rutbe;
            $_SESSION["kid"] = $k->id;
            
                $simdikizaman=date("Y-m-d H:i:s", strtotime("now"));

            $cikis_tarih=date("Y-m-d H:i:s", strtotime("+5 minutes"));

        $oo=$db->table('kullanicilar')->where("kullaniciadi",$kullaniciadi)->where("rutbe",$k->rutbe)->update(["cikis_tarih" => "$cikis_tarih","ensonhangisayfada"=>"test"]);
            header("Location:index.php");
            
        }else{
        
                $giris_hata_mesaji='Hay aksi ! Bir sorun meydana geldi lütfen "Sistem Yöneticiniz" ile irtibata geçin.';


            }
        }
    }
