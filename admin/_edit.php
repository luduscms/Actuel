<?php
if(isset($_GET['sousPage']))
{
	$sousPageActuelle = $_GET['sousPage'];
}
else
{
	$sousPageActuelle = 'adduser';
}

switch($sousPageActuelle)
{
	case 'adduser':
		$nomPage .= ' | Ajouter un utilisateur';
		$urlSousPage = 'edit/_user_add.php';
	break;
	
	case 'edituser':
		$nomPage .= ' | Éditer un utilisateur';
		$urlSousPage = 'edit/_user_edit.php';
	break;
	
	case 'deluser':
		$nomPage .= ' | Supprimer un utilisateur';
		$urlSousPage = 'edit/_user_delete.php';
	break;
	
	case 'addstatut':
		$nomPage .= ' | Ajouter un statut';
		$urlSousPage = 'edit/_statut_add.php';
	break;
	
	case 'editstatut':
		$nomPage .= ' | Éditer un statut';
		$urlSousPage = 'edit/_statut_edit.php';
	break;
	
	case 'delstatut':
		$nomPage .= ' | Supprimer un statut';
		$urlSousPage = 'edit/_statut_delete.php';
	break;
}

include($urlSousPage);
?>