<?php
// Affichage des erreurs
$type_gestion = 1; // 1=>mode debug, 2=>mode production (erreur dans log/error.log), 0=>Aucun traitement
switch ($type_gestion) {
    case '1':
        if (PHP_VERSION_ID < 50400) error_reporting (E_ALL | E_STRICT);
        else error_reporting (E_ALL);
	ini_set('display_errors', true);
	ini_set('html_errors', false);
	ini_set('display_startup_errors',true);		  
        ini_set('log_errors', false);
	ini_set('error_prepend_string','<span style="color: red;">');
	ini_set('error_append_string','<br /></span>');
	ini_set('ignore_repeated_errors', true);
    break;
    case '2': 
        error_reporting (E_ALL);
	ini_set('display_errors', false);
	ini_set('html_errors', false);
	ini_set('display_startup_errors',false);
	ini_set('log_errors', true);
	ini_set('error_log', CHG_ROOT_PATH.'log/error.log');
	ini_set('error_prepend_string','<span style="color: red;">');
	ini_set('error_append_string','</span>');
	ini_set('ignore_repeated_errors', true);
    break;
    default:
	error_reporting (E_ALL);
	ini_set('display_errors', false);
	ini_set('html_errors', false);
	ini_set('display_startup_errors',false);
	ini_set('log_errors', false);
}
session_start();
/* initialisation des fichiers TWIG */
require_once '../src/lib/vendor/autoload.php';
require_once '../src/config/parametres.php';
require_once '../src/app/connexion.php';
require_once '../src/config/routing.php';
require_once '../src/controleur/_controleurs.php';
require_once '../src/modele/_classes.php';



$loader = new Twig_Loader_Filesystem('../src/vue/');
$twig = new Twig_Environment($loader, array());
$twig->addGlobal('session', $_SESSION);


$db = connect($config);   


$contenu = getPage($db);
// Exécution de la fonction souhaitée
$contenu($twig,$db);


?>
