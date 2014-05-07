<?php
function afficherUtilisateur($ludus, $utilisateur, $utilisateurActuel)
{
?>
<article class="userInfo">
	<table>
		<tr>
			<td class="avatar" rowspan=2>
				<img src="<?php urlAvatar($ludus, $utilisateur['avatar']) ?>">
			</td>
			<td class="pseudo">
				<h2><?php echo $utilisateur['pseudo'] ?></h2>
			</td>
			<td class="grade">
				<h3><?php echo $utilisateur['statut']['nom'] ?></h3>
			</td>
		</tr>
		<tr>
			<td colspan=2 class="bio">
				<p><?php bio($utilisateur['bio']); ?></p>
			</td>
		</tr>
	</table>
</article>
<?php
}
?>