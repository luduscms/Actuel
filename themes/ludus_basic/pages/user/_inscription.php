<?php
if(!isset($_POST['action']))
{
?>
	<article class="menu">
		<h1>Inscription</h1>
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
					echo '<p>Votre pseudo ne doit contenir que des caractères alphanumériques.</p>';
				break;
				
				case 3:
					echo '<p>Vous devez entrer un mot de passe !</p>';
				break;
				
				case 4:
					echo '<p>Les deux mots de passe ne correspondent pas.</p>';
				break;
				
				case 5:
					echo '<p>Un utilisateur existe déjà avec ce pseudo.</p>';
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
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/inscription/">
			<p>
				<input type="hidden" name="action" />
				Pseudo<br /><input type="text" name="pseudo" /><br />
				Mot de passe<br /><input type="password" name="pass" /><br />
				Répétez votre mot de passe<br /><input type="password" name="pass2" /><br />
				
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/' ?>';"/>
				<input type="submit" value="Valider" /> <br />
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
					$req = $ludus['mysql']['bdd']->prepare('SELECT id, pseudo FROM '.$ludus['mysql']['prefixe'].'users WHERE pseudo = :pseudo');
					$req->execute(array(
						'pseudo' => $_POST['pseudo']));
					$donneesUtilisateurAvecLeMemePseudo = $req->fetch();
					
					if($donneesUtilisateurAvecLeMemePseudo == NULL)
					{
						$idUtilisateurInscrit = add_user($ludus, $_POST['pseudo'], $_POST['pass'], 1);
						if($idUtilisateurInscrit != 0)
						{
							$back = $ludus['options']['rootURL'].'/';
							$_SESSION['id'] = $donneesUtilisateurActuel['id'];
						}
						else
						{
							$back = $ludus['options']['rootURL'].'/user/inscription/erreur-0';
						}
					}
					else
					{
						$back = $ludus['options']['rootURL'].'/user/inscription/erreur-5';
					}
				}
				else
				{
					$back = $ludus['options']['rootURL'].'/user/inscription/erreur-4';
				}
			}
			else
			{
				$back = $ludus['options']['rootURL'].'/user/inscription/erreur-3';
			}
		}
		else
		{
			$back = $ludus['options']['rootURL'].'/user/inscription/erreur-2';
		}
	}
	else
	{
		$back = $ludus['options']['rootURL'].'/user/inscription/erreur-1';
	}
	*/
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>