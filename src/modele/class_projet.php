<?php

class Projet{
    
    private $db;
    private $insert;
    private $select;
    private $delete;
    private $update;
    private $selectById;

    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into Projet(libelle, idEquipe) values (:libelle, :idEquipe)");    
        $this->select = $db->prepare("select code, Projet.libelle as libelleProjet, equipe.libelle as libelleEquipe from Projet left join equipe on Projet.idEquipe = equipe.id order by Projet.libelle");
		$this->selectAll = $db->prepare("select * from Projet");
        $this->delete = $db->prepare("delete from Projet where code=:code");
        $this->update = $db->prepare("update Projet set libelle=:libelle, idEquipe=:idEquipe where code=:code"); 
        $this->selectById = $db->prepare("select code, libelle, idEquipe from Projet where code=:code");
    }
    
    public function insert($libelle, $idEquipe){
        $r = true;    
        $this->insert->bindValue(':libelle', $libelle,PDO::PARAM_STR); 
        $this->insert->bindValue(':idEquipe', $idEquipe,PDO::PARAM_STR); 
        $this->insert->execute();
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
	
	public function selectAll(){
        $this->selectAll->execute();
        if ($this->selectAll->errorCode()!=0){
             print_r($this->selectAll->errorInfo());  
        }
        return $this->selectAll->fetchAll();
    }
    
    public function update($code, $libelle, $idEquipe){
        $r = true;
        $this->update->execute(array(':code'=>$code, ':libelle'=>$libelle, ':idEquipe'=>$idEquipe));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function selectById($code){ 
        $this->selectById->execute(array(':code'=>$code)); 
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectById->fetch(); 
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



