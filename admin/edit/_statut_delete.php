<?php
if(!isset($_POST['action']))
{
?>
	<article class="menu">
		<?php
		if($_GET['id'] > 3)
		{
		?>
		<h1>Suppression de statut</h1>
		<!--<article>
			<p><strong>Supprimer un statut... rah et puis merde, pourquoi je me fais chier.</strong></p>
		</article>-->
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/admin/status/delete/">
			<p>
				<input type="hidden" name="action" />
				<input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
				<input type="radio" name="confirmation" value="1" id="oui" /> <label for="oui">Oui</label>
				<input type="radio" name="confirmation" value="0" id="non" checked="checked" /> <label for="non">Non</label>
				<br />
				<input type="submit" value="Supprimer" />
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/admin/status/' ?>';"/> <br />
			</p>
		</form>
		<?php
		}
		else
		{
		?>
		<p>Vous ne pouvez pas supprimer un statut fondateur.</p>
		<?php
		}
		?>
	</article>
<?php
}
else
{
	$req = $bdd->prepare('DELETE FROM '.$options['prefixeTable'].'status WHERE id = :id');
	$req->execute(array(
		'id' => $_POST['id']));
	
	$back = $options['rootURL'].'/admin/status/';
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>