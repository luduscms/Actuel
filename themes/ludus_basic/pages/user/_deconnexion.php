<?php
if(isset($_POST['action']))
{
	$_SESSION = array();
	session_destroy();
		
	$back = $ludus['options']['rootURL'].'/';
	
	echo '<script type=\'text/javascript\'>document.location.replace(\''.$back.'\');</script>';
}
?>