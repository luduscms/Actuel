<?php
if(isset($_POST['action']))
{
	$req = $ludus['mysql']['bdd']->prepare('INSERT INTO '.$ludus['mysql']['prefixe'].'activity(type, user, date, video, content) VALUES(:type, :user, :date, :video, :content)');
	$req->execute(array(
		'type' => 'comment',
		'user' => $_POST['user'],
		'date' => date('Y-m-d H:i:s'),
		'video' => $_POST['video'],
		'content' => $_POST['content']));
		
	$back = $ludus['options']['rootURL'].'/video/'.$_POST['video'];
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>