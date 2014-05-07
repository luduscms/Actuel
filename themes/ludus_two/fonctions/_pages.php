<?php
function afficherMenuPagesVideos($ludus, $auteur, $nombrePages, $pageActuelle)
{
	/* Variables reçues :
		• $options['nombreVideosParPage'] : Le nombre de vidéos par page tel que défini dans les options.
		• $nombrePages : Le nombre de pages d'éléments, calculé grâce au nombre de vidéos par page.
		• 
	*/
?>
<article class="pages">
<?php
	// Nous entrons à présent en zone personnalisable. Attention. Ça va chier.
?>		
	<p>
		<?php
			echo '&lt; ';
			for($i = 1; $i < ($nombrePages +1); $i++)
			{
				if($i == $pageActuelle)
				{
					echo '<strong>'.$i.'</strong>';
				}
				else
				{
					if($auteur == '')
					{
						echo '<a href="'.$ludus['options']['rootURL'].'/page-'.$i.'">'.$i.'</a>';
					}
					else
					{
						echo '<a href="'.$ludus['options']['rootURL'].'/utilisateur/'.$auteur.'/page-'.$i.'">'.$i.'</a>';
					}
				}
				
				if($i != $nombrePages)
				{
					echo ' - ';
				}
			}
			echo ' &gt;';
		?>
	</p>
<?php
	// Nous quittons la zone personnalisable (enfin).
?>
</article>
<?php
}

function afficherMenuPagesCommentaires($ludus, $id, $nombrePages, $pageActuelle)
{
	/* Variables reçues :
		• $options['nombreVideosParPage'] : Le nombre de vidéos par page tel que défini dans les options.
		• $nombrePages : Le nombre de pages d'éléments, calculé grâce au nombre de vidéos par page.
	*/
?>
<article class="pages">
<?php
	// Nous entrons à présent en zone personnalisable. Attention. Ça va chier.
?>		
	<p>
		<?php
			echo '&lt; ';
			for($i = 1; $i < ($nombrePages + 1); $i++)
			{
				if($i == $pageActuelle)
				{
					echo '<strong>'.$i.'</strong>';
				}
				else
				{
					echo '<a href="'.$ludus['options']['rootURL'].'/video/'.$id.'/comment-'.$i.'">'.$i.'</a>';
				}
				
				if($i != $nombrePages)
				{
					echo ' - ';
				}
			}
			echo ' &gt;';
		?>
	</p>
<?php
	// Nous quittons la zone personnalisable (enfin).
?>
</article>
<?php
}
?>