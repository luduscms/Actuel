<?php
if(isset($_POST['action']))
{
	$req = $ludus['mysql']['bdd']->prepare('UPDATE '.$ludus['mysql']['prefixe'].'users SET bio = :bio WHERE id = :id');
	$req->execute(array(
		'id' => $_SESSION['id'],
		'bio' => '<p>'.str_replace("\n", '</p><br /><p>', stripslashes($_POST['bio'])).'</p>' ));
		
	$back = $ludus['options']['rootURL'].'/user/';
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>