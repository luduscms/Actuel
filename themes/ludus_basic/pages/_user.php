<?php
function afficherUtilisateur($ludus, $utilisateur, $utilisateurActuel)
{
?>
<img src="<?php urlAvatar($ludus, $utilisateur['avatar']) ?>">
<h2><?php echo $utilisateur['pseudo'] ?></h2>
<h3><?php echo $utilisateur['statut']['nom'] ?></h3>
<p><?php bio($utilisateur['bio']); ?></p>
<hr>
<?php
}
?>