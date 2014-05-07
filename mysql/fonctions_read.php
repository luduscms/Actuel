<?php
function chargerStatut($ludus, $id)
{
	$reqS = $ludus['mysql']['bdd']->prepare('SELECT id, nom, canPostVideos, canAdmin FROM '.$ludus['mysql']['prefixe'].'statuts WHERE id = :statut');
	$reqS->execute(array(
		'statut' => $id));
	$donneesStatut = $reqS->fetch();
	
	$statut = array(
		'id' => $donneesStatut['id'],
		'nom' => $donneesStatut['nom'],
		'canPostVideos' => $donneesStatut['canPostVideos'],
		'canAdmin' => $donneesStatut['canAdmin']);
	
	return $statut;
}

function chargerStatuts($ludus, $page)
{
	$nombreStatutsParPage = 5;
	
	$reqTTS = $ludus['mysql']['bdd']->prepare('SELECT count(id) AS total FROM '.$ludus['mysql']['prefixe'].'statuts');
	$reqTTS->execute();
	
	$donneesTotalTousStatuts = $reqTTS->fetch();
	$totalStatuts = $donneesTotalTousStatuts['total'];
	
	$debutAffichage = $nombreStatutsParPage * ($page - 1);
	
	if($totalStatuts > 0)
	{
		$reqTS = $ludus['mysql']['bdd']->query('SELECT id FROM '.$ludus['mysql']['prefixe'].'statuts ORDER BY id ASC LIMIT '.$debutAffichage.','.$nombreStatutsParPage);
		$listeStatuts = array();
		for($i = 0; ($donneesStatuts = $reqTS->fetch()) != NULL; $i++)
		{
			$array = array($i => chargerStatut($ludus, $donneesStatuts['id']));
			$listeStatuts = array_merge($listeStatuts, $array);
		}
	}
	else
	{
		$listeStatuts = array();
	}
	
	$statuts = array(
		'totalStatuts' => $totalStatuts,
		'statuts' => $listeStatuts);
	
	return $statuts;
}

function chargerUtilisateur($ludus, $id, $loadVideos, $pageVideos)
{
	$reqU = $ludus['mysql']['bdd']->prepare('SELECT id, statut, pseudo, bio, hasAvatar FROM '.$ludus['mysql']['prefixe'].'users WHERE id = :id');
	$reqU->execute(array(
		'id' => $id));
	$donneesUtilisateur = $reqU->fetch();
	
	if($donneesUtilisateur != NULL)
	{
		$utilisateur = array(
			'id' => $donneesUtilisateur['id'],
			'pseudo' => $donneesUtilisateur['pseudo'],
			'bio' => stripslashes($donneesUtilisateur['bio']),
			'avatar' => array(
				'has' => $donneesUtilisateur['hasAvatar'],
				'url' => $ludus['options']['rootURL'].'/data/avatar/'.$donneesUtilisateur['id'].'.png'),
			'liens' => array(
				'profil' => $ludus['options']['rootURL'].'/utilisateur/'.$donneesUtilisateur['pseudo']),
			'statut' => chargerStatut($ludus, $donneesUtilisateur['statut']));
		
		if($loadVideos)
		{
			$array = array('timeline' => chargerVideos_auteur($ludus, $utilisateur['id'], $pageVideos));
			$utilisateur = array_merge($utilisateur, $array);
		}
	}
	else
	{
		$utilisateur = NULL;
	}
		
	return $utilisateur;
}

function chargerUtilisateurs($ludus, $page)
{
	$nombreUtilisateursParPage = 5;
	
	$reqTTU = $ludus['mysql']['bdd']->prepare('SELECT count(id) AS total FROM '.$ludus['mysql']['prefixe'].'users');
	$reqTTU->execute();
	
	$donneesTotalTousUtilisateurs = $reqTTU->fetch();
	$totalUtilisateurs = $donneesTotalTousUtilisateurs['total'];
	
	$debutAffichage = $nombreUtilisateursParPage * ($page - 1);
	
	if($totalUtilisateurs > 0)
	{
		$reqTS = $ludus['mysql']['bdd']->query('SELECT id FROM '.$ludus['mysql']['prefixe'].'users ORDER BY id ASC LIMIT '.$debutAffichage.','.$nombreUtilisateursParPage);
		$listeUtilisateurs = array();
		for($i = 0; ($donneesUtilisateurs = $reqTS->fetch()) != NULL; $i++)
		{
			$array = array($i => chargerUtilisateur($ludus, $donneesUtilisateurs['id'], 0, 0));
			$listeUtilisateurs = array_merge($listeUtilisateurs, $array);
		}
	}
	else
	{
		$listeUtilisateurs = array();
	}
	
	$utilisateurs = array(
		'total' => $totalUtilisateurs,
		'utilisateurs' => $listeUtilisateurs);
	
	return $utilisateurs;
}

