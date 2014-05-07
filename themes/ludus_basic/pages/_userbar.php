<?php
function userbar($ludus, $utilisateurActuel)
{
?>
<hr>
<?php
	if(isset($_SESSION['id']))
	{
?>
		<h3>Bonjour, <strong><a href="<?php echo $ludus['options']['rootURL'].'/utilisateur/'.$utilisateurActuel['pseudo'] ?>"><?php echo $utilisateurActuel['pseudo'] ?></a></strong> !</h3>
		<?php
		if($utilisateurActuel['statut']['canPostVideos'])
		{
		?>
			<form method="post" action="<?php echo $ludus['options']['rootURL'].'/video/add/' ?>">
				<input type="submit" value="Ajouter une vidéo" />
			</form>
		<?php
		}
		?>
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/">
			<input type="submit" value="Panel Utilisateur" />
		</form>
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/deconnexion/">
			<input type="hidden" name="action" />
			<input type="submit" value="Déconnexion" />
		</form>
<?php
	}
	else
	{
?>
		<h3 class="profile">Bonjour, visiteur.</h3>
		<?php
		if($ludus['options']['inscription'])
		{
		?>
			<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/inscription/">
				<input type="submit" value="S'inscrire" />
			</form>
		<?php
		}
		?>
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/connexion/">
			<input type="submit" value="Connexion" />
		</form>
<?php
	}
?>
<hr>
<?php
}
?>