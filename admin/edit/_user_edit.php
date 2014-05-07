<?php
if(!isset($_POST['action']))
{
	$utilisateur = chargerUtilisateur($ludus, $_GET['id'], 0, 1);
	
	$reqTS = $ludus['mysql']['bdd']->query('SELECT id, nom FROM '.$ludus['mysql']['prefixe'].'status ORDER BY id ASC');
?>
	<article class="menu">
		<h1>Édition d'utilisateur</h1>
		<?php
		if(isset($_GET['erreur']))
		{
		?>
		<article>
		<?php
			switch($_GET['erreur'])
			{
				case 1:
					echo '<p>Le pseudonyme doit être non nul.</p>';
				break;
				
				case 2:
					echo '<p>Le pseudonyme ne doit contenir que des caractères alphanumériques.</p>';
				break;
				
				case 3:
					echo '<p>Le mot de passe doit être non nul.</p>';
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
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/admin/users/edit/">
			<p>
				<input type="hidden" name="action" />
				<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
				<input type="hidden" name="defaultpseudo" value="<?php echo $utilisateur['pseudo'] ?>" />
				Nom d'utilisateur <br /> <input type="text" name="pseudo" value="<?php echo $utilisateur['pseudo'] ?>"> <br />
				Statut :
				<select name="statut"
					<?php if($_GET['id'] == 1 OR ($utilisateur['statut']['id'] == 3 && $_SESSION['id'] != 1)) { ?> disabled="disabled" <?php } ?>>
					<?php
					while ($donneesStatut = $reqTS->fetch())
					{
					?>
						<option
							value="<?php echo $donneesStatut['id'] ?>"
							<?php
							if($utilisateur['statut']['id'] == $donneesStatut['id'])
							{
							?>
								selected="selected"
							<?php
							}
							?>>
								<?php echo $donneesStatut['nom'] ?>
						</option>
					<?php
					}
					?>
				</select>
				<br />
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/admin/users/' ?>';"/>
				<input type="submit" value="Éditer" /> <br />
			</p>
		</form>
	</article>
<?php
}
else
{
	if($_POST['pseudo'] != '')
	{
		preg_match("/([^A-Za-z0-9])/", $_POST['pseudo'], $resultatPreg);
		if(empty($resultatPreg))
		{
			$req2 = $bdd->prepare('SELECT id, pseudo FROM '.$options['prefixeTable'].'users WHERE pseudo = :pseudo');
			$req2->execute(array(
				'pseudo' => $_POST['pseudo']));
			$donneesUtilisateurAvecLeMemePseudo = $req2->fetch();
			
			if($donneesUtilisateurAvecLeMemePseudo == NULL || $_POST['defaultpseudo'] == $_POST['pseudo'])
			{
				$req2 = $bdd->prepare('UPDATE '.$options['prefixeTable'].'users SET pseudo = :pseudo, statut = :statut WHERE id = :id');
				$req2->execute(array(
					'id' => $_POST['id'],
					'pseudo' => $_POST['pseudo'],
					'statut' => $_POST['statut']));
						
				$back = $options['rootURL'].'/admin/users/';
			}
			else
			{
				$back = $options['rootURL'].'/admin/users/edit/'.$_POST['id'].'/erreur-3';
			}
		}
		else
		{
			$back = $options['rootURL'].'/admin/users/edit/'.$_POST['id'].'/erreur-2';
		}
	}
	else
	{
		$back = $options['rootURL'].'/admin/users/edit/'.$_POST['id'].'/erreur-1';
	}
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>