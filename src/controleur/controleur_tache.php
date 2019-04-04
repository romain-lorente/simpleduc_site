<?php

function actionTache($twig, $db){
    $form = array(); 
    $tache = new Tache($db);
    
     if(isset($_GET['id'])){
        $exec=$tache->delete($_GET['id']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table tâche';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Tâche supprimée avec succès';
     }

     $liste = $tache->select();
     echo $twig->render('tache.html.twig', array('form'=>$form,'liste'=>$liste));
}


function actionTacheAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputLibelle = $_POST['inputLibelle'];
      $inputCout = $_POST['inputCout'];
      $inputHoraire = $_POST['inputHoraire'];
      $inputIdDev = $_POST['inputIdDev']; 
      $inputCode_Projet = $_POST['inputCode_Projet'];    
      $form['valide'] = true;
      $tache = new tache($db); 
      $exec = $tache->insert($inputLibelle, $inputCout, $inputHoraire, $inputIdDev, $inputCode_Projet);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table Tache';
      }
    }
    else{
        $projet = new Projet($db);
		$developpeur = new Developpeur($db);
        $liste = $projet->select();
		$liste2 = $developpeur->select();
        $form['liste'] = $liste;
		$form['liste2'] = $liste2;
    }
 
    echo $twig->render('tache-ajout.html.twig', array('form'=>$form)); 
}

function actionTacheModif($twig, $db){
    $form = array();   
    if(isset($_GET['id'])){
        $tache = new Tache($db);
        $uneTache = $tache->selectByCode($_GET['id']);  
        
        if ($uneTache!=null){
            $form['tache'] = $uneTache;
           
            $dev = new Developpeur($db);
			$liste = $dev->select();
			$form['liste'] = $liste;
			  
			$projet = new Projet($db);
			$liste2 = $projet->select();
			$form['liste2'] = $liste2;
        }
        else{
            $form['message'] = 'Tâche incorrecte';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
            $code = $_POST['inputCode'];
		    $libelle = $_POST['inputLibelle'];
		    $cout = $_POST['inputCout']; 
		    $horaire = $_POST['inputHoraire'];    
		    $idDev = $_POST['inputIdDev'];
		    $code_Projet = $_POST['inputCode_Projet'];
            $tache = new Tache($db);
            $exec = $tache->update($libelle, $cout, $horaire, $idDev, $code_Projet, $code);
		    if(!$exec){
				$form['valide'] = false;  
				$form['message'] .= 'Echec de la modification de la tâche.'; 
		    }
		    else{
			$form['valide'] = true;  
			$form['message'] = 'Modification réussie';  
		    } 
          
        }
        else{
            $form['message'] = 'Tâche non précisée';
        }    
     
    }
    
    echo $twig->render('tache-modif.html.twig', array('form'=>$form));
}
?>

