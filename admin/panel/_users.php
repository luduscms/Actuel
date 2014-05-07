<?php
if(!isset($_POST['action']))
{
	$nombreUtilisateursParPage = 5;
	if(isset($_GET['p']))
	{
		$pageActuelle = $_GET['p'];
	}
	else
	{
		$pageActuelle = 1;
	}

	$reqTTU = $ludus['mysql']['bdd']->query('SELECT count(id) AS total FROM '.$ludus['mysql']['prefixe'].'users');
	$donneesTotalTousUtilisateurs = $reqTTU->fetch();
	$totalUtilisateurs = $donneesTotalTousUtilisateurs['total'];
		
	$debutAffichage = $nombreUtilisateursParPage * ($pageActuelle - 1);
		
	if($totalUtilisateurs > 0)
	{
		$reqTU = $ludus['mysql']['bdd']->query('SELECT id, pseudo, statut FROM '.$ludus['mysql']['prefixe'].'users ORDER BY id ASC LIMIT '.$debutAffichage.','.$nombreUtilisateursParPage);
	}
?>
	<table width=800px>
		<tr>
			<td width=50px>
				<p><strong>ID</strong></p>
			</td>
			<td>
				<p><strong>Pseudo</strong></p>
			</td>
			<td width=200px>
				<p><strong>Rang</strong></p>
			</td>
			<td width=100px>
				<p><strong>Modifier</strong></p>
			</td>
		</tr>
		<?php
		while ($donneesTousUtilisateurs = $reqTU->fetch())
		{
		?>
			<tr>
				<td>
					<p><?php echo $donneesTousUtilisateurs['id'] ?></p>
				</td>
				<td>
					<p><?php echo $donneesTousUtilisateurs['pseudo'] ?></p>
				</td>
				<td>
					<p><?php
						$reqRU = $ludus['mysql']['bdd']->prepare('SELECT id, nom FROM '.$ludus['mysql']['prefixe'].'statuts WHERE id = :id');
						$reqRU->execute(array(
							'id' => $donneesTousUtilisateurs['statut']));
						$donneesRangUtilisateur = $reqRU->fetch();
						
						echo $donneesRangUtilisateur['nom'];
					?></p>
				</td>
				<td>
					<p>
						<form method="post" action="<?php echo $ludus['options']['rootURL'].'/admin/users/edit/'.$donneesTousUtilisateurs['id'] ?>">
							<input type="submit" value="Éditer" />
						</form>
						
						<?php
						if($donneesTousUtilisateurs['id'] != 1)
						{
						?>
							<form method="post" action="<?php echo $ludus['options']['rootURL'].'/admin/users/delete/'.$donneesTousUtilisateurs['id'] ?>">
								<input type="hidden" name="id" value="<?php echo $donneesTousUtilisateurs['id'] ?>" />
								<input type="submit" value="Supprimer" />
							</form>
						<?php
						}
						?>
					</p>
				</td>
			</tr>
		<?php
		}
		?>
	</table>

	<?php
	$nombrePages = ceil($totalUtilisateurs / $nombreUtilisateursParPage);
			
	if($nombrePages > 1)
	{
	?>
	<article class="pages">
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
				echo '<a href="'.$options['rootURL'].'/admin/users/page-'.$i.'">'.$i.'</a>';
			}
			
			if($i != $nombrePages)
			{
				echo ' - ';
			}
		}
		echo ' &gt;';
	?>
		</p>
	</article>
	<?php
	}
	?>

	<form method="post" action="<?php echo $ludus['options']['rootURL'].'/admin/users/add/' ?>">
		<input type="submit" value="Ajouter" />
	</form>
<?php
}
?>