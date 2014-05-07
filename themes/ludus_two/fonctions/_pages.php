<?php
function afficherMenuPagesVideos($ludus, $auteur, $nombrePages, $pageActuelle)
{
	/* Variables re�ues :
		� $options['nombreVideosParPage'] : Le nombre de vid�os par page tel que d�fini dans les options.
		� $nombrePages : Le nombre de pages d'�l�ments, calcul� gr�ce au nombre de vid�os par page.
		� 
	*/
?>
<article class="pages">
<?php
	// Nous entrons � pr�sent en zone personnalisable. Attention. �a va chier.
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
	/* Variables re�ues :
		� $options['nombreVideosParPage'] : Le nombre de vid�os par page tel que d�fini dans les options.
		� $nombrePages : Le nombre de pages d'�l�ments, calcul� gr�ce au nombre de vid�os par page.
	*/
?>
<article class="pages">
<?php
	// Nous entrons � pr�sent en zone personnalisable. Attention. �a va chier.
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