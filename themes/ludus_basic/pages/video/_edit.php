<?php
if(!isset($_POST['action']))
{
?>
	<article class="general">	
		<h1>Édition d'une vidéo</h1>
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/video/edit/">
			<p>
				<input type="hidden" name="action" /> <br />
				<input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
				
				Nom <br /> <input type="text" name="nom" value="<?php echo $donneesVideo['nom'] ?>" /> <br />
				URL de la vidéo <br /><input type="text" name="url" value="<?php echo $donneesVideo['url'] ?>" /> <br />
				URL de la miniature <br /> <input type="text" name="img" value="<?php echo $donneesVideo['img'] ?>" /> <br />
				Description : </br>
				<textarea name="description" rows="20" cols="90"><?php echo str_replace('</p>', '', str_replace('<p>', '', str_replace('</p><br /><p>', '', stripslashes($donneesVideo['description'])))) ?></textarea>
				<br />
				<input type="button" value="Retour" onclick="location.href='<?php echo $options['rootURL'].'/video/'.$_GET['id'] ?>';"/>
				<input type="submit" value="Modifier" /> <br />
			</p>
		</form>
	</article>
<?php
}
else
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
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>