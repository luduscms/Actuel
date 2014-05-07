<?php
if(isset($_GET['page']))
{
	$pageActuelle = $_GET['page'];
}
else
{
	$pageActuelle = 'panel';
}

if($utilisateurActuel != NULL || ($pageActuelle == 'connexion' || $pageActuelle == 'inscription') )
{
	/* Détermination de la page et extraction de données MySQL */

	if(!($pageActuelle == 'connexion' || $pageActuelle == 'inscription') && !isset($_SESSION['id']))
	{
		echo '<script type=\'text/javascript\'>document.location.replace(\''.$ludus['options']['rootURL'].'/user/connexion/\');</script>';
	}

	$nomPage = 'Panel Utilisateur';
	switch($pageActuelle)
	{
		case 'panel':
			$urlPage = '_panel.php';
		break;
		
		case 'connexion':
			$nomPage .= ' | Connexion';
			$urlPage = '_connexion.php';
		break;
		
		case 'deconnexion':
			$nomPage .= ' | Déconnexion';
			$urlPage = '_deconnexion.php';
		break;
		
		case 'inscription':
			$nomPage .= ' | Inscription';
			$urlPage = '_inscription.php';
		break;
			
		case 'changepw':
			$nomPage .= ' | Changer de mot de passe';
			$urlPage = '_changepw.php';
		break;
		
		case 'addavatar':
			$nomPage .= ' | Ajouter un avatar';
			$urlPage = '_addavatar.php';
		break;
		
		case 'editavatar':
			$nomPage .= ' | Éditer un avatar';
			$urlPage = '_editavatar.php';
		break;
		
		case 'delavatar':
			$nomPage .= ' | Supprimer un avatar';
			$urlPage = '_delavatar.php';
		break;
		
		case 'editbio':
			$nomPage .= ' | Éditer ma bio';
			$urlPage = '_editbio.php';
		break;
		
		case 'like':
			$nomPage .= ' | Aimer une vidéo';
			$urlPage = '_like.php';
		break;
		
		case 'comment':
			$nomPage .= ' | Commenter une vidéo';
			$urlPage = '_comment.php';
		break;
	}
?>
	<!DOCTYPE html>

	<HTML>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" href="<?php echo $ludus['options']['rootURL'].'/panel/user/' ?>style.css" />
			
			<title><?php echo $nomPage ?></title>
		</head>
		<body>
			<?php include($urlPage); ?>
		</body>
	</HTML>
<?php
}
else
{
	$redirection = $ludus['options']['rootURL'].'/user/connexion/';
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$redirection.'\');</script>';
}
?>