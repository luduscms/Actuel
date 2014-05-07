<?php
if(isset($_GET['page']))
{
	$pageActuelle = $_GET['page'];
}
else
{
	$pageActuelle = 'panel';
}

if($utilisateurActuel != NULL)
{
	if($utilisateurActuel['statut']['canPostVideos'])
	{
		/* Détermination de la page et extraction de données MySQL */	
		$nomPage = 'Panel Vidéomaker';
		switch($pageActuelle)
		{
			case 'add':
				$nomPage .= ' | Ajouter une vidéo';
				$urlPage = '_add.php';
			break;
			
			case 'edit':
				$nomPage .= ' | Éditer une vidéo';
				$urlPage = '_edit.php';
			break;
			
			case 'remove':
				$nomPage .= ' | Supprimer une vidéo';
				$urlPage = '_remove.php';
			break;
		}
?>
		<!DOCTYPE html>

		<HTML>
			<head>
				<meta charset="utf-8">
				<link rel="stylesheet" href="<?php echo $ludus['options']['rootURL'].'/panel/video/' ?>style.css" />
				<link rel="icon" type="image/png" href="<?php echo $ludus['options']['rootURL'].'/panel/video/data/favicon.png' ?>" />
				<title><?php echo $nomPage ?></title>
			</head>
			<body>
			
			<?php include($urlPage) ?>
			
			</body>
		</HTML>
<?php
	}
}
?>