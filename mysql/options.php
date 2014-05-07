<?php
function charger_ludus()
{
	include("connexion.php");
	$mysql = connexion_mysql();
	
	/* Détermination des autres options */
	$reqO = $mysql['bdd']->prepare('SELECT * FROM '.$mysql['prefixe'].'options');
	$reqO->execute();
	$donneesOptions = $reqO->fetch();
	
	$options = array(
		/* Données importantes */
		'rootURL' => $donneesOptions['rootURL'],
		'theme' => $donneesOptions['theme'],
		'siteName' => $donneesOptions['siteName'],
		'inscription' => $donneesOptions['inscriptionAuthorized']);
	
	$ludus = array(
		'mysql' => $mysql,
		'options' => $options);
	
	include('./themes/'.$options['theme'].'/options.php');
	$theme = load_options_theme($ludus);
	$ludus = array_merge($ludus, array('theme' => $theme));
	
	return $ludus;
}
?>