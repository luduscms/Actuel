<?php
	/* Démarrage de la session */
	session_start();
	
	$_SESSION = array();
	session_destroy();
?>

<!DOCTYPE html>

<HTML>
	<head>
		<meta charset="utf-8">
		<title>Installation de Ludus</title>
	</head>
	<body>
	
	<?php
		if(isset($_GET['page']))
		{
			switch($_GET['page'])
			{
				case 'dbconnect':
					include("_dbconnect.php");
				break;
				
				case 'options':
					include("_options.php");
				break;
				
				case 'adminuser':
					include("_admin.php");
				break;
			}
		}
	?>
	
	</body>
</HTML>