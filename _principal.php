<?php
/* Détermination de la page et extraction de données MySQL */
if($principal = 'default')
{
	if(isset($_GET['page']))
	{
		$pageActuelle = $_GET['page'];
	}
	else
	{
		$pageActuelle = 'timeline';
	}

	$nomPage = $ludus['options']['siteName'];
	switch($pageActuelle)
	{
		case 'timeline':
			if(isset($_GET['p']))
			{
				$p = $_GET['p'];
			}
			else
			{
				$p = 1;
			}
			$timeline = chargerVideos_timeline($ludus, $p);
			
			if($timeline['totalVideos'] > 0)
			{
				$nomPage .= ' | Timeline';
			}
			else
			{
				$nomPage .= ' | Aucune vidéo postée';
			}
			
			$typePage = "timeline";
		break;
		
		case 'utilisateur':			
			if(isset($_GET['id']))
			{
				if(isset($_GET['p']))
				{
					$p = $_GET['p'];
				}
				else
				{
					$p = 1;
				}
				$utilisateur = chargerUtilisateur($ludus, recuperer_id_utilisateur($ludus, $_GET['id']), 1, $p);
				
				if($utilisateur != NULL)
				{				
					$nomPage .= ' | Profil de '.$utilisateur['pseudo'];
				}
				else
				{
					$nomPage .= ' | Utilisateur non trouvé';
				}
			}
			/*
			else
			{
				$nomPage .= ' | Erreur ID non préçisé';
			}
			*/
			$typePage = "utilisateur";
		break;
				
		case 'video':
			if(isset($_GET['id']))
			{
				if(isset($_GET['c']))
				{
					$c = $_GET['c'];
				}
				else
				{
					$c = 1;
				}
				$video = chargerVideo($ludus, $_GET['id'], $c, 0);
				
				if($video != NULL)
				{
					if(isset($_SESSION['lastVid']))
					{
						if($_GET['id'] != $_SESSION['lastVid'])
						{
							ajouterVue($ludus, $video);
							$video['vues']++;
							$_SESSION['lastVid'] = $_GET['id'];
						}
					}
					else
					{
						ajouterVue($ludus, $video);
						
						$video['vues']++;
						$_SESSION['lastVid'] = $_GET['id'];
					}
					
					$nomPage .= ' | '.$video['nom'];
				}
				else
				{
					$nomPage .= ' | Vidéo non trouvée';
				}
			}
			/*
			else
			{
				$nomPage .= ' | Erreur ID non préçisé';
			}
			*/
			$typePage = "video";
		break;
	}
}

include('themes/'.$ludus['options']['theme'].'/index.php');
?>