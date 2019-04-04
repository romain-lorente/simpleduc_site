<?php

function actionParticipation($twig, $db){
    $form = array(); 
    $part = new Participation($db);
    
    if(isset($_GET['idDev']) && isset($_GET['idEquipe'])){
        $exec=$part->delete($_GET['idDev'], $_GET['idEquipe']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table participation';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Membre de l\'équipe retiré avec succès';
     }
    
    $liste = $part->selectByIdEquipe($_GET['idEquipe']);
	$idEquipe = $_GET['idEquipe'];
	$equipe = new Equipe($db);
	$liste2 = $equipe->selectById($_GET['idEquipe']);
	$nomEquipe = $liste2['libelle'];
	
    echo $twig->render('participation.html.twig', array('form'=>$form, 'liste'=>$liste, 'nomEquipe'=>$nomEquipe, 'unIdEquipe'=>$idEquipe));
}

function actionParticipationAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputIdDev = $_POST['inputIdDev'];
      $form['valide'] = true;
      $part = new Participation($db); 
      $exec = $part->insert($inputIdDev, $_GET['idEquipe']);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table participation';  
      }
    }
    else{
        $dev = new Developpeur($db);
        $liste = $dev->selectNotMembers($_GET['idEquipe']);
        $form['liste'] = $liste;
    }
 
    echo $twig->render('participation-ajout.html.twig', array('form'=>$form, 'unIdEquipe'=>$_GET['idEquipe'])); 
}

// WebService
function actionParticipationWS($twig, $db){
   $part = new Participation($db);
   $json = json_encode($liste = $part->select()); 
   echo $json; 
}

