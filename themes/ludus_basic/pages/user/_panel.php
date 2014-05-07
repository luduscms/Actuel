<article class="panel">
	<h1>Panel utilisateur</h1>
</article>

<?php
	if(isset($_SESSION['id']))
	{
?>
<article class="panel">
	
	<table width=800px style="margin-left: auto; margin-right: auto;">
		<tr>
			<td width=200px style="text-align: center; border-right: 3px solid black;">
				<img src="<?php echo $utilisateurActuel['avatar']['url'] ?>" style="width: 128px; height: 128px; border: 5px solid black; border-radius: 20px;">
				<?php
				if($utilisateurActuel['avatar']['has'] == 1)
				{
				?>
					<form method="post" action="<?php echo $ludus['options']['rootURL'].'/user/' ?>avatar/edit/">
						<input type="submit" value="Changer" />
					</form>
					<form method="post" action="<?php echo $ludus['options']['rootURL'].'/user/' ?>avatar/delete/">
						<input type="submit" value="Supprimer" />
					</form>
				<?php
				}
				else
				{
				?>
					<form method="post" action="<?php echo $ludus['options']['rootURL'].'/user/' ?>avatar/add/">
						<input type="submit" value="Ajouter" />
					</form>
				<?php
				}
				?>
			</td>
			<td style="text-align: left; padding-left: 10px; vertical-align: top;">
				<p>Connecté en tant que <strong><?php echo $utilisateurActuel['pseudo'] ?></strong>.</p>
				<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/deconnexion/">
						<input type="hidden" name="action" />
						<input type="submit" value="Se déconnecter" />
				</form>	<br />
				<p>Vous êtes <strong><?php echo $utilisateurActuel['statut']['nom'] ?></strong>.
				<?php
					if($utilisateurActuel['statut']['canAdmin'] == 1)
					{
				?>
						<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/admin/">
							<input type="submit" value="Panneau d'administration" />
						</form>
				<?php
					}
				?>
				</p><br />
				
				<p>Mot de passe : ******
				<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/changepw/">
					<input type="submit" value="Changer" />
				</form></p>
				
				<div style="text-align: right;">
					<form method="post" action="<?php echo $ludus['options']['rootURL'].'/' ?>">
						<input type="submit" value="Retour" />
					</form>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan=2 style="border-top: 2px solid black; padding-bottom: 2px;">
				<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/editbio/">
					<input type="hidden" name="action" />
					
					<p>Bio</p> <br/>
					<textarea name="bio" rows="20" cols="95" style="border-radius: 5px;"><?php echo str_replace('</p>', '', str_replace('<p>', '', str_replace('</p><br /><p>', '', stripslashes($utilisateurActuel['bio'])))) ?></textarea> <br />
					<input type="submit" value="Modifier" />
				</form>
			</td>
		</tr>
	</table>
</article>
<?php
	}
?>