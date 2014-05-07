<?php
if($utilisateur != NULL)
{		
	afficherUtilisateur($ludus, $utilisateur, $utilisateurActuel);
	
	if($utilisateur['timeline']['totalVideos'] > 0)
	{
		for($i = 0; $i < count($utilisateur['timeline']['videos']); $i++)
		{
			afficherVideo_timeline($ludus, $utilisateur['timeline']['videos'][$i], $utilisateurActuel);
		}
		if($utilisateur['timeline']['totalVideos'] > $ludus['theme']['nombreVideosParPage'])
		{
			$nombrePages = ceil($utilisateur['timeline']['totalVideos'] / $ludus['theme']['nombreVideosParPage']);
			
			afficherMenuPagesVideos($ludus, $utilisateur['pseudo'], $nombrePages, $p);
		}
	}
	else
	{
	?>
		<article>
			<p>L'utilisateur n'a pas encore posté de vidéos.</p>
		</article>
	<?php
	}
}
else
{
	afficher404($ludus, 'Utilisateur');
}
?>