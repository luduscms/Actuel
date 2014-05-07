<?php include("fonctions/load.php") ?>

<!DOCTYPE html>

<HTML>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="<?php echo $ludus['options']['rootURL'].'/themes/'.$ludus['options']['theme'].'/' ?>style.css" />
		
		<link href="http://vjs.zencdn.net/4.3/video-js.css" rel="stylesheet">
		<script src="http://vjs.zencdn.net/4.3/video.js"></script>
		<style type="text/css">
		  .vjs-default-skin { color: #f8f8f8; }
		  .vjs-default-skin .vjs-play-progress,
		  .vjs-default-skin .vjs-volume-level { background-color: #259171 }
		  .vjs-default-skin .vjs-control-bar,
		  .vjs-default-skin .vjs-big-play-button { background: rgba(23,23,23,0.7) }
		  .vjs-default-skin .vjs-slider { background: rgba(23,23,23,0.2333333333333333) }
		  .vjs-default-skin .vjs-control-bar { font-size: 89% }
		</style>
		
		<link rel="icon" type="image/png" href="<?php echo $ludus['options']['rootURL'].'/themes/'.$ludus['options']['theme'].'/data/' ?>favicon.png" />
		<title><?php echo $nomPage ?></title>
	</head>
	<body>
		<div class="main">
		<article class="header">
			<a href="<?php echo $ludus['options']['rootURL'].'/' ?>">
				<h1 class="styleTitre<?php echo rand(1, 3); ?>"><?php echo $ludus['options']['siteName'] ?></h1>
			</a>
		</article>
		
		<?php userbar($ludus, $utilisateurActuel) ?>
		
		<?php include('_'.$typePage.'.php') ?>
		
		<article class="footer">
			<div class="version">
				<h3>Powered by <a href="http://p.ttlegend2011.fr/ludus">Ludus</a> (Beta 1.1).</h3>
			</div>
			<div class="credits">
				<h3>Réalisé par <a href="http://ttlegend2011.fr">TTlegend2011</a>.</h3>
			</div>
		</article>
	</div>
	</body>
</HTML>