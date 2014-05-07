<?php
if(!isset($_POST['action']))
{
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
					echo '<p>Le nom du statut doit être non nul.</p>';
				break;
				
				case 2:
					echo '<p>Le nom du statut ne doit contenir que des caractères alphanumériques.</p>';
				break;
				
				case 3:
					echo '<p>Un statut avec ce nom existe déjà.</p>';
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
		<form method="post" action=".<?php echo $ludus['options']['rootURL'] ?>/admin/status/add/">
			<p>
				<input type="hidden" name="action" />
				<input type="hidden" name="id" />
				
				Nom du statut<br /><input type="text" name="nom"> <br /><br />
				<table width=400px>
					<tr>
						<td>
							<p>Peut poster des vidéos</p>
						</td>
						<td>
							<input type="checkbox" name="canPostVideos" />
						</td>
					</tr>
					<tr>
						<td>
							<p>Peut administrer</p>
						</td>
						<td width=50px>
							<input type="checkbox" name="canAdmin" />
						</td>
					</tr>
				</table>
				<br />
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/admin/status/' ?>';"/>
				<input type="submit" value="Éditer" /> <br />
			</p>
		</form>
	</article>
<?php
}
else
{
	if($_POST['nom'] != '')
	{
		preg_match("/([^A-Za-z0-9])/", $_POST['nom'], $resultatPreg);
		if(empty($resultatPreg))
		{
			$req = $bdd->prepare('SELECT id, nom FROM '.$options['prefixeTable'].'status WHERE nom = :nom');
			$req->execute(array(
				'nom' => $_POST['nom']));
			$donneesStatutAvecLeMemeNom = $req->fetch();
				
			if($donneesStatutAvecLeMemeNom == NULL)
			{
				if($_POST['canPostVideos'] == 'on') { $canPostVideos = 1; } else { $canPostVideos = 0; }
				if($_POST['canAdmin'] == 'on') { $canAdmin = 1; } else { $canAdmin = 0; }
				
				$req = $bdd->prepare('INSERT INTO '.$options['prefixeTable'].'status(nom, canPostVideos, canAdmin) VALUES(:nom, :canPostVideos, :canAdmin)');
				$req->execute(array(
					'nom' => $_POST['nom'],
					'canPostVideos' => $canPostVideos,
					'canAdmin' => $canAdmin));
					
				$back = $options['rootURL'].'/admin/status/';
			}
			else
			{
				$back = $options['rootURL'].'/admin/status/add/erreur-3';
			}
		}
		else
		{
			$back = $options['rootURL'].'/admin/status/add/erreur-2';
		}
	}
	else
	{
		$back = $options['rootURL'].'/admin/status/add/erreur-1';
	}
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>