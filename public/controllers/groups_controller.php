<?php

    include 'controllers/users_controller.php';

    class groups extends users{
    
    
        public function __construct($db){
        
            $this->db=$db;
        
        }
        
        public function gruplistesi(){
        
            return $this->db->table('grupbilgisi')->getAll();
            
        }
        
        public function gbgetir($gadi){
        
            return $this->db->table('grupbilgisi')->where("grupadi",$gadi)->get();
        
        }
    
        public function grupekle($gadi,$gaciklamasi,$downh1,$uph1,$yonlendirme){
            $downh=$downh1*1024000; $uph=$uph1*1024000;
            $this->db->table('grupbilgisi')->where("grupadi",$gadi)->get();
            
            if($this->db->numRows() < 1){
        
                $radgroupreply = [
                        "groupname" => "$gadi",
                        "attribute" => "WISPr-Bandwidth-Max-Down",
                        "op" => ":=",
                        "value" => "$downh"
                            ];
                $radgroupreply1 = [
                        "groupname" => "$gadi",
                        "attribute" => "WISPr-Bandwidth-Max-Up",
                        "op" => ":=",
                        "value" => "$uph"
                            ];
                $radgroupreply2 = [
                        "groupname" => "$gadi",
                        "attribute" => "WISPr-Redirection-URL",
                        "op" => "==",
                        "value" => "$yonlendirme"
                            ];
                $grupbilgisi = [
                        "grupadi" => "$gadi",
                        "gaciklamasi" => "$gaciklamasi",
                        "indirmehizi" => "$downh1",
                        "yuklemehizi" => "$uph1",
                        "yonlendirme" => "$yonlendirme"
                            ];
                $this->db->table('radgroupreply')->insert($radgroupreply);
                $this->db->table('radgroupreply')->insert($radgroupreply1);
                $this->db->table('radgroupreply')->insert($radgroupreply2);
                $this->db->table('grupbilgisi')->insert($grupbilgisi);
                
            }else{
            
                $this->error="Grup adi benzersiz olmalı";
                $this->hata();
            
            }
        }
        
        public function grupsil($gadi){
        
            $grupuyeleri=$this->db->table('kullanicibilgisi')->where("grupadi", "$gadi")->getAll();
            foreach($grupuyeleri as $item){
                $this->db->table('radcheck')->where('username',$item->kullaniciadi)->delete();
            }
            $this->db->table('radgroupreply')->where('groupname',$gadi)->delete();
            $this->db->table('radgroupcheck')->where('groupname',$gadi)->delete();
            $this->db->table('radusergroup')->where('groupname',$gadi)->delete();
            $this->db->table('grupbilgisi')->where('grupadi',$gadi)->delete();
            $this->db->table('kullanicibilgisi')->where('grupadi',$gadi)->delete();
        
        
        
        }
        
        public function gguncelle($gadi,$ih,$yh,$ya){
            $ih1=$ih*1024000;
            $yh1=$yh*1024000;
            $radgroupreply = [
                "attribute" => "WISPr-Bandwidth-Max-Down",
                "op" => ":=",
                "value" => "$ih1"
                    ];
            $radgroupreply1 = [
                "attribute" => "WISPr-Bandwidth-Max-Up",
                "op" => ":=",
                "value" => "$yh1"
                    ];
            $radgroupreply2 = [
                "attribute" => "WISPr-Redirection-URL",
                "op" => "==",
                "value" => "$ya"
                    ];
                    
            $grupbilgisi = [
                "indirmehizi" => "$ih",
                "yuklemehizi" => "$yh",
                "yonlendirme" => "$ya"
                    ];
            $this->db->table('radgroupreply')->where("groupname", "$gadi")->where("attribute", "WISPr-Bandwidth-Max-Down")->update($radgroupreply);
            $this->db->table('radgroupreply')->where("groupname", "$gadi")->where("attribute", "WISPr-Bandwidth-Max-Up")->update($radgroupreply1);
            $this->db->table('radgroupreply')->where("groupname", "$gadi")->where("attribute", "WISPr-Redirection-URL")->update($radgroupreply2);
            $this->db->table('grupbilgisi')->where("grupadi", "$gadi")->update($grupbilgisi);
            
            $kullanici = [
                    "indirmehizi" => "$ih",
                    "yuklemehizi" => "$yh"
                            ];
            $this->db->table('kullanicibilgisi')->where("grupadi", "$gadi")->update($kullanici);    
        }
        private function hata(){
        
            $msg = '<div data-notify="container" class="notify-alert alert alert-danger animated fadeInDown" role="alert" data-notify-position="top-center" style="display: inline-block; margin: 0px auto; position: fixed; transition: all 0.5s ease-in-out 0s; z-index: 1031; top: 20px; left: 0px; right: 0px; animation-iteration-count: 1;"><button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button><span data-notify="icon" class="fa fa-check"></span> <span data-notify="title">Hata : </span> <span data-notify="message">'.$this->error.'</span><a href="#" target="_blank" data-notify="url"></a></div>';
              
                echo $msg;
            
            
        }
    
    
    
    
    }
