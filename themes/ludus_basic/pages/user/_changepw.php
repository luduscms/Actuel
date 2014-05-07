<article class="menu">
	<h1>Changement de mot de passe</h1>
	<?php
	if(isset($_GET['erreur']))
	{
	?>
	<article>
	<?php
		switch($_GET['erreur'])
		{
			case 1:
				echo '<p>Vous devez entrer votre mot de passe actuel.</p>';
			break;
			
			case 2:
				echo '<p>Vous devez entrer un nouveau mot de passe.</p>';
			break;
			
			case 3:
				echo '<p>Les deux nouveaux mots de passe ne correspondent pas.</p>';
			break;
			
			case 4:
				echo '<p>Mauvais mot de passe actuel.</p>';
			break;
			
			case 0:
				echo '<p>Erreur de nature inconnue.</p>';
			break;
		}
		?>
	</article>
	<?php
	}
	?>
	<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/changepw/">
		<p>
			<input type="hidden" name="action" />
			Mot de passe actuel : <br /> <input type="text" name="oldpass" /> <br />
			Nouveau mot de passe : <br /> <input type="text" name="newpass" /> <br />
			Confirmez votre nouveau mot de passe : <br /> <input type="text" name="newpass2" /> <br />
			
			<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/user/' ?>';"/>
			<input type="submit" value="Valider" /> <br />
		</p>
	</form>
</article>