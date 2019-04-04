<?php

class Maitrise{
    
    private $db;
    private $insert;
    private $select;
    private $delete;
    private $update;
    private $selectById;
    private $selectByIdDev;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into Maitrise(idComp, idDev, niveau) values (:idComp, :idDev, :niveau)");    
        $this->select = $db->prepare("select idComp, idDev, competence.libelle, developpeur.email, niveau from Maitrise
									inner join competence on Maitrise.idComp = competence.id
									inner join developpeur on Maitrise.idDev = developpeur.email");
        $this->delete = $db->prepare("delete from Maitrise where idComp=:idComp and idDev=:idDev");
        $this->update = $db->prepare("update Maitrise set niveau=:niveau where idComp=:idComp and idDev=:idDev"); 
        $this->selectById = $db->prepare("select idComp, idDev, niveau from Maitrise where idComp=:idComp and idDev=:idDev");
		$this->selectByCompetence = $db->prepare("select nom, prenom from Maitrise
									inner join developpeur on Maitrise.idDev = developpeur.email
									inner join utilisateur on developpeur.email = utilisateur.email
									where idComp = :idComp");
        $this->selectByIdDev = $db->prepare("select idComp, idDev, competence.libelle, competence.version, niveau from Maitrise
									inner join competence on Maitrise.idComp = competence.id		
									where idDev=:idDev");
    }
    
    public function insert($idComp, $idDev, $niveau){
        $r = true;
      
        $this->insert->bindValue(':idComp', $idComp,PDO::PARAM_STR);
        $this->insert->bindValue(':idDev', $idDev,PDO::PARAM_STR);
        $this->insert->bindValue(':niveau', $niveau,PDO::PARAM_STR); 
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
    
    public function selectByIdDev($idDev){
        $this->selectByIdDev->execute(array(':idDev'=>$idDev));
        if ($this->selectByIdDev->errorCode()!=0){
             print_r($this->selectByIdDev->errorInfo());  
        }
        return $this->selectByIdDev->fetchAll();
    }
    
    public function update($idComp, $idDev, $niveau){
        $r = true;
        $this->update->execute(array(':idComp'=>$idComp, ':idDev'=>$idDev, ':niveau'=>$niveau));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function selectById($idComp, $idDev){ 
        $this->selectById->execute(array(':idComp'=>$idComp, ':idDev'=>$idDev)); 
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectById->fetch(); 
    }
    public function delete($idComp, $idDev){
        $r = true;
        $this->delete->execute(array(':idComp'=>$idComp, ':idDev'=>$idDev));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    
}

?>



