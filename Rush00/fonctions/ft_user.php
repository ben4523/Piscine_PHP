<?php

	function create_new_user($email,$passwd)
	{
		global $database;
		$email = mysqli_real_escape_string($database, $email);
		$passwd = hash('sha512',$passwd);
		$query = "INSERT INTO users(email, passwd) VALUES ('$email','$passwd')";
		return (mysqli_query($database,$query));
	}

	function change_pass($email,$passwd)
	{
		global $database;
		$email = mysqli_real_escape_string($database, $email);
		$passwd = hash('sha512',mysqli_real_escape_string($database,$passwd));
		$query = "UPDATE users SET passwd='$passwd' WHERE email='$email'";
		return (mysqli_query($database,$query));
	}

	function getUser($login)
	{
		global $database;
		if ($login == "")
			return "";
		$login = mysqli_real_escape_string($database, $login);
		$query = "SELECT * FROM users WHERE email='$login' LIMIT 1";
		if (!($stmt = mysqli_query($database,$query)))
			return (FALSE);
		$row = mysqli_fetch_array($stmt);
		return ($row);
	}

	function query_ok($bool)
	{
		global $database;
		if (!$bool)
			echo "A problem occured. The error message is <b>" . mysqli_error($database) . "</b><br />";
	}

	function deleteUser($id)
	{
		global $database;
		$query = "DELETE FROM users WHERE id='$id'";
		return (mysqli_query($database, $query));
	}

	function get_my_order($login)
	{
		global $database;
		if ($login == "")
			return "";
		$login = mysqli_real_escape_string($database, $login);
		$query = "SELECT * FROM commandes WHERE login='$login';";
		if (!($stmt = mysqli_query($database,$query)))
			return (FALSE);
		while ($row = mysqli_fetch_array($stmt))
			$result[] = $row;
		return ($result);
	}

	function get_all_order()
	{
		global $database;
		$query = "SELECT * FROM commandes";
		if (!($stmt = mysqli_query($database,$query)))
			return (FALSE);
		while ($row = mysqli_fetch_array($stmt))
			$result[] = $row;
		return ($result);
	}
?>
