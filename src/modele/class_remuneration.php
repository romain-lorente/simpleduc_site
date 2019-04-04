<?php

class Remuneration{
    
    private $db;
    private $select;
    private $insert;
    private $update;
    private $selectById;
    private $delete;
    
    public function __construct($db){
        $this->db = $db;  
        $this->select = $db->prepare("select idRem, libelle, coutHoraire from Remuneration order by libelle");
        $this->insert = $db->prepare("insert into Remuneration(libelle, coutHoraire) values (:libelle, :coutHoraire)");
        $this->update = $db->prepare("update Remuneration set libelle=:libelle, coutHoraire=:coutHoraire where idRem=:idRem");
        $this->selectById = $db->prepare("select idRem, libelle, coutHoraire from Remuneration where idRem=:idRem order by libelle");
        $this->delete = $db->prepare("delete from Remuneration where idRem=:idRem");
    }
      
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
             print_r($this->select->errorInfo());  
        }
        return $this->select->fetchAll();
    }
    
    public function selectById($idRem){
        $this->selectById->execute(array(':idRem'=>$idRem));
        if ($this->selectById->errorCode()!=0){
             print_r($this->selectById->errorInfo());  
        }
        return $this->selectById->fetch();
    }
    
    public function insert($libelle, $coutHoraire){
        $r = true;
        $this->insert->execute(array(':libelle'=>$libelle, ':coutHoraire'=>$coutHoraire));
        if ($this->insert->errorCode()!=0){
             print_r($this->insert->errorInfo());  
             $r=false;
        }
        return $r;
    }
    public function update($idRem, $libelle, $coutHoraire){
        $r = true;
        $this->update->execute(array(':idRem'=>$idRem, ':libelle'=>$libelle, ':coutHoraire'=>$coutHoraire));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    public function delete($idRem){

        $r = true;

        $this->delete->execute(array(':idRem'=>$idRem));

        if ($this->delete->errorCode()!=0){

             print_r($this->delete->errorInfo());  

             $r=false;

        }

        return $r;

    }
    
}

?>
