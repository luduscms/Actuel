<?php
function load_options_theme($ludus)
{
	$optionsTheme = array(
		'nombreVideosParPage' => 5,
		'nombreCommentairesParPage' => 5,
		'liens' => array(
			'defaultAvatar' => $ludus['options']['rootURL'].'/themes/ludus_one/data/default_avatar.png'));
	
	return $optionsTheme;
}
?>