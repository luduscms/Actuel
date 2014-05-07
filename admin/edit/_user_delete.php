<?php
if(!isset($_POST['action']))
{
	$reqTU = $ludus['mysql']['bdd']->query('SELECT id, nom FROM '.$ludus['mysql']['prefixe'].'users ORDER BY id ASC');
?>
	<article class="menu">
		<?php
		if($_GET['id'] != 1)
		{
		?>
		<h1>Suppression d'utilisateur</h1>
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/users/delete/">
			<p>
				<input type="hidden" name="type" value="deluser" />
				<input type="hidden" name="id" value="<?php echo $_GET['id']?>" />
				<input type="radio" name="confirmation" value="1" id="oui" /> <label for="oui">Oui</label>
				<input type="radio" name="confirmation" value="0" id="non" checked="checked" /> <label for="non">Non</label>
				<br />
				<input type="radio" name="delvid" value="1" checked="checked" id="delvid1">Supprimer toutes les vidéos de l'utilisateur</input><br />
				<input type="radio" name="delvid" value="0" id="delvid0">Attribuer à</input>
					<script type="text/javascript">
						$("#delvid0_user").hide();
						$("input[name=delvid]").click(function() 
							{
								if ( $("#delvid1").attr('checked'))
									$("#delvid0_user").hide();
								if ( $("#delvid0").attr('checked'))
									$("#delvid0_user").show();
							});
					</script>
					<select name="delvid0_user" id="delvid0_user"
						<?php if($_GET['id'] == 1 OR ($donneesStatutUtilisateur['statut'] == 3 && $_SESSION['id'] != 1)) { ?> disabled="disabled" <?php } ?>>
						<?php
						/*while ($donneesStatut = $reqTU->fetch())
						{
						?>
							<option
								value="<?php echo $donneesStatut['id'] ?>"
								<?php
								if($donneesUtilisateur['statut'] == $donneesStatut['id'])
								{
								?>
									selected="selected"
								<?php
								}
								?>>
									<?php echo $donneesStatut['nom'] ?>
							</option>
						<?php
						}*/
						?>
							<option value="0" selected="selected">1</option>
							<option value="0">2</option>
					</select>
					<br />
				<input type="submit" value="Supprimer" />
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/admin/users/' ?>';"/> <br />
			</p>
		</form>
		<?php
		}
		else
		{
		?>
		<p>Vous ne pouvez pas supprimer le compte fondateur.</p>
		<?php
		}
		?>
	</article>
<?php
}
else
{
	$req = $bdd->prepare('DELETE FROM '.$options['prefixeTable'].'users WHERE id = :id');
		$req->execute(array(
			'id' => $_POST['id']));
	
	$back = $options['rootURL'].'/admin/users/';
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>