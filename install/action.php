<?php
	if($_POST['type'] == 'dbconnect') /* Étape 1 : connexion à la base de données et instauration des tables */
	{
		if(mysql_connect($_POST['host'], $_POST['user'], $_POST['pass'])) /* Si la connexion avec la base MySQL est réussie */
		{
			if(mysql_select_db($_POST['dbname']))
			{
				/* Création du fichier contenant les données de connexion à la base MySQL */
				$optionsFile = fopen('../MySQL/connexion.php', 'w+');
				fwrite($optionsFile,
					'<?php
						function connexion_mysql()
						{
							$host = \''.$_POST['host'].'\';
							$dbname = \''.$_POST['dbname'].'\';
							$user = \''.$_POST['user'].'\';
							$pass = \''.$_POST['pass'].'\';
							$prefixe = \''.$_POST['prefixe'].'\';
							
							try
							{
								$bdd = new PDO(\'mysql:host=\'.$host.\';dbname=\'.$dbname.\'\', $user, $pass);
								$bdd->query(\'SET NAMES utf8\');
							}
							catch (Exception $e)
							{
									die(\'Erreur : \' . $e->getMessage());
							}
							
							
							$mysql = array(
								\'bdd\' => $bdd,
								\'prefixe\' => \''.$_POST['prefixeTable'].'\');
							
							return $mysql;
						}
					?>');
				fclose($optionsFile);
				include("../options_mysql.php");
				try
				{
					$bdd = new PDO('mysql:host='.$options['host'].';dbname='.$options['dbname'], $options['user'], $options['pass']);
					$bdd->query('SET NAMES utf8');
				}
				catch (Exception $e)
				{
						die('Erreur : ' . $e->getMessage());
				}
				
				$bdd->query('CREATE TABLE `'.$options['prefixeTable'].'videos` (
							  `id` varchar(15) NOT NULL,
							  `nom` varchar(255) NOT NULL,
							  `auteur` int(11) NOT NULL,
							  `url` varchar(255) NOT NULL,
							  `img` varchar(255) NOT NULL,
							  `published` datetime NOT NULL,
							  `description` text CHARACTER SET utf8 NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');
							
				$bdd->query('CREATE TABLE `'.$options['prefixeTable'].'users` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `pseudo` varchar(255) NOT NULL,
							  `pass` varchar(255) NOT NULL,
							  `statut` int(11) NOT NULL DEFAULT \'0\',
							  `hasAvatar` tinyint(1) NOT NULL DEFAULT \'0\',
							  `bio` text CHARACTER SET utf8 NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;');
							
				$bdd->query('CREATE TABLE `'.$options['prefixeTable'].'status` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `nom` varchar(255) NOT NULL,
							  `canPostVideos` tinyint(4) NOT NULL,
							  `canAdmin` tinyint(4) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;');
							
				$bdd->query('INSERT INTO `'.$options['prefixeTable'].'status` (`id`, `nom`, `canPostVideos`, `canAdmin`) VALUES
							(1, \'Fan\', 0, 0),
							(2, \'Vidéomaker\', 1, 0),
							(3, \'Administrateur\', 1, 1);');
				
				$bdd->query('CREATE TABLE `'.$options['prefixeTable'].'activity` (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `user` int(11) NOT NULL,
							  `type` int(11) NOT NULL,
							  `date` datetime NOT NULL,
							  `video` varchar(15) NOT NULL,
							  `content` varchar(255) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;');
							
				echo '<script type=\'text/javascript\'>document.location.replace(\'options/\');</script>';
			}
			else
			{
				/* On indique que la base n'existe pas et on revient à l'étape 1 */
				echo '<script type=\'text/javascript\'>document.location.replace(\'dbconnect/erreur-2\');</script>';
			}
		}
		else
		{
			/* On retourne à l'étape 1 en indiquant que les paramètres de base MySQL sont incorrects */
			echo '<script type=\'text/javascript\'>document.location.replace(\'dbconnect/erreur-1\');</script>';
		}
	}
	
	if($_POST['type'] == 'options_generales') /* Étape 3 : création de la table 'options' */
	{
		/* Connexion à la base de données */
		include("../options_mysql.php");
		try
		{
			$bdd = new PDO('mysql:host='.$options['host'].';dbname='.$options['dbname'], $options['user'], $options['pass']);
			$bdd->query('SET NAMES utf8');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}
		
		$test = explode("/install/", $_SERVER['REQUEST_URI']);
		
		$bdd->query('CREATE TABLE `'.$options['prefixeTable'].'options` (
					  `rootURL` varchar(255) NOT NULL,
					  `theme` varchar(25) NOT NULL DEFAULT \'ludus_one\',
					  `pseudoProprietaire` varchar(255) NOT NULL,
					  `urlProprietaire` varchar(255) NOT NULL,
					  `siteName` varchar(255) NOT NULL,
					  `nombreVideosParPage` int(11) NOT NULL DEFAULT \'5\',
					  `nombreCommentairesParPage` int(11) NOT NULL DEFAULT \'5\',
					  `inscriptionAuthorized` tinyint(4) NOT NULL DEFAULT \'0\'
					) ENGINE=InnoDB DEFAULT CHARSET=latin1;');
					
		$bdd->query('INSERT INTO `'.$options['prefixeTable'].'options` (`rootURL`, `pseudoProprietaire`, `urlProprietaire`, `siteName`, `nombreVideosParPage`) VALUES
					(\''.$test[0].'\', \''.$_POST['pseudoProprietaire'].'\', \''.$_POST['urlProprietaire'].'\', \''.$_POST['siteName'].'\', '.(int)$_POST['nombreVideosParPage'].');');
		
		echo '<script type=\'text/javascript\'>document.location.replace(\'adminuser/\');</script>';
	}
	
	if($_POST['type'] == 'adminuser') /* Étape 3 : création du compte administrateur */
	{
		/* Connexion à la base de données */
		include("../options_mysql.php");
		try
		{
			$bdd = new PDO('mysql:host='.$options['host'].';dbname='.$options['dbname'], $options['user'], $options['pass']);
			$bdd->query('SET NAMES utf8');
		}
		catch (Exception $e)
		{
				die('Erreur : ' . $e->getMessage());
		}
		
		$req = $bdd->prepare('INSERT INTO '.$options['prefixeTable'].'users(pseudo, pass, statut, hasAvatar, bio) VALUES(:pseudo, :pass, :statut, :hasAvatar, :bio)');
		$req->execute(array(
			'pseudo' => $_POST['pseudoAdmin'],
			'pass' => sha1($_POST['passAdmin']),
			'statut' => 3,
			'hasAvatar' => 0,
			'bio' => ''));
		
		echo '<script type=\'text/javascript\'>document.location.replace(\'../\');</script>';
	}
?>