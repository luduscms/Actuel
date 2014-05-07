<?php
if(!isset($_POST['action']))
{
	if(isset($_GET['p']))
	{
		$pageActuelle = $_GET['p'];
	}
	else
	{
		$pageActuelle = 1;
	}
	
	$statuts = chargerStatuts($ludus, $pageActuelle);
?>
	<table>
		<tr>
			<td width=30px>
				<p><strong>ID</strong></p>
			</td>
			<td width=200px>
				<p><strong>Nom</strong></p>
			</td>
			<td width=250px>
				<p><strong>Peut poster des vidéos</strong></p>
			</td>
			<td width=200px>
				<p><strong>Peut administrer</strong></p>
			</td>
			<td width=50px>
				<p><strong>Modifier</strong></p>
			</td>
		</tr>
		<?php
		for($i = 0; $i < count($statuts['statuts']); $i++)
		{
		?>
			<tr>
				<td>
					<p><?php echo $statuts['statuts'][$i]['id'] ?></p>
				</td>
				<td>
					<p><?php echo $statuts['statuts'][$i]['nom'] ?></p>
				</td>
				<td>
					<p>
						<?php
							if($statuts['statuts'][$i]['canPostVideos'])
							{
								echo '✓';
							}
							else
							{
								echo '✗';
							}
						?>
					</p>
				</td>
				<td>
					<p>
						<?php
							if($statuts['statuts'][$i]['canAdmin'])
							{
								echo '✓';
							}
							else
							{
								echo '✗';
							}
						?>
					</p>
				</td>
				<td>
					<form method="post" action="<?php echo $ludus['options']['rootURL'].'/admin/status/edit/'.$statuts['statuts'][$i]['id'] ?>">
						<input type="submit" value="Éditer" />
					</form>
					<?php
					if($statuts['statuts'][$i]['id'] > 3)
					{
					?>
						<form method="post" action="<?php echo $ludus['options']['rootURL'].'/admin/status/delete/'.$statuts['statuts'][$i]['id'] ?>">
							<input type="submit" value="Supprimer" />
						</form>
					<?php
					}
					?>
				</td>
			</tr>
		<?php
		}
		?>
	</table>

	<?php
		/*$nombrePages = ceil($totalStatus / $nombreStatusParPage);
		
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
					echo '<a href="'.$ludus['options']['rootURL'].'/admin/status/page-'.$i.'">'.$i.'</a>';
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
		*/
	?>

	<form method="post" action="<?php echo $ludus['options']['rootURL'].'/admin/status/add/' ?>">
		<input type="submit" value="Ajouter" />
	</form>
<?php
}
?>