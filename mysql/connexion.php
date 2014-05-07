<?php
	function connexion_mysql()
	{
		$host = 'localhost';
		$dbname = 'ludus';
		$user = 'root';
		$pass = '';
		$prefixe = '';
		
		try
		{
			$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $pass);
			$bdd->query('SET NAMES utf8');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
		
		$mysql = array(
			'bdd' => $bdd,
			'prefixe' => 'beta_1_1_');
		
		return $mysql;
	}
?>