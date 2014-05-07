<?php
if(isset($_GET['sousPage']))
{
	$sousPageActuelle = $_GET['sousPage'];
}
else
{
	$sousPageActuelle = 'options';
}

switch($sousPageActuelle)
{
	case 'options':
		$nomPage .= ' > Options';
		$urlSousPage = 'panel/_options.php';
	break;
	
	case 'users':
		$nomPage .= ' > Utilisateurs';
		$urlSousPage = 'panel/_users.php';
	break;
	
	case 'statuts':
		$nomPage .= ' > Status';
		$urlSousPage = 'panel/_status.php';
	break;
}
?>
<article class="general">
	<h1>Panel d'administration</h1>
	<h2><a href="<?php echo $ludus['options']['rootURL'] ?>/admin/">Options</a> | <a href="<?php echo $ludus['options']['rootURL'] ?>/admin/users/">Utilisateurs</a> | <a href="<?php echo $ludus['options']['rootURL'] ?>/admin/statuts/">Statuts</a></h2>
</article>

<article class="general">
	<?php include($urlSousPage); ?>
	<input type="button" value="Retour" onclick="location.href='<?php echo $ludus['options']['rootURL'].'/user/' ?>';"/>
</article>