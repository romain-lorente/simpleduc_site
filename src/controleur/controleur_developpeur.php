<?php

function actionDeveloppeur($twig, $db){
    $form = array(); 
    $dev = new Developpeur($db);
    
    if(isset($_GET['email'])){
        $exec=$dev->delete($_GET['email']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table développeur';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Développeur supprimé avec succès';
     }
    
    $liste = $dev->select();
    echo $twig->render('developpeur.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionDeveloppeurAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputEmail = $_POST['inputEmail'];
      $inputIdRem = $_POST['inputIdRem']; 
      $form['valide'] = true;
      $dev = new Developpeur($db); 
      $exec = $dev->insert($inputEmail, $inputIdRem);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table développeur';  
      }
    }
    else{
        $utilisateur = new Utilisateur($db);
        $liste = $utilisateur->select();
        $form['liste'] = $liste;
		
		$rem = new Remuneration($db);
        $liste2 = $rem->select();
        $form['liste2'] = $liste2;
    }
 
    echo $twig->render('developpeur-ajout.html.twig', array('form'=>$form)); 
}

function actionDeveloppeurModif($twig, $db){
    $form = array();   
    if(isset($_GET['email'])){
        $dev = new Developpeur($db);
        $unDev = $dev->selectByEmail($_GET['email']);  
        
        if ($unDev!=null){
            $form['dev'] = $unDev;
            
			$rem = new Remuneration($db);
			$liste = $rem->select();
			$form['liste'] = $liste;
        }
        else{
            $form['message'] = 'Développeur incorrect';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){ 
		  $email = $_POST['inputEmail'];
          $idRem = $_POST['inputIdRem'];
          $dev = new Developpeur($db);
          $exec = $dev->update($email, $idRem);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification du développeur'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Utilisateur ou identifiant de rémunération non précisé';
        }    
     
    }
    
    echo $twig->render('developpeur-modif.html.twig', array('form'=>$form));
}


// WebService
function actionDeveloppeurWS($twig, $db){
   $dev = new Developpeur($db);
   $json = json_encode($liste = $dev->select()); 
   echo $json; 
}

