<?php
function getPage($db){

// Inscrire vos contrôleurs ici    
$lesPages['accueil'] = "actionAccueil;0";
$lesPages['inscrire'] = "actionInscrire;0";
$lesPages['mentions'] = "actionMentions;0";
$lesPages['connexion'] = "actionConnexion;0";
$lesPages['deconnexion'] = "actionDeconnexion;0";
$lesPages['apropos'] = "actionApropos;0";
$lesPages['maintenance'] = "actionMaintenance;0";
$lesPages['utilisateur'] = "actionUtilisateur;0";
$lesPages['utilisateurmodif'] = "actionUtilisateurModif;1";
$lesPages['equipe'] = "actionEquipe;0";
$lesPages['equipeajout'] = "actionEquipeAjout;1";
$lesPages['equipemodif'] = "actionEquipeModif;1";
$lesPages['equipews'] = "actionEquipeWS;0";
$lesPages['outil'] = "actionOutil;1";
$lesPages['outilajout'] = "actionOutilAjout;1";
$lesPages['outilmodif'] = "actionOutilModif;1";
$lesPages['outilws'] = "actionOutilWS;0";
$lesPages['entreprise'] = "actionEntreprise;1";
$lesPages['entreprisemodif'] = "actionEntrepriseModif;1";
$lesPages['entrepriseajout'] = "actionEntrepriseAjout;1";
$lesPages['maitrise'] = "actionMaitrise;1";
$lesPages['maitriseajout'] = "actionMaitriseAjout;1";
$lesPages['maitrisemodif'] = "actionMaitriseModif;1";
$lesPages['maitrisews'] = "actionMaitriseWS;0";
$lesPages['developpeur'] = "actionDeveloppeur;1";
$lesPages['developpeurajout'] = "actionDeveloppeurAjout;1";
$lesPages['developpeurmodif'] = "actionDeveloppeurModif;1";
$lesPages['developpeurws'] = "actionDeveloppeurWS;0";
$lesPages['projet'] = "actionProjet;0";
$lesPages['projetajout'] = "actionProjetAjout;1";
$lesPages['projetmodif'] = "actionProjetModif;1";
$lesPages['projetws'] = "actionProjetWS;0";
$lesPages['contrat'] = "actionContrat;0";
$lesPages['contratajout'] = "actionContratAjout;1";
$lesPages['contratmodif'] = "actionContratModif;1";
$lesPages['contratws'] = "actionContratWS;0";
$lesPages['tache'] = "actionTache;0";
$lesPages['tacheajout'] = "actionTacheAjout;1"; 
$lesPages['tachemodif'] = "actionTacheModif;1"; 
$lesPages['participation'] = "actionParticipation;0";
$lesPages['participationajout'] = "actionParticipationAjout;1";
$lesPages['participationws'] = "actionParticipationWS;0";
$lesPages['remuneration'] = "actionRemuneration;0";
$lesPages['remunerationajout'] = "actionRemunerationAjout;1";
$lesPages['remunerationmodif'] = "actionRemunerationModif;1";
$lesPages['remunerationws'] = "actionRemunerationWS;0";


if ($db!=null){
  if(isset($_GET['page'])){
    // Nous mettons dans la variable $page, la valeur qui a été passée dans le lien
    $page = $_GET['page']; }
  else{
    // S'il n'y a rien en mémoire, nous lui donnons la valeur « accueil » afin de lui afficher une page
    //par défaut
    $page = 'accueil';
  }

  if (!isset($lesPages[$page])){
    // Nous rentrons ici si cela n'existe pas, ainsi nous redirigeons l'utilisateur sur la page d'accueil
    $page = 'accueil'; 
  }
  
  $explose = explode(";",$lesPages[$page]);
  $role = $explose[1];
  
  // Si le rôle nécessite de contrôler les droits
  if ($role != 0){
      // Nous vérifions que la personne est connectée
      if(isset($_SESSION['login'])){
        //Nous vérifions qu'elle a un rôle
        if(isset($_SESSION['role'])){
            
            if($role!=$_SESSION['role']){
               //Nous redigeons la personne vers la page d'acccueil car elle n'a pas le bon rôle 
               $contenu = 'actionAccueil';  
            }
            else{
               // La personne est autorisée à récupérer  
               $contenu = $explose[0]; 
            }
        }
        else{
           // Dans la session le rôle n'existe pas donc on va sur la page d'accueil 
           $contenu = 'actionAccueil'; 
        }
      }
      else{
        // La personne n'est pas connectée, donc on va sur la page d'accueil  
        $contenu = 'actionAccueil';  
      }
    }else{
      // Nous donnons du contenu non protégé  
      $contenu = $explose[0];   
    }
}
else{
   // La base de données n'est pas accessible
   $contenu = 'actionMaintenance';
}
// La fonction envoie le contenu
return $contenu; 

}
?>