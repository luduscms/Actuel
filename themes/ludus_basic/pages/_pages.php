<?php
function afficherMenuPagesVideos($ludus, $auteur, $nombrePages, $pageActuelle)
{
?>
<hr>
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
<hr>
<?php
}

function afficherMenuPagesCommentaires($ludus, $id, $nombrePages, $pageActuelle)
{
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
<hr>
<?php
}
?>