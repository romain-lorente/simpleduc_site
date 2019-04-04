<?php

class Contrat{
    
    private $db;
    private $select;
    private $insert;
    private $update;
    private $selectById;
    private $delete;
    
    public function __construct($db){
        $this->db = $db;  
        $this->select = $db->prepare("select idContrat, dateDebut, dateFin, dateSignature, cout, Entreprise.nom, Projet.libelle from Contrat 
                                      INNER JOIN Entreprise ON Contrat.idEntreprise = Entreprise.idEntreprise 
                                      INNER JOIN Projet ON Contrat.code = Projet.code order by dateSignature");
        $this->insert = $db->prepare("insert into Contrat(dateDebut, dateFin, dateSignature, cout, code, idEntreprise) values (:dateDebut, :dateFin, :dateSignature, :cout, :code, :idEntreprise)");
        $this->update = $db->prepare("update Contrat set idContrat=:idContrat, dateDebut=dateDebut, dateFin=:dateFin, dateSignature=:dateSignature, cout=:cout, code=:code, idContrat=:idContrat");
        $this->selectById = $db->prepare("select idContrat, dateDebut, dateFin, dateSignature, cout, code, idEntreprise from Contrat where idContrat=:idContrat");
        $this->delete = $db->prepare("delete from Contrat where idContrat=:idContrat");
    }
      
    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
             print_r($this->select->errorInfo());  
        }
        return $this->select->fetchAll();
    }
    
    public function selectById($idContrat){
        $this->selectById->execute(array(':idContrat'=>$idContrat));
        if ($this->selectById->errorCode()!=0){
             print_r($this->selectById->errorInfo());  
        }
        return $this->selectById->fetch();
    }
    
    public function insert($dateDebut, $dateFin, $dateSignature, $cout, $code, $idEntreprise){
        $r = true;
        $this->insert->execute(array(':dateDebut'=>$dateDebut, ':dateFin'=>$dateFin, ':dateSignature'=>$dateSignature, ':cout'=>$cout, ':code'=>$code, ':idEntreprise'=>$idEntreprise));
        if ($this->insert->errorCode()!=0){
             print_r($this->insert->errorInfo());  
             $r=false;
        }
        return $r;
    }
    public function update($idContrat, $dateDebut, $dateFin, $dateSignature, $cout, $code, $idEntreprise){
        $r = true;
        $this->update->execute(array(':idEntreprise'=>$idEntreprise, ':nom'=>$nom, ':adresse'=>$adresse, ':cp'=>$cp, ':ville'=>$ville, ':nomContact'=>$nomContact));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    public function delete($idContrat){

        $r = true;

        $this->delete->execute(array(':idContrat'=>$idContrat));

        if ($this->delete->errorCode()!=0){

             print_r($this->delete->errorInfo());  

             $r=false;

        }

        return $r;

    }
    
}

?>