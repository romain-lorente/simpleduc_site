<?php

class Entreprise{
    
    private $db;
    private $select;
    private $insert;
    private $update;
    private $selectById;
    private $delete;
    
    public function __construct($db){
        $this->db = $db;  
        $this->select = $db->prepare("select idEntreprise, nom, adresse, cp, ville, nomContact from Entreprise order by nom");
        $this->insert = $db->prepare("insert into Entreprise(nom, adresse, cp, ville, nomContact) values (:nom, :adresse, :cp, :ville, :nomContact)");
        $this->update = $db->prepare("update Entreprise set nom=:nom, adresse=:adresse, cp=:cp, ville=:ville, nomContact=:nomContact where idEntreprise=:idEntreprise");
        $this->selectById = $db->prepare("select idEntreprise, nom, adresse, cp, ville, nomContact from Entreprise where idEntreprise=:idEntreprise");
        $this->delete = $db->prepare("delete from Entreprise where idEntreprise=:idEntreprise");
    }
      
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
             print_r($this->select->errorInfo());  
        }
        return $this->select->fetchAll();
    }
    
    public function selectById($idEntreprise){
        $this->selectById->execute(array(':idEntreprise'=>$idEntreprise));
        if ($this->selectById->errorCode()!=0){
             print_r($this->selectById->errorInfo());  
        }
        return $this->selectById->fetch();
    }
    
    public function insert($nom, $adresse, $cp, $ville, $nomContact){
        $r = true;
        $this->insert->execute(array(':nom'=>$nom, ':adresse'=>$adresse, ':cp'=>$cp, ':ville'=>$ville, ':nomContact'=>$nomContact));
        if ($this->insert->errorCode()!=0){
             print_r($this->insert->errorInfo());  
             $r=false;
        }
        return $r;
    }
    public function update($idEntreprise, $nom, $adresse, $cp, $ville, $nomContact){
        $r = true;
        $this->update->execute(array(':idEntreprise'=>$idEntreprise, ':nom'=>$nom, ':adresse'=>$adresse, ':cp'=>$cp, ':ville'=>$ville, ':nomContact'=>$nomContact));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    public function delete($idEntreprise){

        $r = true;

        $this->delete->execute(array(':idEntreprise'=>$idEntreprise));

        if ($this->delete->errorCode()!=0){

             print_r($this->delete->errorInfo());  

             $r=false;

        }

        return $r;

    }
    
}

?>
