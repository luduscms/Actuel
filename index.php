<?php
if(file_exists('mysql/connexion.php'))
{
	/* Chargement des options */
	include('mysql/options.php');
	$ludus = charger_ludus();
	
	/* Chargement des fonctions MySQL */
	include('mysql/fonctions_read.php');
	include('mysql/fonctions_write.php');
	
	/* Démarrage de la session */
	session_start();
	
	/* Récupération des données sur l'utilisateur actuel */
	if(isset($_SESSION['id']))
	{
		$utilisateurActuel = chargerUtilisateur($ludus, $_SESSION['id'], 0, 1);
	}
	else
	{
		$utilisateurActuel = NULL;
	}
	if(isset($_GET['type']))
	{
		$typePage = $_GET['type'];
	}
	else
	{
		$typePage = 'principal';
	}
	
	if(!isset($_POST['action']))
	{
		switch($principal)
		{
			case 'principal':
				$urlPrincipal = '_principal.php';
			break;
			
			case 'user':
				$urlPrincipal = '_principal.php';
			break;
			
			case 'video':
				$urlPrincipal = 'panel/video/index.php';
			break;
			
			case 'admin':
				$urlPrincipal = 'panel/admin/index.php';
			break;
		}
		
		include($urlPrincipal);
	}
	else
	{
		switch($principal)
		{
			case 'default':
				$urlPrincipal = '_principal.php';
			break;
			
			case 'user':
				$urlPrincipal = '_principal.php';
			break;
			
			case 'video':
				$urlPrincipal = 'panel/video/index.php';
			break;
			
			case 'admin':
				$urlPrincipal = 'panel/admin/index.php';
			break;
		}
	}
}
else
{
	echo '<script type=\'text/javascript\'>document.location.replace(\'install/dbconnect/\');</script>';
}
?>