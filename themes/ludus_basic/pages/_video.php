<?php
function afficherVideo_timeline($ludus, $video, $utilisateurActuel)
{
?>
<a href="<?php echo $video['liens']['view'] ?>"><h2><?php echo $video['nom'] ?></h2></a>
<a href="<?php echo $video['auteur']['liens']['profil'] ?>"><p><?php echo $video['auteur']['pseudo'] ?></p></a>
<p><?php echo $video['date']['complete'] ?></p>
<img src="<?php echo $video['source']['img'] ?>">
<hr>
<?php
}

function afficherVideo_seul($ludus, $video, $utilisateurActuel)
{
?>
<h1><?php echo $video['nom'] ?></h1>
<div class="lecteurVideo">
	<video class="video-js vjs-default-skin" controls
	 preload="auto" width="748" height="421" poster="<?php echo $video['source']['img'] ?>"
	 data-setup="{}">
	 <source src="<?php echo $video['source']['vid'] ?>" type='video/mp4'>
	</video>
</div>
<p>
	<?php
		echo 'Vidéo publiée le '.$video['date']['jour'].' '.$video['date']['nomMois'].' '.$video['date']['annee'].' par '.$video['auteur']['pseudo'].'.';
		
		if($utilisateurActuel != NULL)
		{
			if($utilisateurActuel['statut']['canAdmin'] == 1 || ($utilisateurActuel['id'] == $video['auteur']['id']))
			{
	?>
			<form method="post" action="<?php echo $video['liens']['edit'] ?>">
				<input type="submit" value="Éditer" />
			</form>
		
			<form method="post" action="<?php echo $video['liens']['remove'] ?>">
				<input type="submit" value="Supprimer" />
			</form>
	<?php
			}
		}
	?>
</p>
<p><strong><?php echo $video['totalLikes'] ?></strong> J'aime</p>
<?php
	if($utilisateurActuel != NULL)
	{
		?>
			<form method="post" action="<?php echo $ludus['options']['rootURL'] ?>/user/like/">
				<input type="hidden" name="action" />
				<input type="hidden" name="id" value="<?php echo $video['id'] ?>" />
				
				<input type="submit" value="<?php if($video['userLike']) { echo 'J\'aime'; } else { echo 'Je n\'aime plus'; }?>" />
			</form>
		<?php
	}
?>
<p><strong><?php echo $video['vues'] ?></strong> vues</p>
<p><?php echo $video['description'] ?></p>
<hr>
<?php
}
?>