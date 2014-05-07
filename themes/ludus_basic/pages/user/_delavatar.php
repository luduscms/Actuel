<?php
if(!isset($_POST['action']))
{
?>
	<article class="menu">
		<h1>Supprimer un avatar</h1>

		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/avatar/delete/" enctype="multipart/form-data">
			<p>
				<input type="hidden" name="action" />
				<input type="radio" name="confirmation" value="1" id="oui" /> <label for="oui">Oui</label>
				<input type="radio" name="confirmation" value="0" id="non" checked="checked" /> <label for="non">Non</label><br />
				
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/user/' ?>';"/>
				<input type="submit" value="Valider" /> <br />
			</p>
		</form>
	</article>
<?php
}
else
{
	if($_POST['confirmation'] == 1)
	{
		if(file_exists('../data/'.$_SESSION['id'].'/avatar.png'))
		{
			unlink('../data/'.$_SESSION['id'].'/avatar.png');
		}
		
		$req2 = $ludus['mysql']['bdd']->prepare('UPDATE '.$ludus['mysql']['prefixe'].'users SET hasAvatar = 0 WHERE id = :id');
		$req2->execute(array(
			'id' => $_SESSION['id']));
	}
	$back = $ludus['options']['rootURL'].'/user/';
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>