<?php
if(!isset($_POST['action']))
{
	$reqTS = $ludus['mysql']['bdd']->query('SELECT id, nom FROM '.$ludus['mysql']['prefixe'].'status ORDER BY id ASC');
?>
	<article class="menu">
		<h1>Ajout d'utilisateur</h1>
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
				
				case 4:
					echo '<p>Les deux mots de passe ne correspondent pas.</p>';
				break;
				
				case 5:
					echo '<p>Un utilisateur existe déjà avec ce pseudonyme.</p>';
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
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/users/add/">
			<p>
				<input type="hidden" name="action" />
				Nom d'utilisateur<br /><input type="text" name="pseudo"><br />
				Mot de passe :<br /><input type="text" name="pass" /><br />
				Recopiez le mot de passe :<br /><input type="text" name="pass2" /><br />
				Statut :
				<select name="statut">
					<?php
					while ($donneesStatut = $reqTS->fetch())
					{
					?>
						<option value="<?php echo $donneesStatut['id'] ?>">
							<?php echo $donneesStatut['nom'] ?>
						</option>
					<?php
					}
					?>
				</select>
				<br />
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/admin/users/' ?>';"/>
				<input type="submit" value="Ajouter" /> <br />
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
			if($_POST['pass'] != NULL)
			{
				if($_POST['pass'] == $_POST['pass2'])
				{
					$req = $bdd->prepare('SELECT id, pseudo FROM '.$options['prefixeTable'].'users WHERE pseudo = :pseudo');
					$req->execute(array(
						'pseudo' => $_POST['pseudo']));
					$donneesUtilisateurAvecLeMemePseudo = $req->fetch();
					
					if($donneesUtilisateurAvecLeMemePseudo == NULL)
					{
						$req = $bdd->prepare('INSERT INTO '.$options['prefixeTable'].'users(pseudo, pass, statut, hasAvatar, bio) VALUES(:pseudo, :pass, :statut, :hasAvatar, :bio)');
						$req->execute(array(
							'pseudo' => $_POST['pseudo'],
							'pass' => sha1($_POST['pass']),
							'statut' => $_POST['statut'],
							'hasAvatar' => '0',
							'bio' => ''));
						
						$req2 = $bdd->prepare('SELECT id, pseudo FROM '.$options['prefixeTable'].'users WHERE pseudo = :pseudo');
						$req2->execute(array(
							'pseudo' => $_POST['pseudo']));
						$donneesUtilisateurInscrit = $req2->fetch();
						
						if($donneesUtilisateurInscrit != NULL)
						{
							$back = $options['rootURL'].'/';
							mkdir('../data/'.$donneesUtilisateurInscrit['id'].'/', 0777, true);
							mkdir('../data/'.$donneesUtilisateurInscrit['id'].'/vid/', 0777, true);
							mkdir('../data/'.$donneesUtilisateurInscrit['id'].'/img/', 0777, true);
							
							$back = $options['rootURL'].'/admin/users/';
						}
						else
						{
							$back = $options['rootURL'].'/admin/users/add/erreur-0';
						}
					}
					else
					{
						$back = $options['rootURL'].'/admin/users/add/erreur-5';
					}
				}
				else
				{
					$back = $options['rootURL'].'/admin/users/add/erreur-4';
				}
			}
			else
			{
				$back = $options['rootURL'].'/admin/users/add/erreur-3';
			}
		}
		else
		{
			$back = $options['rootURL'].'/admin/users/add/erreur-2';
		}
	}
	else
	{
		$back = $options['rootURL'].'/admin/users/add/erreur-1';
	}
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>