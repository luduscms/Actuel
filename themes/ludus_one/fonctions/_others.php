<?php
function urlAvatar($ludus, $avatar)
{
	if($avatar['has'] == 1)
	{
		return $avatar['url'];
	}
	else
	{
		return $ludus['options']['rootURL'].'/themes/ludus_one/data/default_avatar.png';
	}
}
function bio($bio)
{
	if($bio != "")
	{
		echo $bio;
	}
	else
	{
	?>
		<em>L'utilisateur n'a pas défini de bio.</em>
	<?php
	}
}
?>