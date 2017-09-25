<?php
	require_once 'fonctions/ft_database.php';
	$database = start_database();
	require_once 'fonctions/ft_user.php';
	require_once 'fonctions/ft_produits.php';
	if (isset($_SESSION['login']))
	    $user = getUser($_SESSION['login']);

	if ($user['admin'] == '0' || !isset($_SESSION['login']))
		header('Location: profil.php');

	if (isset($user['admin']) && $user['admin'] == '1' && isset($_GET['id']))
	{
		$id = mysqli_real_escape_string($database, $_GET['id']);
		if (isset($_GET['delete']))
		{
			$query = "DELETE FROM commandes WHERE id=$id";
			$stmt = mysqli_query($database,$query);
			header('location: commandes.php');
		}
		if (isset($_GET['add']) && isset($_GET['id_prod']))
		{
			$id_prod = mysqli_real_escape_string($database,$_GET['id_prod']);
			$query = "SELECT * FROM commandes WHERE id=$id";
			if (!($stmt = mysqli_query($database,$query)))
			{
				header('location: index.php');
				exit();
			}
			$row = mysqli_fetch_array($stmt);
			$basket = unserialize($row['basket']);
			if (!isset($basket[$id_prod]))
			{
				header('location: index.php');
				exit();
			}
			$basket[$id_prod] += 1;
			$basket = serialize($basket);
			$query = "UPDATE commandes SET basket='$basket' WHERE id='$id'";
			mysqli_query($database,$query);
			header('location: commandes.php');
			exit();
		}
		if (isset($_GET['retire']) && isset($_GET['id_prod']))
		{
			$id_prod = mysqli_real_escape_string($database,$_GET['id_prod']);
			$query = "SELECT * FROM commandes WHERE id=$id";
			if (!($stmt = mysqli_query($database,$query)))
			{
				header('location: index.php');
				exit();
			}
			$row = mysqli_fetch_array($stmt);
			$basket = unserialize($row['basket']);
			if (!isset($basket[$id_prod]))
			{
				header('location: index.php');
				exit();
			}
			$basket[$id_prod] -= 1;
			if ($basket[$id_prod] <= '0')
			{
				$new = array();
				foreach ($basket as $key => $value)
				{
					if ($key != $id_prod)
						$new[$key] = $value;
				}
				$new = serialize($new);
				if ($new == "a:0:{}")
					$query = "DELETE FROM commandes WHERE id=$id";
				else
					$query = "UPDATE commandes SET basket='$new' WHERE id='$id'";
			}
			else
			{
				$basket = serialize($basket);
				$query = "UPDATE commandes SET basket='$basket' WHERE id='$id'";
			}
			$stmt = mysqli_query($database,$query);
			header('location: commandes.php');
			exit();
		}
	}
	header('location: index.php');
?>
