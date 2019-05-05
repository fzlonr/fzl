<?php
ob_start();
    class adduser {
    
        public function __construct($db,$grup) {
        
            $this->db= $db;
            $this->grup= $grup; // Kullanıcı grubu
            
            $bilgi = $this->db->table('grupbilgisi')->where('grupadi', $this->grup)->get();
            $this->grupadi=$bilgi->grupadi;
            $this->indirmehizi=$bilgi->indirmehizi;
            $this->yuklemehizi=$bilgi->yuklemehizi;
            
        }
        
        
        
        public function kullanıcıekle($kadi,$sifre,$gtarihi,$ad,$tc,$tel,$yer,$yerg){
        
            $gtarihi = DateTime::createFromFormat('d/m/Y', $gtarihi)->format('d M Y');
            if(!empty($yer) && !empty($yerg)){
            
                $bilgi = $this->db->table('grupbilgisi')->where('grupadi', $yerg)->get();
                $this->indirmehizi=$bilgi->indirmehizi;
                $this->yuklemehizi=$bilgi->yuklemehizi;
            }
            if(empty($tel)) $tel="Girilmemiş";
            $this->db->table('kullanicibilgisi')->where("kullaniciadi",$kadi)->get();
            if($this->db->numRows() < 1){
            
                if($yer=='portal'){
                    $grupadi=$yerg;
                }else{
                    $grupadi=$this->grupadi;
                    $yer="Elle eklendi.";
                }
                if(!empty($grupadi)){
                
                $p_a=$this->db->table('ayarlar')->where("id",1)->get();
                if($p_a->tckmlikonay=='evet'){
                        $radcheck = [
                        "username" => $kadi,
                        "attribute" => "Hesap-KAPALI",
                        "op" => ":=",
                        "value" => $sifre,
                        "onay" => "hayir"
                                ];
                    $this->sonuc="Hesabınız ancak yönetici onayından sonra aktif olur. Kaydınız hakkında yöneticinizi bilgilendirmeyi unutmayın.";
                    $this->sonucturu="warning";
                    $this->sonuc();
                    $onaydurumu="hayir";
                }else{
                    $radcheck = [
                        "username" => $kadi,
                        "attribute" => "Cleartext-Password",
                        "op" => ":=",
                        "value" => $sifre,
                        "onay" => "evet"
                                ];
                    $onaydurumu="evet";
                }                
                    $radcheck1 = [
                        "username" => $kadi,
                        "attribute" => "Expiration",
                        "op" => ":=",
                        "value" => $gtarihi
                                ];
                    $this->db->table('radcheck')->insert($radcheck);
                    $this->db->table('radcheck')->insert($radcheck1);
                    $radusergroup = [
                        "username" => "$kadi",
                        "groupname" => $grupadi
                                ];
                    $this->db->table('radusergroup')->insert($radusergroup);
                    
                    $kullanici = [
                        "kdurumu" => "aktif",
                        "kayitturu" => $yer,
                        "kullaniciadi" => $kadi,
                        "adsoyad" => $ad,
                        "tcno" => $tc,
                        "tel" => $tel,
                        "grupadi" => $grupadi,
                        "onay" => "$onaydurumu",
                        "indirmehizi" => $this->indirmehizi,
                        "yuklemehizi" => $this->yuklemehizi,
                        "gtarihi" => $gtarihi
                                ];
                    $this->db->table('kullanicibilgisi')->insert($kullanici);
                    
            
                    if($yer=='portal'){
                        $this->sonuc="Başarıyla kaydoldunuz.<br>Kullanıcı adı:$kadi <br>Şifre:$sifre";
                        $this->sonucturu="success";
                        $this->sonuc();                    
                    }else{
                    
                        header("Location:?Sayfa=userdetails&KullaniciAdi=$kadi");

                    }
                    
                }else{
                    $this->sonuc="Grup bilgisi boş olamaz.";
                    $this->sonucturu="danger";
                    $this->sonuc();
                }
            }else{
            
                $this->sonuc="Kullanıcı adı kullanımda benzersiz olmalı.";
                $this->sonucturu="danger";
                $this->sonuc();
                if($yer="portal"){
                    $this->sonuc="Zaten bir hesabınız var.<br>Kullanıcı adı:$kadi <br>Şifre:$sifre";
                    $this->sonucturu="warning";
                    $this->sonuc();
                }
                
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
