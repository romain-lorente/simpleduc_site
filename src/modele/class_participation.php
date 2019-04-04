<?php

class Participation{
    
    private $db;
    private $insert;
    private $select;
    private $delete;
    private $update;
    private $selectById;
    private $selectByIdEquipe;

    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into Participation(idDev, idEquipe) values (:idDev, :idEquipe)");    
        $this->select = $db->prepare("select idDev, idEquipe from Participation");
        $this->delete = $db->prepare("delete from Participation where idDev=:idDev and idEquipe=:idEquipe");
        $this->update = $db->prepare("update Participation set idEquipe=:idEquipe where idDev=:idDev"); 
        $this->selectById = $db->prepare("select idDev, idEquipe from Participation where idDev=:idDev and idEquipe=:idEquipe");
        $this->selectByIdEquipe = $db->prepare("select idDev, idEquipe, equipe.libelle as libelle from Participation
												inner join equipe on Participation.idEquipe = equipe.id where idEquipe=:idEquipe");
    }
    
    public function insert($idDev, $idEquipe){
        $r = true;
      
        $this->insert->bindValue(':idDev', $idDev,PDO::PARAM_STR);
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
    
    public function selectByIdEquipe($idEquipe){
        $this->selectByIdEquipe->execute(array(':idEquipe'=>$idEquipe));
        if ($this->selectByIdEquipe->errorCode()!=0){
             print_r($this->selectByIdEquipe->errorInfo());  
        }
        return $this->selectByIdEquipe->fetchAll();
    }
    
    public function update($idEquipe, $idDev){
        $r = true;
        $this->update->execute(array(':idEquipe'=>$idEquipe, ':idDev'=>$idDev));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function selectById($idDev, $idEquipe){ 
        $this->selectById->execute(array(':idDev'=>$idDev, ':idEquipe'=>$idEquipe)); 
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectById->fetch(); 
    }
	
    public function delete($idDev, $idEquipe){
        $r = true;
        $this->delete->execute(array(':idDev'=>$idDev, ':idEquipe'=>$idEquipe));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());  
             $r=false;
        }
        return $r;
    }   
}
?>



