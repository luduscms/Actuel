<?php
function afficherCommentaire2($ludus, $video, $utilisateurActuel)
{
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
<p><strong>Poster un commentaire</strong></p>
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
<script type="text/javascript">
maxlength_textarea('textarea_1','carac_reste_textarea_1',250);
</script>
<hr>
<?php
}
?>