<?php
if(!isset($_POST['action']))
{
?>
	<article class="menu">
		<h1>Édition d'avatar</h1>
	<?php
	if(isset($_GET['erreur']))
	{
	?>
		<article>
	<?php
		switch($_GET['erreur'])
		{
			case 1:
				echo 'Le fichier est introuvable.';
			break;
			
			case 2:
				echo 'Le fichier n\'a été transféré que partiellement.';
			break;
			
			case 3:
				echo 'Le fichier dépasse la limite maximale autorisée par le serveur.';
			break;
			
			case 4:
				echo 'Le fichier dépasse la limite maximale autorisée par Pi.';
			break;
			
			case 5:
				echo 'L\'extension ne fait pas partie des extensions autorisées.';
			break;
			
			case 6:
				echo 'L\'image ne fait pas 150x150px.';
			break;
			
			case 7:
				echo 'Le dossier de l\'utilisateur actuel n\'existe pas.';
			break;
		}
	?>
		</article>
	<?php
	}
	?>
		<article>
			<p><strong>L'avatar doit faire moins de 1 Mo, être sous format PNG et mesurer exactement 150x150px.</strong></p>
		</article>
		<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/avatar/edit/" enctype="multipart/form-data">
			<p>
				<input type="hidden" name="action" />
				<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
				<input type="file" name="avatar" id="avatar" /><br />
				
				<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/user/' ?>';"/>
				<input type="submit" value="Valider" /> <br />
			</p>
		</form>
	</article>
<?php
}
else
{
	$erreur = $_FILES['avatar']['error'];
	if ($erreur == 0 /* Si le fichier a bien été uploadé */)
	{
		$extensions_valides = array('png');
		$extension_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
		if(in_array($extension_upload,$extensions_valides))
		{
			$dimensionsImage = getimagesize($_FILES['avatar']['tmp_name']);
			if ($dimensionsImage[0] == 150 /*  Longueur */ && $dimensionsImage[1] == 150 /* Largeur */)
			{
				if(file_exists('../data/'.$_SESSION['id'].'/avatar.png'))
				{
					unlink('././data/avatar/'.$_SESSION['id'].'.png');
				}
				$hasUploaded = move_uploaded_file($_FILES['avatar']['tmp_name'], '././data/avatar/'.$_SESSION['id'].'.png');
				if($hasUploaded)
				{
					$back = $ludus['options']['rootURL'].'/user/';
				}
				else
				{
					$back = $ludus['options']['rootURL'].'/user/avatar/add/erreur-7';
				}
			}
			else
			{
				$back = $ludus['options']['rootURL'].'/user/avatar/add/erreur-6';
			}
		}
		else
		{
			$back = $ludus['options']['rootURL'].'/user/avatar/add/erreur-5';
		}
	}
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>