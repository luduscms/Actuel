<?php
if(!isset($_POST['action']))
{
?>
	<article class="general">	
		<h1>Ajout d'une vidéo</h1>
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/video/add/">
			<p>
				<input type="hidden" name="action" /> <br />
				
				Nom <br /> <input type="text" name="nom" /> <br />
				URL de la vidéo <br /><input type="text" name="url" value="blabla.mp4" /> <br />
				URL de la miniature <br /> <input type="text" name="img" value="blabla.png" /> <br />
				Description : </br>
				<textarea name="description" rows="20" cols="90"></textarea>
				
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/' ?>';"/>
				<input type="submit" value="Créer" /> <br />
			</p>
		</form>
	</article>
<?php
}
else
{
	do
	{
		$characts = 'abcdefghijklmnopqrstuvwxyz';
		$characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
		$characts .= '1234567890'; 
		$id = ''; 
		for($i = 0; $i < 6 /* Longueur de l'identifiant */; $i++)
		{ 
			$id .= substr($characts, rand()%(strlen($characts)), 1);
		}
		
		$req = $ludus['mysql']['bdd']->prepare('SELECT id FROM '.$ludus['mysql']['prefixe'].'videos WHERE id = :id');
		$req->execute(array(
			'id' => $id));
		$donneesVideoAvecLeMemeId = $req->fetch();
	} while($donneesVideoAvecLeMemeId != NULL);
	
	$dateActuelle = date('Y-m-d H:i:s');
	
	$req = $ludus['mysql']['bdd']->prepare('INSERT INTO '.$ludus['mysql']['prefixe'].'videos(id, nom, auteur, url, img, published, description) VALUES(:id, :nom, :auteur, :url, :img, :published, :description)');
	$req->execute(array(
		'id' => $id,
		'nom' => $_POST['nom'],
		'auteur' => $_SESSION['id'],
		'url' => $_POST['url'],
		'img' => $_POST['img'],
		'published' => $dateActuelle,
		'description' => '<p>'.str_replace("\n", '</p><br /><p>', stripslashes($_POST['description'])).'</p>' ));
	
	/* $reqA = $bdd->prepare('INSERT INTO '.$options['prefixeTable'].'activity(user, type, date, video, content) VALUES(:user, :type, :date, :video, :content)');
	$reqA->execute(array(
		'user' => $_SESSION['id'],
		'type' => 'addvideo',
		'date' => $dateActuelle,
		'video' => $identifiant,
		'content' => '')); */
	
	$reqVA = $ludus['mysql']['bdd']->prepare('SELECT id, nom FROM '.$ludus['mysql']['prefixe'].'videos WHERE nom = :nom AND auteur = :auteur');
	$reqVA->execute(array(
		'nom' => $_POST['nom'],
		'auteur' => $_SESSION['id']));
	$donneesVideoActuelle = $reqVA->fetch();
	
	$back = $ludus['options']['rootURL'].'/video/'.$donneesVideoActuelle['id'];
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>