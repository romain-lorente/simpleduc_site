<?php

class Outil{
    
    private $db;
    private $insert;
    private $select;
    private $delete;
    private $update;
    private $selectById;

    
    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into competence(libelle, version) values (:libelle, :version)");    
        $this->select = $db->prepare("select id, libelle, version from competence order by libelle, version");
        $this->delete = $db->prepare("delete from competence where id=:id");
        $this->update = $db->prepare("update competence set libelle=:libelle, version=:version where id=:id"); 
        $this->selectById = $db->prepare("select id, libelle, version from competence where id=:id");
    }
    
    public function insert($libelle, $version){
        $r = true;
        
        $this->insert->bindValue(':libelle', $libelle,PDO::PARAM_STR);
		$this->insert->bindValue(':version', $version,PDO::PARAM_STR); 
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
    
    public function update($id, $libelle, $version){
        $r = true;
        $this->update->execute(array(':id'=>$id, ':libelle'=>$libelle, ':version'=>$version));
        if ($this->update->errorCode()!=0){
             print_r($this->update->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    public function selectById($id){ 
        $this->selectById->execute(array(':id'=>$id)); 
        if ($this->selectById->errorCode()!=0){
            print_r($this->selectById->errorInfo()); 
            
        }
        return $this->selectById->fetch(); 
    }
	
    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));
        if ($this->delete->errorCode()!=0){
             print_r($this->delete->errorInfo());  
             $r=false;
        }
        return $r;
    }
    
    
}

?>



