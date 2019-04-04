<?php
function actionContrat($twig, $db){
    

    $form = array(); 
    $contrat = new Contrat($db);
    
    if(isset($_GET['idContrat'])){
        $exec=$contrat->delete($_GET['idContrat']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table Contrat';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Contrat supprimée avec succès';
     }
    
    $liste = $contrat->select();
    echo $twig->render('contrat.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionContratAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputDateDebut = $_POST['inputDateDebut'];
      $inputDateFin = $_POST['inputDateFin'];
      $inputDateSignature = $_POST['inputDateSignature']; 
      $inputCout = $_POST['inputCout']; 
      $inputCode = $_POST['inputCode'];
      $inputIdEntreprise = $_POST['inputIdEntreprise']; 
      $form['valide'] = true;
      $contrat = new Contrat($db); 
      $exec = $contrat->insert($inputDateDebut, $inputDateFin, $inputDateSignature, $inputCout, $inputCode, $inputIdEntreprise);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table contrat ';  
      }
    }
    else{
        $projet = new Projet($db);
        $entreprise = new Entreprise($db);
        $liste = $projet->selectAll();
        $liste2 = $entreprise->select();
        $form['liste'] = $liste;
        $form['liste2'] = $liste2;
    }
    echo $twig->render('contrat-ajout.html.twig', array('form'=>$form)); 
}

function actionContratModif($twig, $db){
    $form = array();   
    if(isset($_GET['idContrat'])){
        $contrat = new Contrat($db);
        $unContrat = $contrat->selectById($_GET['idContrat']);  
        
        if ($unContrat!=null){
            $form['contrat'] = $unContrat;
           
            $projet = new Projet($db);
            $liste = $projet->select();
            $entreprise = new Entreprise($db);
            $liste2 = $entreprise->select();
            $form['liste'] = $liste;
            $form['liste2'] = $liste2;
            

            
        }
        else{
            $form['message'] = 'Contrat incorrect';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
            $inputIdContrat = $_POST['inputIdContrat'];
            $inputDateDebut = $_POST['inputDateDebut'];
            $inputDateFin = $_POST['inputDateFin'];
            $inputDateSignature = $_POST['inputDateSignature']; 
            $inputCout = $_POST['inputCout']; 
            $inputCode = $_POST['inputCode'];
            $inputIdEntreprise = $_POST['inputIdEntreprise'];
          $contrat = new Contrat($db);
          $exec = $contrat->update($inputIdContrat, $inputDateDebut, $inputDateFin, $inputDateSignature, $inputCout, $inputCode, $inputIdEntreprise);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification du contrat'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }
        else{
            $form['message'] = 'Contrat non précisé';
        }    
     
    }
    
    echo $twig->render('contrat-modif.html.twig', array('form'=>$form));
}
// WebService
function actionContratWS($twig, $db){
   $contrat = new Contrat($db);
   $json = json_encode($liste = $contrat->select()); 
   echo $json; 
}

