<?php
	include('../options.php');
	/* Démarrage de la session */
	session_start();
	
	/* Connexion à la base de données */
	try
	{
		$bdd = new PDO('mysql:host='.$options['host'].';dbname='.$options['dbname'], $options['user'], $options['pass']);
		$bdd->query('SET NAMES utf8');
	}
	catch (Exception $e)
	{
			die('Erreur : ' . $e->getMessage());
	}
?>

<?php
	if(isset($_POST['type']) && isset($_SESSION['id']))
	{		
		if($_POST['type'] == 'edit')
		{
			$req = $bdd->prepare('UPDATE '.$options['prefixeTable'].'videos SET nom = :nom, url = :url, img = :img, description = :description WHERE id = :id');
			$req->execute(array(
				'id' => $_POST['id'],
				'nom' => stripslashes($_POST['nom']),
				'url' => $_POST['url'],
				'img' => $_POST['img'],
				'description' => '<p>'.str_replace("\n", '</p><br /><p>', stripslashes($_POST['description'])).'</p>' ));
			
			$req = $bdd->prepare('SELECT id, identifiant FROM '.$options['prefixeTable'].'videos WHERE id = :id');
			$req->execute(array(
				'id' => $_POST['id']));
			$donneesVideoActuelle = $req->fetch();
			
			$back = $options['rootURL'].'/video/'.$donneesVideoActuelle['identifiant'];
		}
		
		if($_POST['type'] == 'remove')
		{
			if($_POST['confirmation'] == 1)
			{
				$req = $bdd->prepare('DELETE FROM '.$options['prefixeTable'].'videos WHERE id = :id');
				$req->execute(array(
					'id' => $_POST['id']));
				
				$back = $options['rootURL'].'/';
			}
		}
		
		echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
	}
?>