<?php
if(isset($_GET['id']))
{
	if($video != NULL)
	{
		afficherVideo_seul($ludus, $video, $utilisateurActuel);
		afficherCommentaire2($ludus, $video, $utilisateurActuel);
		if(count($video['commentaires']) > 0)
		{
			for($i = 0; $i < count($video['commentaires']); $i++)
			{
				afficherCommentaire($ludus, $video['commentaires'][$i], $utilisateurActuel);
			}
			
			if($video['totalCommentaires'] > $ludus['theme']['nombreCommentairesParPage'])
			{
				$nombrePages = ceil($video['totalCommentaires'] / $ludus['theme']['nombreCommentairesParPage']);
				
				afficherMenuPagesCommentaires($ludus, $video['id'], $nombrePages, $c);
			}
		}
		else
		{
		?>
		<article>
			<h3>Pas de commentaires pour le moment !</h3>
		</article>
		<?php
		}
	}
	else
	{
		afficher404($ludus, 'Vidéo');
	}
}
?>