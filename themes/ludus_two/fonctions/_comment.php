<?php
function afficherCommentaire($ludus, $commentaire, $utilisateurActuel)
{
?>
<table class="commentaire">
	<tr>
		<td width=130px class="infosUtilisateur" rowspan=2>
			<img src="<?php echo urlAvatar($ludus, $commentaire['auteur']['avatar']) ?>">
			<p><strong><a href="<?php echo $commentaire['auteur']['liens']['profil'] ?>"><?php echo $commentaire['auteur']['pseudo'] ?></a></strong></p>
		</td>
		<td class="commentaire">
			<p><?php echo $commentaire['content'] ?></p>
		</td>
	</tr>
	<tr>
		<td class="moderateur">
			<?php
			if($utilisateurActuel['statut']['canAdmin'])
			{
			?>
				<p>Éditer • Supprimer</p>
			<?php
			}
			?>
		</td>
	</tr>
</table>
<?php
}
?>