 <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
   <?php if(isset($datatable)){ ?>
    <!-- Data table plugin-->
    <script type="text/javascript" src="js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script>
    
    <script type="text/javascript">

      
    $(document).ready(function() {
    $('#DataTablo').DataTable( {
        "language": {
            "lengthMenu": "_MENU_ Listede kaç adet gözüksün?",
            "zeroRecords": "Bişey Bulamadım",
            "info": "Şuan _PAGE_. sayfadasınız. Toplam _PAGES_ adet sayfa var.",
            "infoEmpty": "Kayıt bulunamadı!",
            "infoFiltered": "(Toplam _MAX_ adet içerik arasından bulundu.)",
            "search": "Arama Yap",
            "paginate": { "next": "Sonraki", "previous": "Önceki"}
        }
    } );
    } );

    </script>
    <?php } ?>
   
       <script type="text/javascript" src="js/plugins/bootstrap-datepicker.min.js"></script>
            <script type="text/javascript">
    $('#gtarihi').datepicker({
      	format: "dd/mm/yyyy",
      	autoclose: true,
      	todayHighlight: true
      });
      </script>
      
  </body>
</html>
