<?php

function actionProjet($twig, $db){
    $form = array(); 
    $projet = new Projet($db);
    
    if(isset($_GET['code'])){
        $exec=$projet->delete($_GET['code']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table projet';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Projet supprimée avec succès';
     }
    
    $liste = $projet->select();
    echo $twig->render('projet.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionProjetAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputLibelle = $_POST['inputLibelle'];
      $inputIdEquipe = $_POST['inputIdEquipe']; 
      $form['valide'] = true;
      $projet = new Projet($db); 
      $exec = $projet->insert($inputLibelle, $inputIdEquipe);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table projet';  
      }
    }
    else{
        $equipe = new Equipe($db);
        $liste = $equipe->select();
        $form['liste'] = $liste;
    }
 
    echo $twig->render('projet-ajout.html.twig', array('form'=>$form)); 
}

function actionProjetModif($twig, $db){
    $form = array();   
    if(isset($_GET['code'])){
        $projet = new Projet($db);
        $unProjet = $projet->selectById($_GET['code']);  
        
        if ($unProjet!=null){
            $form['projet'] = $unProjet;
           
            $equipe = new Equipe($db);
			$liste = $equipe->select();
			$form['liste'] = $liste;
            
        }
        else{
            $form['message'] = 'Projet incorrect';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $code = $_POST['code'];  
          $libelle = $_POST['inputLibelle'];  
          $idEquipe = $_POST['inputIdEquipe'];
          $projet = new Projet($db);
          $exec = $projet->update($code, $libelle, $idEquipe);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification du projet'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Équipe non précisée';
        }    
     
    }
    
    echo $twig->render('projet-modif.html.twig', array('form'=>$form));
}


// WebService
function actionProjetWS($twig, $db){
   $projet = new Projet($db);
   $json = json_encode($liste = $projet->select()); 
   echo $json; 
}

