<?php

if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");

date_default_timezone_set('Europe/Istanbul');


ob_start();
session_start();

if(isset($_GET["Logout"]) && $_GET["Logout"]=="true"){
     
    unset($_SESSION['kullaniciadi']);
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Benzersiz İd 
$saat = strtotime(date("H:i:s")); 
$uniqueid = md5(uniqid(mt_rand(), true)); 
$uniqueid .= $saat;


$kim= $_SESSION["kullaniciadi"];
$rutbe= $_SESSION["rutbe"];
$kid= $_SESSION["kid"];

// echo $kim .'-----'.$rutbe.'--------'.$kid.'---';
if(!empty($kim) && !empty($rutbe)   && !empty($kid) ){
    require "db.php";
    $gg=$db->table('kullanicilar')->where("kullaniciadi",$kim)->where("rutbe",$rutbe)->get();
    $simdikizaman=date("Y-m-d H:i:s", strtotime("now"));
    $operatormod=$gg->telefonmodu;
//     $gg->cikis_tarih
    
     if($gg->cikis_tarih < $simdikizaman){
     
         unset($_SESSION['kullaniciadi']);
         session_unset();
         session_destroy();
         
         $Giris_Hata=base64_encode("Uzun süredir işlem yapmadınız yeniden giriş yapınız.");
         header("Location: login.php?Giris_Hata=$Giris_Hata");
         exit;
     }


    ;
    
    $sayfaxx=explode('/',$_SERVER['PHP_SELF']);
    $sayfaxx=$sayfaxx[1];
    $sonipadresi=IpBul();

    $cikis_tarih=date("Y-m-d H:i:s", strtotime("+30 minutes"));

    $oo=$db->table('kullanicilar')->where("kullaniciadi",$kim)->where("rutbe",$rutbe)->update(["cikis_tarih" => "$cikis_tarih","ensonhangisayfada"=>"$sayfaxx","sonipadresi" => "$sonipadresi"]);



}

ob_end_flush();

function IpBul(){
 if(getenv("HTTP_CLIENT_IP")) {
 $ip = getenv("HTTP_CLIENT_IP");
 } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 $ip = getenv("HTTP_X_FORWARDED_FOR");
 if (strstr($ip, ',')) {
 $tmp = explode (',', $ip);
 $ip = trim($tmp[0]);
 }
 } else {
 $ip = getenv("REMOTE_ADDR");
 }
 return $ip;
}
$sayfada=20;
                function gidiyorum($nereye,$nezaman,$nasil){
                
                echo "<meta http-equiv='refresh' content='$nezaman;URL=$nereye.php$nasil'";
                
                }
