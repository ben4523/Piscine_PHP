<?php
	session_start();
	if (isset($_GET['login']) && isset($_GET['passwd']) && isset($_GET['submit']) && $_GET['submit'] == 'OK')
	{
		$_SESSION['login'] = $_GET['login'];
		$_SESSION['passwd'] = $_GET['passwd'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Formulaire Session</title>
	</head>
	<body>
		<form method="get" action="index.php">
			Identifiant: <input type="text" name="login" value="<?php if (isset($_SESSION["login"])){ echo $_SESSION["login"];} ?>"><br/>
			Mot de passe: <input type="password" name="passwd" value="<?php if (isset($_SESSION["passwd"])){echo $_SESSION["passwd"];} ?>">
			<input type="submit" name="submit" value="OK">
		</form>
	</body>
</html>
