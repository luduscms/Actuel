<article>
	<?php
	if(isset($_GET['erreur']))
	{
		if($_GET['erreur'] == 1)
		{
	?>
			<p>La connexion n'a pas pu être établie.</p>
	<?php
		}
		if($_GET['erreur'] == 2)
		{
	?>
			<p>La base n'a pas été trouvée.</p>
	<?php
		}
	}
	?>
	<h1>Étape 1 - Connexion à la base de données</h1>
	<form method="post" action="../action.php">
		<p>
			<input type="hidden" name="type" value="dbconnect" />
			Hôte : <input type="text" name="host" /> <br />
			Nom de la base de données : <input type="text" name="dbname" /> <br />
			Utilisateur : <input type="text" name="user" /> <br />
			Mot de passe : <input type="text" name="pass" /> <br />
			<br />
			Préfixe des tables : <input type="text" name="prefixeTable" /> <br />
			
			<input type="submit" value="Connecter" /> <br />
		</p>
	</form>
</article>