<article class="menu">
	<h1>Connexion</h1>
	<?php
	if(isset($_GET['erreur']))
	{
	?>
	<article>
	<?php
		switch($_GET['erreur'])
		{
			case 1:
				echo '<p>Vous devez entrer un pseudonyme.</p>';
			break;
			
			case 2:
				echo '<p>Vous devez entrer un mot de passe</p>';
			break;
			
			case 3:
				echo '<p>Mauvais identifiant ou mot de passe.</p>';
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
	<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/connexion/">
		<p>
			<input type="hidden" name="action" />
			
			Votre pseudo : <input type="text" name="pseudo" /> <br />
			Mot de passe : <input type="password" name="pass" /> <br />
			
			<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/' ?>';"/>
			<input type="submit" value="Valider" /> <br />
		</p>
	</form>
</article>