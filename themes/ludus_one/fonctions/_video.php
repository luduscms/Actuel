<?php
function afficherVideo_timeline($ludus, $video, $utilisateurActuel)
{
?>
<article class="video">
		<div class="enTeteVideo">
			<table width=100%>
				<tr>
					<td class="titreVideo">
						<a href="<?php echo $video['liens']['view'] ?>"><h2 class="titreVideo"><?php echo $video['nom'] ?></h2></a>
					</td>
					<td class="infosVideo">
						<h2 class="infosVideo">
						<a href="<?php echo $video['auteur']['liens']['profil'] ?>"><?php echo $video['auteur']['pseudo'] ?></a>
						<br />
						<?php echo $video['date']['complete'] ?>
						</h2>
					</td>
				</tr>
			</table>
		</div>
	<img class="miniatureVideo" src="<?php echo $video['source']['img'] ?>">
</article>
<?php
}

function afficherVideo_seul($ludus, $video, $utilisateurActuel)
{
?>
<article class="video">
	<h2 class="titreVideo"><?php echo $video['nom'] ?></h2>
	<div class="lecteurVideo">
		<video class="video-js vjs-default-skin" controls
		 preload="auto" width="748" height="421" poster="<?php echo $video['source']['img'] ?>"
		 data-setup="{}">
		 <source src="<?php echo $video['source']['vid'] ?>" type='video/mp4'>
		</video>
	</div>
	<p class="publieeLe">
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
	</p> <br />
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
	<div class="description">
		<?php echo $video['description'] ?>
	</p>
</article>
<?php
}
?>