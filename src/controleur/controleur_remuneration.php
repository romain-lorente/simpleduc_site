<?php
function actionRemuneration($twig, $db){
    

    $form = array(); 
    $remuneration = new Remuneration($db);
    
    if(isset($_GET['idRem'])){
        $exec=$remuneration->delete($_GET['idRem']);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème de suppression dans la table rémunération';
        }
        else{
            $form['valide'] = true;
        }
        $form['message'] = 'Rémunération supprimée avec succès';
     }
    
    $liste = $remuneration->select();
    echo $twig->render('remuneration.html.twig', array('form'=>$form,'liste'=>$liste));
}

function actionRemunerationAjout($twig, $db){
    $form = array(); 
    if (isset($_POST['btAjouter'])){
      $inputLibelle = $_POST['inputLibelle'];
      $inputCoutHoraire = $_POST['inputCoutHoraire'];
      $form['valide'] = true;
      $remuneration = new Remuneration($db); 
      $exec = $remuneration->insert($inputLibelle, $inputCoutHoraire);
      if (!$exec){
        $form['valide'] = false;  
        $form['message'] = 'Problème d\'insertion dans la table remuneration';  
      }
    }
 
    echo $twig->render('remuneration-ajout.html.twig', array('form'=>$form)); 
}

function actionRemunerationModif($twig, $db){
    $form = array();   
    if(isset($_GET['idRem'])){
        $remuneration = new Remuneration($db);
        $uneRemuneration = $remuneration->selectById($_GET['idRem']);  
        
        if ($uneRemuneration!=null){
            $form['remuneration'] = $uneRemuneration;
        }
        else{
            $form['message'] = 'Rémunération incorrecte';  
        }
    }
    else{
        if(isset($_POST['btModifier'])){
          $idRem = $_POST['idRem'];
          $inputLibelle = $_POST['inputLibelle'];
          $inputCoutHoraire = $_POST['inputCoutHoraire'];
          $remuneration = new Remuneration($db);
          $exec = $remuneration->update($idRem, $inputLibelle, $inputCoutHoraire);
          if(!$exec){
                $form['valide'] = false;  
                $form['message'] .= 'Echec de la modification de la rémunération'; 
          }
          else{
            $form['valide'] = true;  
            $form['message'] = 'Modification réussie';  
          } 
          
        }   
    }
    
    echo $twig->render('remuneration-modif.html.twig', array('form'=>$form));
}

// WebService
function actionRemunerationWS($twig, $db){
   $remuneration = new Remuneration($db);
   $json = json_encode($liste = $remuneration->select()); 
   echo $json; 
}