function chargerCommentaire($ludus, $id)
{
	$reqC = $ludus['mysql']['bdd']->prepare('SELECT user, content FROM '.$ludus['mysql']['prefixe'].'activity WHERE id = :id');
	$reqC->execute(array(
		'id' => $id));
	$donneesCommentaire = $reqC->fetch();
	
	$commentaire = array(
		'auteur' => chargerUtilisateur($ludus, $donneesCommentaire['user'], 0, 0),
		'content' => $donneesCommentaire['content']);
		
	return $commentaire;
}

function chargerVideo($ludus, $id, $pageCommentaires, $dansUtilisateur)
{
	$reqV = $ludus['mysql']['bdd']->prepare('SELECT id, statut, auteur, DATE_FORMAT(published, \'%d/%m/%Y\') AS date, nom, vues, description FROM '.$ludus['mysql']['prefixe'].'videos WHERE id = :id');
	$reqV->execute(array(
		'id' => $id));
	$donneesVideo = $reqV->fetch();
	
	if($donneesVideo != NULL)
	{
		if($donneesVideo['statut'] == 1)
		{
			$date2 = explode('/', $donneesVideo['date']);
			
			switch($date2[1])
			{
				case 1:
					$nomDuMois = 'janvier';
				break;
				
				case 2:
					$nomDuMois = 'février';
				break;
				
				case 3:
					$nomDuMois = 'mars';
				break;
				
				case 4:
					$nomDuMois = 'avril';
				break;
				
				case 5:
					$nomDuMois = 'mai';
				break;
				
				case 6:
					$nomDuMois = 'juin';
				break;
				
				case 7:
					$nomDuMois = 'juillet';
				break;
				
				case 8:
					$nomDuMois = 'août';
				break;
				
				case 9:
					$nomDuMois = 'septembre';
				break;
				
				case 10:
					$nomDuMois = 'octobre';
				break;
				
				case 11:
					$nomDuMois = 'novembre';
				break;
				
				case 12:
					$nomDuMois = 'décembre';
				break;
			}
			
			$reqTL = $ludus['mysql']['bdd']->prepare('SELECT count(id) AS total FROM '.$ludus['mysql']['prefixe'].'activity WHERE type = :type AND video = :video');
			$reqTL->execute(array(
				'type' => 'like',
				'video' => $donneesVideo['id']));
			$donneesTotalLikes = $reqTL->fetch();
			
			/* Chargement des commentaires */
			if($pageCommentaires == NULL)
			{
				$pC = 1;
			}
			else
			{
				$pC = $pageCommentaires;
			}
			
			$reqTCV = $ludus['mysql']['bdd']->prepare('SELECT count(id) AS total FROM '.$ludus['mysql']['prefixe'].'activity WHERE type = :type AND video = :video');
			$reqTCV->execute(array(
				'type' => 'comment',
				'video' => $donneesVideo['id']));
			$donneesTotalCommentairesVideo = $reqTCV->fetch();
						
			if($pC != 0)
			{
				$debutAffichage = $ludus['theme']['nombreCommentairesParPage'] * ($pC - 1);
							
				$reqTCV = $ludus['mysql']['bdd']->prepare('SELECT id, date FROM '.$ludus['mysql']['prefixe'].'activity WHERE type = \'comment\' AND video = :video ORDER BY date DESC LIMIT '.$debutAffichage.','.$ludus['theme']['nombreCommentairesParPage']);
				$reqTCV->execute(array(
					'video' => $donneesVideo['id']));
								
				$commentairesVideo = array();
				for($i = 0; ($donneesCommentairesVideo = $reqTCV->fetch()) != NULL; $i++)
				{
					$array = array($i => chargerCommentaire($ludus, $donneesCommentairesVideo['id']));
					$commentairesVideo = array_merge($commentairesVideo, $array);
				}
			}
			else
			{
				$commentairesVideo = NULL;
			}
			
			/* Création de la structure */
			$video = array(
				'id' => $id,
				'nom' => stripslashes($donneesVideo['nom']),
				'date' => array(
					'complete' => $donneesVideo['date'],
					'jour' => $date2[0],
					'mois' => $date2[1],
					'nomMois' => $nomDuMois,
					'annee' => $date2[2]),
				'source' => array(
					'vid' => $ludus['options']['rootURL'].'/data/vid/'.$donneesVideo['id'].'.mp4',
					'img' => $ludus['options']['rootURL'].'/data/img/'.$donneesVideo['id'].'.png'),
				'liens' => array(
					'view' => $ludus['options']['rootURL'].'/video/'.$id,
					'edit' => $ludus['options']['rootURL'].'/video/edit/'.$id,
					'remove' => $ludus['options']['rootURL'].'/video/remove/'.$id),
				'vues' => $donneesVideo['vues'],
				'description' => stripslashes($donneesVideo['description']),
				'totalLikes' => $donneesTotalLikes['total'],
				'totalCommentaires' => $donneesTotalCommentairesVideo['total'],
				'commentaires' => $commentairesVideo);
			
			if(!$dansUtilisateur)
			{
				$array = array('auteur' => chargerUtilisateur($ludus, $donneesVideo['auteur'], 0, 0));
				
				$video = array_merge($video, $array);
			}
			
			if(isset($_SESSION['id']))
			{
				$req = $ludus['mysql']['bdd']->prepare('SELECT id FROM '.$ludus['mysql']['prefixe'].'activity WHERE type = :type AND user = :user AND video = :video');
				$req->execute(array(
					'type' => 'like',
					'user' => $_SESSION['id'],
					'video' => $id));
				$donneesLike = $req->fetch();
				
				if($donneesLike != NULL)
				{
					$userLike = 0;
				}
				else
				{
					$userLike = 1;
				}
				
				$array = array(
					'userLike' => $userLike);
				
				$video = array_merge($video, $array);
			}
			
			return $video;
		}
	}
	else
	{
		return NULL;
	}
}
function chargerVideos($ludus, $auteur, $pageVideos)
{
	if(isset($pageVideos))
	{
		$pV = $pageVideos;
	}
	else
	{
		$pV = 1;
	}

	if(isset($auteur))
	{
		$reqTTV = $ludus['mysql']['bdd']->prepare('SELECT count(id) AS total FROM '.$ludus['mysql']['prefixe'].'videos WHERE auteur = :auteur AND statut = 1');
		$reqTTV->execute(array(
			'auteur' => $auteur));
	}
	else
	{
		$reqTTV = $ludus['mysql']['bdd']->prepare('SELECT count(id) AS total FROM '.$ludus['mysql']['prefixe'].'videos WHERE statut = 1');
	}
	$reqTTV->execute();
	
	$donneesTotalToutesVideos = $reqTTV->fetch();
	$totalVideos = $donneesTotalToutesVideos['total'];
	
	$debutAffichage = $ludus['theme']['nombreVideosParPage'] * ($pV - 1);
	
	if($totalVideos > 0)
	{
		$reqTV = $ludus['mysql']['bdd']->query('SELECT id FROM '.$ludus['mysql']['prefixe'].'videos WHERE statut = 1 ORDER BY published DESC LIMIT '.$debutAffichage.','.$ludus['theme']['nombreVideosParPage']);
		$videos = array();
		for($i = 0; ($donneesVideos = $reqTV->fetch()) != NULL; $i++)
		{
			$array = array($i => chargerVideo($ludus, $donneesVideos['id'], 1, 0));
			$videos = array_merge($videos, $array);
		}
	}
	else
	{
		$videos = NULL;
	}
	
	$timeline = array(
		'totalVideos' => $totalVideos,
		'videos' => $videos);
	
	return $timeline;
}
function chargerVideos_timeline($ludus, $pageVideos)
{
	return chargerVideos($ludus, NULL, $pageVideos);
}
function chargerVideos_auteur($ludus, $auteur, $pageVideos)
{
	return chargerVideos($ludus, $auteur, $pageVideos);
}

function ajouterVue($ludus, $video)
{	
	if($video != NULL)
	{
		$req = $ludus['mysql']['bdd']->prepare('UPDATE '.$ludus['mysql']['prefixe'].'videos SET vues = :vues WHERE id = :id');
		$req->execute(array(
			'id' => $video['id'],
			'vues' => $video['vues'] + 1));
	}
}

function recuperer_id_utilisateur($ludus, $pseudo)
{
	$reqTTV = $ludus['mysql']['bdd']->prepare('SELECT id FROM '.$ludus['mysql']['prefixe'].'users WHERE pseudo = :pseudo');
	$reqTTV->execute(array(
		'pseudo' => $pseudo));
	$donneesUtilisateur = $reqTTV->fetch();
	
	return $donneesUtilisateur['id'];
}
?>