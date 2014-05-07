<?php
function add_user($ludus, $pseudo, $pass, $statut)
{
	$req = $ludus['mysql']['bdd']->prepare('INSERT INTO '.$ludus['mysql']['prefixe'].'users(pseudo, pass, statut, hasAvatar, bio) VALUES(:pseudo, :pass, :statut, :hasAvatar, :bio)');
	$req->execute(array(
		'pseudo' => $pseudo,
		'pass' => sha1($pass),
		'statut' => $statut,
		'hasAvatar' => '0',
		'bio' => ''));
	
	$req2 = $ludus['mysql']['bdd']->prepare('SELECT id, pseudo FROM '.$ludus['mysql']['prefixe'].'users WHERE pseudo = :pseudo');
	$req2->execute(array(
		'pseudo' => $_POST['pseudo']));
	$donneesUtilisateurInscrit = $req2->fetch();

	if($donneesUtilisateurInscrit != NULL)
	{
		mkdir('../data/'.$donneesUtilisateurInscrit['id'].'/', 0777, true);
		mkdir('../data/'.$donneesUtilisateurInscrit['id'].'/vid/', 0777, true);
		mkdir('../data/'.$donneesUtilisateurInscrit['id'].'/img/', 0777, true);
		
		$req = $ludus['mysql']['bdd']->prepare('SELECT id, pseudo FROM '.$ludus['mysql']['prefixe'].'users WHERE pseudo = :pseudo');
		$req->execute(array(
			'pseudo' => $pseudo));
		$donneesUtilisateurActuel = $req->fetch();
	}
}

function edit_user($ludus, $id, $pseudo, $pass)
{
	$req = $ludus['mysql']['bdd']->prepare('SELECT id, pseudo, pass FROM '.$ludus['mysql']['prefixe'].'users WHERE id = :id');
	$req->execute(array(
		'id' => $id));
	$donneesUtilisateur = $req->fetch();
	
	if($donneesUtilisateur != NULL)
	{
		$req2 = $ludus['mysql']['bdd']->prepare('UPDATE '.$ludus['mysql']['prefixe'].'users SET pass = :pass WHERE id = :id');
		$req2->execute(array(
			'id' => $_SESSION['id'],
			'pass' => sha1($_POST['newpass']) ));
			
		$back = $ludus['options']['rootURL'].'/user/';
	}
}
?>