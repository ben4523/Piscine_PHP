<?php
require_once'fonctions/ft_database.php';
$database = start_database();
require_once'fonctions/ft_user.php';
if (isset($_SESSION['login']))
		$user = getUser($_SESSION['login']);
else {
	header('location: connexion.php');
	exit();
}
if (isset($_SESSION['basket']) || $_SESSION['basket'] !== null || isset($user))
{
	$myBasket = serialize($_SESSION['basket']);
	$myBasket = mysqli_real_escape_string($database,$myBasket);
	$myId = $user['id'];
	$myUser = $user['email'];
	$query = "INSERT INTO commandes(user_id, login, basket, date) VALUES ('$myId','$myUser','$myBasket',NOW())";
	mysqli_query($database, $query);
	$_SESSION['basket'] = "";
	$_SESSION['basket_total_count'] = 0;
	header('location: commandes.php');
	exit();
}
header('location: index.php');
exit();
?>
