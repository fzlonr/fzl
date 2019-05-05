<?php 

#TODO: Çevrim içi kulanıcılar listesi için sayfalama yapılacak.
	
    class main {
    
        public $db;
        
        public function __construct($db) {
        
            $this->db = $db;
            $this->sayfada=10; // Anasayfadaki çevrim içi kullanıcılar bölümünde sayfalama yapılması gerekir.
            
        }

        public function ksayisi(){
            
            $say=$this->db->pdo->query("SELECT * FROM kullanicibilgisi");
            return $say->rowCount();
            
        
        }
        public function obksayisi(){            
            $say=$this->db->pdo->query("SELECT * FROM kullanicibilgisi where onay='hayir'");
            return $say->rowCount();
            
        
        }
        
        public function gsayisi(){        
            $say = $this->db->pdo->query("SELECT * FROM grupbilgisi");
            return $say->rowCount();
        
        }
        
        public function toplamoturumsayisi(){        
            $say = $this->db->pdo->query("SELECT * FROM radacct");
            return $say->rowCount();
        
        }
        
        public function cevrimicikullanicisayisi(){
        
            $onl=$this->db->table('radacct')->where("acctterminatecause","")->getAll(); 
            return $this->db->numRows();
            
        }
        
        public function cevrimicikullanicilar(){
        
        
            $ck=$this->db->table('radacct as r')->join('kullanicibilgisi as k', 'r.username', 'k.kullaniciadi')->where("acctterminatecause","")->orderBy('r.radacctid', 'desc')->getAll();
            
            return $ck;
        
        }
    
    
    
    
    
    
    }
