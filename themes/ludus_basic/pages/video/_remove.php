<?php
if(!isset($_POST['action']))
{
?>
	<article class="general">
		<h1>Suppression d'une vidéo</h1>
		<form method="post" action="<?php echo $options['rootURL'].'/video/' ?>action.php">
			<input type="hidden" name="action" />
			<input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
			
			<input type="radio" name="confirmation" value="1" id="oui" /> <label for="oui">Oui</label>
			<input type="radio" name="confirmation" value="0" id="non" checked="checked" /> <label for="non">Non</label>
			
			<br />
			
			<input type="submit" value="Valider" />
			<input type="button" value="Retour" onclick="location.href='<?php echo $options['rootURL'].'/video/'.$_POST['id'] ?>';"/> <br />
		</form>
	</article>
<?php
}
else
{
	if($_POST['confirmation'] == 1)
	{
		$req = $bdd->prepare('DELETE FROM '.$options['prefixeTable'].'videos WHERE id = :id');
		$req->execute(array(
			'id' => $_POST['id']));
	}
	
	$back = $options['rootURL'].'/';
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>