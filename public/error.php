<?php 
    if(!isset($burak)) die("Bunu yapmaya yetkin yok !!");
    $sayfabasligi="Hata ";
    include 'head.php';
?>

<main class="app-content">
      <div class="page-error tile">
        <h1><i class="fa fa-exclamation-circle"></i> Böyle bir sayfa yok</h1>
        <p>Sayfaları urle yazarak çağırmayın menülerden gezinti yapın.</p>
        <p><a class="btn btn-primary" href="javascript:window.history.back();">Geri Dön</a></p>
      </div>
    </main>

<?php 

    include 'foot.php';
