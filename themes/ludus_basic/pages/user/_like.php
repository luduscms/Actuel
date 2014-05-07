<?php
if(isset($_POST['action']))
{
	$req = $ludus['mysql']['bdd']->prepare('SELECT id FROM '.$ludus['mysql']['prefixe'].'activity WHERE type = :type AND user = :user AND video = :video');
	$req->execute(array(
		'type' => 'like',
		'user' => $_SESSION['id'],
		'video' => $_POST['id']));
	$donneesLike = $req->fetch();
	
	if($donneesLike == NULL)
	{
		$req = $ludus['mysql']['bdd']->prepare('INSERT INTO '.$ludus['mysql']['prefixe'].'activity(type, user, date, video, content) VALUES(:type, :user, :date, :video, :content)');
		$req->execute(array(
			'type' => 'like',
			'user' => $_SESSION['id'],
			'date' => date('Y-m-d H:i:s'),
			'video' => $_POST['id'],
			'content' => ''));
	}
	else
	{
		$req = $ludus['mysql']['bdd']->prepare('DELETE FROM '.$ludus['mysql']['prefixe'].'activity WHERE type = :type AND user = :user AND video = :video');
		$req->execute(array(
			'type' => 'like',
			'user' => $_SESSION['id'],
			'video' => $_POST['id']));
	}
		
	$back = $ludus['options']['rootURL'].'/video/'.$_POST['id'];
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>