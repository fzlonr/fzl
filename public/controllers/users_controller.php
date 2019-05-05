<?php

    class users {
    
        public function __construct($db,$tur) {
        
            $this->db= $db;
            $this->tur= $tur; // Kullanıcı türü
            
        }
        
        public function okgetir($grupadi){
            
            if(!empty($grupadi)){
                $kullanicilar=$this->db->table('kullanicibilgisi')->where('onay', 'evet')->where('grupadi', $grupadi)->getAll();
            }else{
                $kullanicilar=$this->db->table('kullanicibilgisi')->where('onay', 'evet')->getAll();
            }
            return $kullanicilar;
        }
        
        public function obkgetir(){
        
            $kullanicilar=$this->db->table('kullanicibilgisi')->where('onay', 'hayir')->getAll();
            return $kullanicilar;
        }
    
        public function kbsil($kadi){
            
            $this->db->table('kullanicibilgisi')->where('kullaniciadi', $kadi)->delete();
            
        }
        
        public function radsil($kadi){
            $this->db->table('radcheck')->where("username", "$kadi")->delete();
            $this->db->table('radreply')->where("username", "$kadi")->delete();
            $this->db->table('radusergroup')->where("username", "$kadi")->delete();
        }
        
        public function konayla($kadi){

            $radchecko = $this->db->table('radcheck')->where(["username" => "$kadi","attribute" => "Hesap-KAPALI"])->update(['attribute' => 'Cleartext-Password','onay' => 'evet']);
            $kbonay = $this->db->table('kullanicibilgisi')->where(["kullaniciadi" => "$kadi","onay" => "hayir"])->update(['onay' => 'evet']);
        
        }
        
       
    
    
    }
