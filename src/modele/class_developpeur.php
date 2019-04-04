<?php

class Developpeur{
    
    private $db;
    private $insert;
    private $select;
	private $selectByEmail;
	private $selectNotMembers;
    private $delete;
    private $update;

    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into developpeur(email, idRem) values (:email, :idRem)");
        $this->select = $db->prepare("select email, libelle from developpeur inner join Remuneration on developpeur.idRem = Remuneration.idRem");
		$this->selectByEmail = $db->prepare("select email, idRem from developpeur where email=:email");
		$this->selectNotMembers = $db->prepare("select email from developpeur where email not in (select idDev from Participation where idEquipe=:idEquipe)");
        $this->delete = $db->prepare("delete from developpeur where email=:email");
        $this->update = $db->prepare("update developpeur set idRem=:idRem where email=:email"); 
    }
    
    public function insert($email, $idRem){
        $r = true;
      
        $this->insert->bindValue(':email', $email,PDO::PARAM_STR);
        $this->insert->bindValue(':idRem', $idRem,PDO::PARAM_STR); 
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
	
	public function selectNotMembers($idEquipe){ 
        $this->selectNotMembers->execute(array(':idEquipe'=>$idEquipe)); 
        if ($this->selectNotMembers->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectNotMembers->fetchAll(); 
    }
	
	public function selectByEmail($email){ 
        $this->selectByEmail->execute(array(':email'=>$email)); 
        if ($this->selectByEmail->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectByEmail->fetch(); 
    }
    
    public function update($email, $idRem){
        $r = true;
        $this->update->execute(array(':email'=>$email, ':idRem'=>$idRem));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function delete($email){
        $r = true;
        $this->delete->execute(array(':email'=>$email));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    
}

?>



