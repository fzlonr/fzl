<?php 
require '/usr/local/www/actspot/db.php';	// veritabanı bağlantısı için
require '/usr/local/www/actspot/controllers/adduser_controller.php';	
class Dogrulama extends adduser {


    public function __construct($db){
        
        $this->db=$db;
        
    }
    
    public function soapicin($kelime){

            $k = array("ç","Ç","ğ","Ğ","ı","I","i","İ","ö","Ö","ş","Ş","ü","Ü");
            $b = array("Ç","Ç","Ğ","Ğ","I","I","İ","İ","Ö","Ö","Ş","Ş","Ü","Ü");
            $kelime=str_replace($k, $b, $kelime);
            $kelime=strtoupper($kelime);
            return $kelime;
    }   

 
    public function TcKimlik($tc_no,$ad,$soyad,$dogum_yili){
            $ad=$this->soapicin($ad);
            $soyad=$this->soapicin($soyad);
            $bilgiler = array(
                "tcno" => $tc_no,
                "isim" => $ad,
                "soyisim" => $soyad,
                "dogumyili" => $dogum_yili
            );
            $gonder = '<?xml version="1.0" encoding="utf-8"?>
            <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Body>
            <TCKimlikNoDogrula xmlns="http://tckimlik.nvi.gov.tr/WS">
            <TCKimlikNo>'.$bilgiler["tcno"].'</TCKimlikNo>
            <Ad>'.$bilgiler["isim"].'</Ad>
            <Soyad>'.$bilgiler["soyisim"].'</Soyad>
            <DogumYili>'.$bilgiler["dogumyili"].'</DogumYili>
            </TCKimlikNoDogrula>
            </soap:Body>
            </soap:Envelope>';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,            "https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx" );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_POST,           true );
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POSTFIELDS,    $gonder);
            curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
            'POST /Service/KPSPublic.asmx HTTP/1.1',
            'Host: tckimlik.nvi.gov.tr',
            'Content-Type: text/xml; charset=utf-8',
            'SOAPAction: "http://tckimlik.nvi.gov.tr/WS/TCKimlikNoDogrula"',
            'Content-Length: '.strlen($gonder)
            ));
            $gelen = curl_exec($ch);
            curl_close($ch);

            return strip_tags($gelen); // true veya false cevabı gelir

            
    }
    
    public function kullaniciekle($tcno,$ad,$soyad,$dogumyili){
    
        if($this->TcKimlik($tcno,$ad,$soyad,$dogumyili) == 'true'){
            // tc no dogru kayit işlemi yapalim
            $pa=$this->db->table('ayarlar')->where("id",1)->get();
            $sifre=substr($tcno, 0, 5); 
            $adsoyad=$ad.' '.$soyad;
            $this->kullanıcıekle($tcno,$sifre,"12/12/2099",$adsoyad,$tcno,null,"portal",$pa->tckimlikgrup);
            $this->kullaniciverileri[]=array("adsoyad"=>"$adsoyad","tcno"=>"$tcno","sifre"=>"$sifre");
            return $this->kullaniciverileri;
        }else{
            
            $this->sonuc="Tc kimlik doğrulaması yapılamadı.";
            $this->sonucturu="danger";
            $this->sonuc();
            
        }
        
        
    
    
    
    }
    
    private function sonuc(){
    
         echo '
        
        <div class="alert alert-'. $this->sonucturu .' alert-dismissable" style="margin-top:20px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'
                               . $this->sonuc .
        '</div>';
    
    
    }
    
    
    
    
    
}

$ayarlar=$db->table('ayarlar')->where("id",1)->get();

if(isset($_POST['irmagininakisinaolurumturkiyem'])){

    $jsilegelen = $_POST['irmagininakisinaolurumturkiyem'];
    $tcno = rtrim($jsilegelen["tcno"]); 
    $ad = rtrim($jsilegelen["ad"]);
    $soyad = rtrim($jsilegelen["soyad"]);
    $dogumyili= rtrim($jsilegelen["dogumyili"]); 
    
    $dogrulama= new Dogrulama($db);
    
    $dogrulama->kullaniciekle($tcno,$ad,$soyad,$dogumyili);

}
