<?php

function actionMaitrise($twig, $db){
    $form = array(); 
    $maitrise = new Maitrise($db);
    
    if(isset($_GET['idComp']) && isset($_GET['idDev'])){
        $exec=$maitrise->delete($_GET['idComp'], $_GET['idDev']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table maîtrise';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Maitrise supprimée avec succès';
     }
    
    $liste = $maitrise->selectByIdDev($_GET['idDev']);
    echo $twig->render('maitrise.html.twig', array('form'=>$form,'liste'=>$liste,'unIdDev'=>$_GET['idDev']));
}

function actionMaitriseAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputIdComp = $_POST['inputIdComp'];
	  $inputIdDev = $_GET['idDev'];
      $inputNiveau = $_POST['inputNiveau']; 
      $form['valide'] = true;
      $maitrise = new Maitrise($db); 
      $exec = $maitrise->insert($inputIdComp, $inputIdDev, $inputNiveau);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table maitrise ';  
      }
    }
    else{
        $competence = new Outil($db);
        $liste = $competence->select();
        $form['liste'] = $liste;
    }
 
    echo $twig->render('maitrise-ajout.html.twig', array('form'=>$form, 'unIdDev'=>$_GET['idDev'])); 
}

function actionMaitriseModif($twig, $db){
    $form = array();   
    if(isset($_GET['idComp']) && isset($_GET['idDev'])){
        $maitrise = new Maitrise($db);
        $uneMaitrise = $maitrise->selectById($_GET['idComp'], $_GET['idDev']);
		$unDev = $_GET['idDev'];
        
        if ($uneMaitrise!=null){
            $form['maitrise'] = $uneMaitrise;
           
            $competence = new Outil($db);
			$liste = $competence->select();
			$form['liste'] = $liste;
        }
        else{
            $form['message'] = 'Maitrise incorrecte';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $inputIdComp = $_POST['inputIdComp'];
		  $unDev = $_POST['inputIdDev'];
          $inputNiveau = $_POST['inputNiveau'];
          $maitrise = new Maitrise($db);
          $exec = $maitrise->update($_POST['inputIdComp'], $_POST['inputIdDev'], $_POST['inputNiveau']);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification de la maîtrise'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Compétence ou développeur non précisé(e)';
        }    
     
    }
    
    echo $twig->render('maitrise-modif.html.twig', array('form'=>$form, 'unIdDev'=>$unDev));
}


// WebService
function actionMaitriseWS($twig, $db){
   $maitrise = new Maitrise($db);
   $json = json_encode($liste = $maitrise->select()); 
   echo $json; 
}

