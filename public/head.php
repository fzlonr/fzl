<?php 

$sayfabasligi .=" | ACTSPOT";
?>
<!DOCTYPE html>
<html lang="tr">
  <head>
    <meta name="description" content="actspot yönetim arayüzü.">
	<title><?=$sayfabasligi?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini rtl pace-done sidenav-toggled">
    <!-- Navbar-->
    <header class="app-header">
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
       
        
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="?Sayfa=yourprofile"><i class="fa fa-cog fa-lg"></i> Hesap Ayarlarınız</a></li>
            <li><a class="dropdown-item" href="?Logout=true"><i class="fa fa-sign-out fa-lg"></i> Çıkış Yap</a></li>
          </ul>
        </li>
      </ul>
    </header>
	
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?=$gg->adsoyad?></p>
          <p class="app-sidebar__user-designation"><?=$gg->rutbe?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Anasayfa</span></a></li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Kullanıcılar</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="?Sayfa=users&Tur=Onaylı"><i class="icon fa fa-circle-o"></i> Onaylı Kullanıcılar</a></li>
            <li><a class="treeview-item" href="?Sayfa=users&Tur=Onaysız" ><i class="icon fa fa-circle-o"></i> Onay Bekleyen Kullanıcılar</a></li>
            <li><a class="treeview-item" href="?Sayfa=adduser"><i class="icon fa fa-circle-o"></i> Kullanıcı Ekle</a></li>
            <!--<li><a class="treeview-item" href="index.php?Sayfa=users&Tur=Yasaklı"><i class="icon fa fa-circle-o"></i> Yasaklı Kullanıcılar</a></li>-->
          </ul>
        </li>
        <li><a class="app-menu__item" href="?Sayfa=groups"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Gruplar</span></a></li>
        <li><a class="app-menu__item" href="?Sayfa=settings"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Ayarlar</span></a></li>
        
        </li>
      </ul>
    </aside>
    
