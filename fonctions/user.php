<?php
if($principal == 'video')
{
	switch($page)
	{
		case 'addavatar':
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
						$hasUploaded = move_uploaded_file($_FILES['avatar']['tmp_name'], '././data/avatar/'.$_SESSION['id'].'.png');
						if($hasUploaded)
						{
							$req2 = $ludus['mysql']['bdd']->prepare('UPDATE '.$ludus['mysql']['prefixe'].'users SET hasAvatar = 1 WHERE id = :id');
							$req2->execute(array(
								'id' => $_SESSION['id']));
							
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
			else
			{
				$back = $ludus['options']['rootURL'].'/user/avatar/add/';
				switch($erreur)
				{
					case UPLOAD_ERR_NO_FILE:
						$back .= '/erreur-1';
					break;
					
					case UPLOAD_ERR_INI_SIZE:
						$back .= '/erreur-3';
					break;
					
					case UPLOAD_ERR_FORM_SIZE:
						$back .= '/erreur-4';
					break;
					
					case UPLOAD_ERR_PARTIAL:
						$back .= '/erreur-2';
					break;
					
					default:
						$back .= '/erreur-0';
					break;
				}
			}
			
			echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
		break;
		
		
		
		case 'changepw':
			if($_POST['oldpass'] != '')
			{
				if($_POST['newpass'] != '')
				{
					if($_POST['newpass'] == $_POST['newpass2'])
					{
						/*$req = $ludus['mysql']['bdd']->prepare('SELECT id, pseudo, pass FROM '.$ludus['mysql']['prefixe'].'users WHERE id = :id AND pass = :pass');
						$req->execute(array(
							'id' => $_SESSION['id'],
							'pass' => sha1($_POST['oldpass'])));
						$donneesUtilisateur = $req->fetch();
						
						if($donneesUtilisateur != NULL)
						{
							$req2 = $ludus['mysql']['bdd']->prepare('UPDATE '.$ludus['mysql']['prefixe'].'users SET pass = :pass WHERE id = :id');
							$req2->execute(array(
								'id' => $_SESSION['id'],
								'pass' => sha1($_POST['newpass']) ));
								
							$back = $ludus['options']['rootURL'].'/user/';
						}*/
						else
						{
							$back = $ludus['options']['rootURL'].'/user/changepw/erreur-4';
						}
					}
					else
					{
						$back = $ludus['options']['rootURL'].'/user/changepw/erreur-3';
					}
				}
				else
				{
					$back = $ludus['options']['rootURL'].'/user/changepw/erreur-2';
				}
			}
			else
			{
				$back = $ludus['options']['rootURL'].'/user/changepw/erreur-1';
			}
			
			echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
		break;
		
		
		
		case 'connexion':
			if($_POST['pseudo'] != '')
			{
				if($_POST['pass'] != '')
				{
					$pass2 = sha1($_POST['pass']);
					
					$req = $ludus['mysql']['bdd']->prepare('SELECT id, pseudo FROM '.$ludus['mysql']['prefixe'].'users WHERE pseudo = :pseudo AND pass = :pass');
					$req->execute(array(
						'pseudo' => $_POST['pseudo'],
						'pass' => $pass2));
					$donneesUtilisateur = $req->fetch();
					
					if($donneesUtilisateur != NULL)
					{
						$back = $ludus['options']['rootURL'].'/';
						$_SESSION['id'] = $donneesUtilisateur['id'];
					}
					else
					{
						$back = $ludus['options']['rootURL'].'/user/connexion/erreur-3';
					}
				}
				else
				{
					$back = $ludus['options']['rootURL'].'/user/connexion/erreur-2';
				}
			}
			else
			{
				$back = $ludus['options']['rootURL'].'/user/connexion/erreur-1';
			}
			
			echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
		break;
	}
}
?>