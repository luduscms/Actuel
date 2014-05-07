<?php
if($timeline['totalVideos'] > 0)
{
	for($i = 0; $i < count($timeline['videos']); $i++)
	{
		afficherVideo_timeline($ludus, $timeline['videos'][$i], $utilisateurActuel);
	}

	if($timeline['totalVideos'] > $ludus['theme']['nombreVideosParPage'])
	{
		$nombrePages = ceil($timeline['totalVideos'] / $ludus['theme']['nombreVideosParPage']);
		
		afficherMenuPagesVideos($ludus, '', $nombrePages, $p);
	}
}
else
{
?>
	<article>
		<p>Il n'y a encore aucune vidéo postée.</p>
	</article>
<?php
}
?>