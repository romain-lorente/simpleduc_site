<?php
function actionEntreprise($twig, $db){
    

    $form = array(); 
    $entreprise = new Entreprise($db);
    
    if(isset($_GET['idEntreprise'])){
        $exec=$entreprise->delete($_GET['idEntreprise']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table entreprise';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Entreprise supprimée avec succès';
     }
    
    $liste = $entreprise->select();
    echo $twig->render('entreprise.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionEntrepriseAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputNom = $_POST['inputNom'];
      $inputAdresse = $_POST['inputAdresse'];
      $inputCp = $_POST['inputCp']; 
      $inputVille = $_POST['inputVille']; 
      $inputNomContact = $_POST['inputNomContact']; 
      $form['valide'] = true;
      $Entreprise = new Entreprise($db); 
      $exec = $Entreprise->insert($inputNom, $inputAdresse, $inputCp, $inputVille, $inputNomContact);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table entreprise';  
      }
    }
    else{
        $utilisateur = new Utilisateur($db);
        $liste = $utilisateur->select();
        $form['liste'] = $liste;
    }
 
    echo $twig->render('entreprise-ajout.html.twig', array('form'=>$form)); 
}

function actionEntrepriseModif($twig, $db){
    $form = array();   
    if(isset($_GET['idEntreprise'])){
        $entreprise = new Entreprise($db);
        $uneEntreprise = $entreprise->selectById($_GET['idEntreprise']);  
        
        if ($uneEntreprise!=null){
            $form['entreprise'] = $uneEntreprise;
           
            $utilisateur = new Utilisateur($db);
            $liste = $utilisateur->select();
            $form['liste'] = $liste;
            
        }
        else{
            $form['message'] = 'Entreprise incorrecte';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $idEntreprise = $_POST['idEntreprise'];
          $inputNom = $_POST['inputNom'];
          $inputAdresse = $_POST['inputAdresse'];
          $inputCp = $_POST['inputCp']; 
          $inputVille = $_POST['inputVille']; 
          $inputNomContact = $_POST['inputNomContact']; 
          $entreprise = new Entreprise($db);
          $exec = $entreprise->update($idEntreprise, $inputNom, $inputAdresse, $inputCp, $inputVille, $inputNomContact);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification del\'équipe'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Utilisateur non précisé';
        }    
     
    }
    
    echo $twig->render('entreprise-modif.html.twig', array('form'=>$form));
}

// WebService
function actionEntrepriseWS($twig, $db){
   $entreprise = new Entreprise($db);
   $json = json_encode($liste = $entreprise->select()); 
   echo $json; 
}

