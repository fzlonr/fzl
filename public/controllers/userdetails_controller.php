<?php

    class userdetails {
        public $kverileri;

        public function __construct($db) {
        
            $this->db= $db;     
            
        }
        
        
        public function kdetayi($kadi){
        
            $kb=$this->db->table('kullanicibilgisi')->where(["kullaniciadi" => "$kadi"])->get();
            if(empty($kb->kayitturu)) $kb->kayitturu="Bilinmiyor";
            if(empty($kb->mobilno)) $kb->mobilno="Girilmemiş";
            if(empty($kb->gtarihi)) $kb->gtarihi="Girilmemiş";
            $this->kverileri[] = array('adsoyad' => $kb->adsoyad,'kayitturu' => $kb->kayitturu,'mobilno' => $kb->mobilno,'gtarihi' => $kb->gtarihi, 'tcno' => $kb->tcno,'grupadi' => $kb->grupadi);
            return $this->kverileri;
        }
    
        public function oturumdetaylari($kadi){
        
            $d=$this->db->table('radacct')->where("username","$kadi")->orderBy('radacctid', 'desc')->getAll();
            return $d;
        }
        
        public function sifredegis($kadi,$Ysifre){
        
            $this->db->table('radcheck')->where("username", "$kadi")->where("onay", "evet")->update(["value" => "$Ysifre"]);
        
        }
    
    
    
    }
