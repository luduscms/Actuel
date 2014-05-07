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
	if($utilisateurActuel['statut']['canAdmin'])
	{
		$nomPage = 'Panel Administrateur';
		switch($pageActuelle)
		{
			case 'panel':
				$urlPage = '_panel.php';
			break;
			
			case 'edit':
				$urlPage = '_edit.php';
			break;
		}
	?>

	<!DOCTYPE html>

	<HTML>
		<head>
			<meta charset="utf-8">
			<link rel="stylesheet" href="<?php echo $ludus['options']['rootURL'].'/panel/admin/' ?>style.css" />
			
			<link rel="icon" type="image/png" href="data/favicon.png" />
			<title><?php echo $nomPage ?></title>
		</head>
		<body>
		
		<?php include($urlPage); ?>
		
		</body>
	</HTML>
<?php
	}
}
?>