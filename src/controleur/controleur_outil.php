<?php

function actionOutil($twig, $db){
    $form = array(); 
    $comp = new Outil($db);
    
    if(isset($_GET['id'])){
        $exec=$comp->delete($_GET['id']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table outils';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Outil supprimé avec succès';
     }
    
    $liste = $comp->select();
    echo $twig->render('outil.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionOutilAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputLibelle = $_POST['inputLibelle'];
	  $inputVersion = $_POST['inputVersion'];
      $form['valide'] = true;
      $comp = new Outil($db); 
      $exec = $comp->insert($inputLibelle, $inputVersion);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table outils';  
      }
    }
 
    echo $twig->render('outil-ajout.html.twig', array('form'=>$form)); 
}

function actionOutilModif($twig, $db){
    $form = array();   
    if(isset($_GET['id'])){
        $comp = new Outil($db);
        $uneComp = $comp->selectById($_GET['id']);  
        
        if ($uneComp!=null){
            $form['outil'] = $uneComp;
        }
        else{
            $form['message'] = 'Outil incorrect';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $id = $_POST['id'];  
          $libelle = $_POST['inputLibelle'];  
		  $version = $_POST['inputVersion']; 
          $comp = new Outil($db);
          $exec = $comp->update($id, $libelle, $version);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification de l\'outil'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
     
    }
    
    echo $twig->render('outil-modif.html.twig', array('form'=>$form));
}


// WebService
function actionOutilWS($twig, $db){
   $comp = new Outil($db);
   $json = json_encode($liste = $comp->select()); 
   echo $json; 
}

