<?php 

 $phpVersion = phpversion();
 if (version_compare($phpVersion, '5.4.0', '<')){
	die("PHP 5.4.0 veya daha yeni bir php sunucusu gerekiyor. Sizin php sunucunuzun versiyonu : $phpVersion.");
 }
 


 $burak="Adamsın";

 include "classes/check.php";
 
 $sayfa="main";
 
 if(!empty($_GET["Sayfa"])){
     
     $sayfa=$_GET["Sayfa"];
 }
 
 if ($_SESSION['girisyaptimi'] != 'evet') {

      $sayfa="login";
     
 }

 require 'db.php';
 
 $controllerfilepath='controllers/'.$sayfa.'_controller.php';
 
 if(file_exists("$controllerfilepath") && file_exists("$sayfa.php")){
     
    require "$controllerfilepath";
    include "$sayfa.php";
 }else{
     
     include 'error.php';
     
 }
 
