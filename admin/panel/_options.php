<?php
if(!isset($_POST['action']))
{
?>
	<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/admin/">
		<input type="hidden" name="action" />
		<table width=800px>
			<tr>
				<td width=280px>
					<p>Nom du site</p>
				</td>
				<td>
					<input type="text" name="siteName" style="width: 95%;" value="<?php echo $ludus['options']['siteName'] ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<p>Inscription autorisée ?</p>
				</td>
				<td>
					<select name="inscription">
						<option value="1" <?php if($ludus['options']['inscription'] == 1) { echo 'selected="selected"'; } ?>>Oui</option>
						<option value="0" <?php if($ludus['options']['inscription'] == 0) { echo 'selected="selected"'; } ?>>Non</option>
					</select>
				</td>
			</tr>
		</table>
		
		<input type="submit" value="Mettre à jour" />
	</form>
<?php
}
else
{
	$req2 = $ludus['mysql']['bdd']->prepare('UPDATE '.$ludus['mysql']['prefixe'].'options SET siteName = :siteName, inscriptionAuthorized = :inscriptionAuthorized');
	$req2->execute(array(
		'siteName' => $_POST['siteName'],
		'inscriptionAuthorized' => $_POST['inscription']));
	
	$back = $ludus['options']['rootURL'].'/admin/';
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>