<?php
function afficherCommentaire($ludus, $commentaire, $utilisateurActuel)
{
?>
<img src="<?php echo urlAvatar($ludus, $commentaire['auteur']['avatar']) ?>">
<p><strong><a href="<?php echo $commentaire['auteur']['liens']['profil'] ?>"><?php echo $commentaire['auteur']['pseudo'] ?></a></strong></p>
<p><?php echo $commentaire['content'] ?></p>
<?php
	if($utilisateurActuel['statut']['canAdmin'])
	{
?>
		<p>Éditer • Supprimer</p>
<?php
	}
?>
<hr>
<?php
}
?>