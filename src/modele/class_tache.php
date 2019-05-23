<?php

class Tache{
    
    private $db;
    private $insert;
    private $select;
    private $selectByCode;
    private $update;
    private $delete;
    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into tache(libelle, cout, horaire, idDev, code_Projet) values (:libelle, :cout, :horaire, :idDev, :code_Projet)");    
        $this->select = $db->prepare("select tache.code, tache.libelle, cout, horaire, idDev, code_Projet, Projet.libelle as libelleProjet
		from tache inner join Projet on tache.code_Projet = Projet.code order by libelleProjet, tache.libelle");
        $this->selectByCode = $db->prepare("select code, libelle, cout, horaire, idDev, code_Projet from tache where code=:code");
        $this->update = $db->prepare("update tache set libelle=:libelle, cout=:cout, horaire=:horaire, idDev=:idDev, code_Projet=:code_Projet where code=:code");
        $this->delete = $db->prepare("delete from tache where code=:code");
        }
    public function insert($libelle, $cout, $horaire, $idDev, $code_Projet){
        $r = true;
        $this->insert->execute(array(':libelle'=>$libelle, ':cout'=>$cout, ':horaire'=>$horaire, ':idDev'=>$idDev, ':code_Projet'=>$code_Projet));
        if ($this->insert->errorCode()!=0){
             print_r($this->insert->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
             print_r($this->select->errorInfo());  
        }
        return $this->select->fetchAll();
    }
    
    public function selectByCode($code){ 
        $this->selectByCode->execute(array(':code'=>$code)); 
        if ($this->selectByCode->errorCode()!=0){
            print_r($this->selectByCode->errorInfo()); 
            
        }
        return $this->selectByCode->fetch(); 
    }
    
    public function update($libelle, $cout, $horaire, $idDev, $code_Projet, $code){
        $r = true;
        $this->update->execute(array(':libelle'=>$libelle, ':cout'=>$cout, ':horaire'=>$horaire, ':idDev'=>$idDev, ':code_Projet'=>$code_Projet, ':code'=>$code));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function delete($code){
        $r = true;
        $this->delete->execute(array(':code'=>$code));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
}

?>

