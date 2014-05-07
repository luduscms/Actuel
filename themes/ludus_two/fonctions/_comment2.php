<?php
function afficherCommentaire2($ludus, $video, $utilisateurActuel)
{
	/* Variables reçues :
		• $donneesUtilisateur['id'] : L'ID de l'utilisateur (pratique pour obtenir son avatar, comme vu après).
		• $donneesUtilisateur['pseudo'] : Le pseudonyme de l'utilisateur, sous forme de chaînes de caractères.
		• $donneesUtilisateur['bio'] : La bio de l'utilisateur, sous forme de chaînes de caractères.
		• $donneesUtilisateur['hasAvatar'] : Si l'utilisateur de la vidéo a un avatar, sous forme de booléen.
			-> Dans ce cas, cela veut dire que l'avatar de l'utilisateur est disponible à l'URL suivante : http://votresite.com/DossierEventuel/data/IDdeLAuteur/avatar.png
				-> Soit $rootURL.'/data/'.$donneesUtilisateur['id'].'/avatar.png'.
			-> Si vous décidez d'afficher l'avatar, il est conseillé d'afficher un avatar par défaut pour ceux qui n'ont pas d'avatar.
				-> Un avatar est disponible à l'utilisateur par défaut (0) à l'URL suivante : http://votresite.com/DossierEventuel/data/0/avatar.png
				-> Soit $rootURL.'/data/0/avatar.png'.
		• $donneesStatutUtilisateur['nom'] : Le nom du statut de l'utilisateur, sous forme de chaîne de caractères.
		• $donneesStatutUtilisateur['canPostVideos'] : Si l'utilisateur peut poster une vidéo, sous forme de booléen.
		• $donneesStatutUtilisateur['canAdmin'] : Si l'utilisateur peut accéder aux fonctions d'administration, sous forme de booléen.
	*/
?>
<script type="text/javascript">
function maxlength_textarea(id, crid, max)
{
	var txtarea = document.getElementById(id);
	document.getElementById(crid).innerHTML=max-txtarea.value.length;
	txtarea.onkeypress=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
	txtarea.onblur=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
	txtarea.onkeyup=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
	txtarea.onkeydown=function(){eval('v_maxlength("'+id+'","'+crid+'",'+max+');')};
}
function v_maxlength(id, crid, max)
{
	var txtarea = document.getElementById(id);
	var crreste = document.getElementById(crid);
	var len = txtarea.value.length;
	if(len>max)
	{
		txtarea.value=txtarea.value.substr(0,max);
	}
	len = txtarea.value.length;
	crreste.innerHTML=max-len;
}
</script>
<article>
	<form method="post" action="<?php echo $ludus['options']['rootURL']?>/user/comment/">
		<input type="hidden" name="action" />
		<?php
		if(isset($utilisateurActuel))
		{
		?>
			<input type="hidden" name="video" value="<?php echo $video['id'] ?>" />
			<input type="hidden" name="user" value="<?php echo $_SESSION['id'] ?>" />
		<?php
		}
		?>
			<textarea id="textarea_1" <?php if(!isset($utilisateurActuel)) { ?> disabled <?php } ?> name="content" rows="5" cols="90"><?php if(!isset($utilisateurActuel)) { ?>Vous devez être connecté pour pouvoir mettre un commentaire.<?php } ?></textarea>
			<?php if(isset($utilisateurActuel)) { ?><p><span id="carac_reste_textarea_1"></span> caractères restants.</p><?php } ?>
			<input type="submit" <?php if(!isset($utilisateurActuel)) { ?> disabled="disabled" <?php } ?> value="Commenter" /> <br />
	</form>
</article>
<script type="text/javascript">
maxlength_textarea('textarea_1','carac_reste_textarea_1',250);
</script>
<?php
}
?>